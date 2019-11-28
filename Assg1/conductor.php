<?php
/*
COMP 353-F
Instructor: Bipin C. Desai
Project 1
COMP 353_group_22:
Zachary LAPOINTE, 27518536
Dominik LUDERA, 40062500
Hugo JONCOUR, 40139230
Erik SMITH, 40002747
Priscilla COURNOYER, 27710690
*/

// Application execution
$app = new Assignment1('config.ini');
$app->execute('assg1.sql','db19s-P1.csv');

// Class container
class Assignment1 {

    // Database Connection settings
    protected $dbConfigs;

    // Class constructor;  Gets the database configurations
    function __construct($configFile) {
        $this->dbConfigs = parse_ini_file($configFile);
    }

    // Main execution method
    public function execute($schemaFile, $datafile){
        // Get a stable connection to the database
        $conn = $this->ConnectToDb();

        // Create the database tables
        $this->SchemaFormation($conn, $schemaFile);

        // Parse data from file and insert them into the database accordingly
        $this->ParseData($conn,$datafile);
        
        // Close our database connection
        $conn->close();
    }

    // Connect to Database using the configuration settings.
    // Return instance of mysqli Connection
    public function ConnectToDb(){
        $conn = new mysqli($this->dbConfigs['servername'], $this->dbConfigs['username'], $this->dbConfigs['password'], $this->dbConfigs['dbname']);
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        else
            echo "Connected successfully\n";

        return $conn;
    }

    // returns compiled results of the queued query
    // Note: Query must be consumes before next statement is prepared or else you will get an error
    public function GetQueryData($conn){
        $results = [];
        while($conn->more_results()){
            $conn->next_result();
            $results[] = $conn->use_result();
        }
        return $results;
    }

    // Create the tables
    public function SchemaFormation($conn,$schemaFile){

        //Query PHP->MYSQL
        $myfile = file_get_contents($schemaFile);

        if (mysqli_multi_query($conn, $myfile))
            echo "Table creation succesful\n";
        else
            echo "Failed to create table\n";
        
        // Consume the query results to allow other statements to be prepared
        return $this->GetQueryData($conn);
    }

    // Parse data froma file and fill in the entried into the database
    public function ParseData($conn,$datafile){
            
        // Regex settings
        $delimiter = "/\+-+\+/";
        $valueparser = "/\|(\S+)\|(\S+)\|(\S*)\|(\d+)\|(\d+)\|/";
        $eventparser = "/\|(\S+)\|(\d+)\|(\S*)\|(\S*)\|(\d+)\|/";
        $idparser = "/\|(\d+)\|(\d+)\|/";
        $n = 0;
        
        // Open file stream
        $myfile = fopen($datafile, "r") or die("Unable to open file!");

        echo "Importing data\n";
        
        // Parse begin
        while(!feof($myfile)){
            $currentString = fgets($myfile);
            if(preg_match($delimiter, $currentString)){
                $n++;
            }
            //echo $currentString;
            switch($n){
                case 1:
                    if(preg_match($valueparser, $currentString, $matches_out)){
                        $result = $conn->query("INSERT INTO Invitees VALUES ('$matches_out[4]', '$matches_out[2]', " . (strlen($matches_out[3])==0 ? "null" : "'$matches_out[3]'") . ", '$matches_out[1]', '$matches_out[5]')");
                        if(!$result){
                            die($conn->error);
                        }
                    }
                    break;
                //events
                case 2:
                    if(preg_match($eventparser, $currentString, $matches_out)){
                        $result = $conn->query("INSERT INTO Events VALUES ('$matches_out[2]', '$matches_out[3]', " . (strlen($matches_out[4])==0 ? "null" : "'$matches_out[4]'") . ", '$matches_out[5]', '$matches_out[1]')");
                        if(!$result){
                            die($conn->error);
                        }
                    }
                    break;
                //idConcat
                case 3:
                    if(preg_match($idparser, $currentString, $matches_out)){
                        $result = $conn->query("INSERT INTO Attendances VALUES ('$matches_out[1]', '$matches_out[2]')");
                        if(!$result){
                            die($conn->error);
                        }
                    }
                    break;
            }
        }

        // Close file stream
        fclose($myfile);
        echo "Data has been imported\n";
    }
}

?>
