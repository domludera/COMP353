<?php


class Group extends Model
{
    public function partOf($userId){
        $sql = "SELECT * FROM user_group WHERE user_id=?;";

        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "i",
            $userId
        );
        return $this->execSQL($stmt);
    }

    public function createGroup($name, $owner){
        $sql = "INSERT INTO groups (name, owner_id) VALUES (?, ?);";
        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "si",
            $name,
            $owner
        );
        $this->execSQL($stmt);
    }

    public function getLastGroupId(){
        $sql = "SELECT MAX(id) FROM groups;";
        $stmt = $this->connectDB($sql);
        return $this->execSQL($stmt);
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

    public function addToEvent($event, $groupid){
        $sql = "INSERT INTO event_group (event_id, group_id) VALUES (?, ?);";
        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "ii",
            $event,
            $groupid
        );
        $this->execSQL($stmt);
    }

}