<?php
class Privilege extends Model
{
    
    /**
     * Find a given record by its ID
     */
    public function find($id)
    {
        
        if(!$id){
            return $id;
        };
        $sql = "SELECT * FROM privileges WHERE id=?;";

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
     * Find a given record by its ID
     */
    public function byName($name)
    {
        $sql = "SELECT * FROM privileges WHERE name=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "s", // tells you what type the vars will be (check php docs for more info)
            $name
        );
        
        $stmt->execute();
        return $stmt->get_result();
    }


    public function create($name)
    {
            $sql = "INSERT INTO privileges 
                (name) 
                VALUES (?);";

            $conn = Database::getBdd();
            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "s", // tells you what type the vars will be (check php docs for more info)
                $name
            );

            $stmt->execute();
            $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
            $stmt->close();

            return $this->find($insertedId);
    }

    /**
     * Returns boolean of user having the given privilege
     */
    public function has($privilegeId, $userId)
    {
        $sql = "SELECT * FROM user_privilege where privilege_id = ? 
            AND user_id = ?";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $privilegeId,
            $userId
        );

        $stmt->execute();
        return count(Privilege::resultToArray($stmt->get_result())) > 0;
    }

    /**
     * Add Privilege
     */
    public function give($privilegeId, $userId)
    {
        $sql = "INSERT INTO user_privilege 
            (privilege_id, user_id) 
            VALUES (?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);
        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $privilegeId,
            $userId
        );

        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }
}
?>