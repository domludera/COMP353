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

    public function byEvent($eventId)
    {
        $sql = "SELECT posts.*, users.email FROM posts 
            join users on posts.user_id=users.id
            where event_id = ?
            order by posts.created_at DESC;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        echo mysqli_error($conn);
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $eventId
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

    public function create($eventId,$userId,$content)
    {
        $sql = "INSERT INTO posts 
                (event_id, user_id, content, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $now = date('Y-m-d H:i:s');
        $stmt->bind_param(
            "iisss", // tells you what type the vars will be (check php docs for more info)
            $eventId,
            $userId,
            $content,
            $now,
            $now
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

}
?>