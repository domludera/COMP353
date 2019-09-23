<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "ass1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";

//Query PHP->MYSQL
$myfile = file_get_contents("ass1.sql");

if (mysqli_multi_query($conn, $myfile))
    echo "Table creation succesful\n";
else
    echo "Fail";


$myfile = fopen("db19s-P1.csv", "r") or die("Unable to open file!");
//echo fread($myfile, filesize("db19s-P1.csv"));

$delimiter = "/\+-+\+/";
$valueparser = "/\|(\S+)\|(\S+)\|(\S*)\|(\d+)\|(\d+)\|/";
$eventparser = "/\|(\S+)\|(\d+)\|(\S*)\|(\S*)\|(\d+)\|/";
$idparser = "/\|(\d+)\|(\d+)\|/";
$n = 0;
while(!feof($myfile)){

    $currentString = fgets($myfile);
    if(preg_match($delimiter, $currentString)){
        $n++;
    }
    //echo $currentString;
    switch($n){
        case 1:
            if(preg_match($valueparser, $currentString, $matches_out)){
                $result = $conn->query("INSERT INTO Invitees VALUES ('$matches_out[4]', '$matches_out[2]', '$matches_out[3]', '$matches_out[1]', '$matches_out[5]')");
                if(!$result){
                    die($conn->error);
                }
            }
            break;
        //events
        case 2:
            if(preg_match($eventparser, $currentString, $matches_out)){
                echo strlen($matches_out[4]);
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
fclose($myfile);

$conn->close();

?>
