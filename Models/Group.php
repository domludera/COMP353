<?php


class Group extends Model
{
     /**
     * Find a given record by its ID
     */
    public function find($id)
    {
        if(!$id){
            return $id;
        };
        $sql = "SELECT app_groups.*, users.email as owner FROM app_groups 
            join users on app_groups.owner_id=users.id
            where app_groups.id=?;";

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

    public function partOf($userId){
        $sql = "SELECT * FROM user_group
            join app_groups on user_group.group_id=app_groups.id
            WHERE user_id=?;";

        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "i",
            $userId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($name, $owner){
        $sql = "INSERT INTO app_groups (name, owner_id) VALUES (?, ?);";
        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "si",
            $name,
            $owner
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

    // public function getLastGroupId(){
    //     $sql = "SELECT MAX(id) FROM app_groups;";
    //     $stmt = $this->connectDB($sql);
    //     return $this->execSQL($stmt);
    // }

    public function join($groupid, $userId){
        $sql = "INSERT INTO user_group (user_id, group_id) VALUE (?, ?);";
        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "ii",
            $userId,
            $groupid
        );
        $this->execSQL($stmt);
    }

    public function addToEvent($eventId, $groupid){
        $sql = "INSERT INTO event_group (event_id, group_id) VALUES (?, ?);";
        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "ii",
            $eventId,
            $groupid
        );
        $this->execSQL($stmt);
    }

    /**
     * Get associated Event
     */
    public function event($groupId){
        $sql = "SELECT * FROM event_group
            join events on event_group.event_id=events.id
            WHERE group_id=?;";

        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "i",
            $groupId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    // List members
    public function members($groupId){
        $sql = "SELECT user_group.* , users.email FROM user_group 
        join users on user_group.user_id=users.id
        WHERE user_group.group_id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $groupId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

}