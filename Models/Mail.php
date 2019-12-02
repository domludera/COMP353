<?php
class Mail extends Model
{
    
    /**
     * Find a given record by its ID
     */
    public function find($id)
    {
        
        if(!$id){
            return $id;
        };
        $sql = "SELECT * FROM mails WHERE id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $id
        );
        
        $stmt->execute();
        return $stmt->get_result();
    }

	public function findAll($id)
    {        
        if(!$id){
            return $id;
        };
        $sql = "SELECT * FROM mails WHERE to_user_id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $id
        );
        
        $stmt->execute();
        return $stmt->get_result();
    }
	
    public function inbox($userId){
        $sql = "SELECT * FROM mails WHERE to_user_id = ?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $userId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($from,$to,$subject,$content)
    {
            $sql = "INSERT INTO mails 
                (from_user_id ,to_user_id ,subject , content) 
                VALUES (?, ?, ?, ?);";

            $conn = Database::getBdd();
            $stmt = $conn->prepare($sql);

            echo mysqli_error($conn);

            $stmt->bind_param(
                "iiss", // tells you what type the vars will be (check php docs for more info)
                $from,
                $to,
                $subject,
                $content
            );
            $stmt->execute();
            $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
            $stmt->close();

            return $this->find($insertedId);
    }

}
?>