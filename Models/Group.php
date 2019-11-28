<?php


class Group extends Model
{
    public function partOf($userId){
        $sql = "SELECT * FROM user_group WHERE user_id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i",
            $userId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function createGroup($name, $owner){
        $sql = "INSERT INTO groups (name, owner_id) VALUES (?, ?);";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $stmt->bind_param(
            "si",
            $name,
            $owner
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id;
        $stmt->close();

        return $this->find($insertedId);
    }
}