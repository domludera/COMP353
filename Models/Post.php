<?php
class Post extends Model
{
    // I don't think we will ever use all this
    public function all()
    {
        $sql = "SELECT * FROM posts;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function byGroup($groupId)
    {
        $sql = "SELECT * FROM posts where group_id = ?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $groupId
        );

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
        $sql = "SELECT * FROM posts where id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        echo mysqli_error($conn);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $id
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($groupId,$userId,$content)
    {
        $sql = "INSERT INTO posts 
                (group_id, user_id, content) 
                VALUES (?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $stmt->bind_param(
            "iis", // tells you what type the vars will be (check php docs for more info)
            $groupId,
            $userId,
            $content
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

}
?>