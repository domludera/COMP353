<?php
class Comment extends Model
{
    // I don't think we will ever use all this
    public function all()
    {
        $sql = "SELECT * FROM comments;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function byPost($postId)
    {
        $sql = "SELECT * FROM comments
            join users on comments.user_id=users.id
            where post_id = ?
            order by comments.created_at DESC;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        echo mysqli_error($conn);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $postId
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
        $sql = "SELECT * FROM comments where id=?;";

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
        $sql = "INSERT INTO comments 
                (post_id, user_id, content, created_at, updated_at) 
                VALUES (?, ?, ?,?,?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $now = date('Y-m-d H:i:s');
        $stmt->bind_param(
            "iisss", // tells you what type the vars will be (check php docs for more info)
            $groupId,
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