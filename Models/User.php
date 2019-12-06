<?php
class User extends Model
{
    public function listing()
    {
        $sql = "SELECT id, email FROM users;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Find a given record by its ID
     */
    public function find($id)
    {
        if(!$id){
            return $id;
        };
        $sql = "SELECT id, name, dob, email, region, profession FROM users WHERE id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
         	$id			
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Create new user TODO:: Check if email already in use
     */
    public function create($email, $password, $name, $dob, $region, $profession)
    {
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users 
                (email, password, name, dob, region, profession, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "ssssssss", // tells you what type the vars will be (check php docs for more info)
            $email,
            $password,
			$name,
            $dob,
            $region,
            $profession,
            $now,
            $now
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }
    
    /**
     * Create new user TODO:: Check if email already in use
     */
    public function byEmail($email)
    {
        
        $sql = "SELECT * FROM users WHERE email=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "s", // tells you what type the vars will be (check php docs for more info)
            $email
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Validate credentials
     */
    public function validate($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email=? AND password = ?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "ss", // tells you what type the vars will be (check php docs for more info)
            $email,
            $password
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function isAdmin($userId){
        if (!class_exists('Privilege')) {
            require(ROOT . 'Models/Privilege.php');
        }

        $user = User::resultToArray($this->find($userId))[0];

        $privilegeManager = new Privilege();
        $adminPriv = Privilege::resultToArray($privilegeManager->byName('admin'))[0];
        return $privilegeManager->has($adminPriv['id'],$user["id"]);
    }

    public function isController($userId){
        if (!class_exists('Privilege')) {
            require(ROOT . 'Models/Privilege.php');
        }

        $user = User::resultToArray($this->find($userId))[0];

        $privilegeManager = new Privilege();
        $controllerPriv = Privilege::resultToArray($privilegeManager->byName('controller'))[0];
        return $privilegeManager->has($controllerPriv['id'],$user["id"]);
    }
}
?>