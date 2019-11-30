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
        $stmt->close();

    }

    public function getLastGroupId(){
        $sql = "SELECT MAX(id) FROM groups;";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        echo mysqli_error($conn);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function connectDB($sql){
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        echo mysqli_error($conn);

        return $stmt;
    }

    public function execSQL($stmt){
        $stmt->execute();
        $stmt->close();
    }

    public function joinGroup($userId, $groupid){
        $sql = "INSERT INTO user_group (user_id, group_id) VALUE (?, ?);";
        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "ii",
            $userId,
            $groupid
        );
        $this->execSQL($stmt);
    }

    public function addEventGroup($event, $groupid){
        $sql = "INSERT INTO event_group (event_id, group_id) VALUES (?, ?);";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $stmt->bind_param(
            "ii",
            $event,
            $groupid
        );
        $stmt->execute();
        $stmt->close();

    }

}