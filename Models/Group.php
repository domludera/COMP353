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

    public function isMembers($groupId, $userId){
        $sql = "SELECT user_group.* FROM user_group
            WHERE group_id=? AND user_id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $groupId,
            $userId
        );
        $stmt->execute();
        return count(Group::resultToArray($stmt->get_result())) > 0;
    }

    public function isOwner($groupId, $userId){
        $group = Group::resultToArray($this->find($groupId))[0];
        return $group["owner_id"] == $userId;
    }

    public function requests($groupId){
        $sql = "SELECT group_request.*, users.email FROM group_request 
            join users on group_request.user_id=users.id
            WHERE group_id=?;";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $groupId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function request($groupId, $userId){
        $sql = "INSERT INTO group_request (group_id, user_id) VALUES (?, ?);";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $groupId,
            $userId
        );
        $stmt->execute();
        $stmt->close();

        return $this->findRequest($groupId, $userId);
    }

    public function findRequest($groupId, $userId){
        
        $sql = "SELECT * FROM group_request 
            WHERE group_id = ? AND user_id =?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $groupId,
            $userId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function hasPendingRequest($groupId, $userId){
        $request = Group::resultToArray($this->findRequest($groupId, $userId));
        return count($request) > 0;
    }

    public function approve($groupId, $userId){
        if($this->hasPendingRequest($groupId, $userId)){
            $this->join($groupId, $userId);
    
            $sql = "INSERT INTO group_request (group_id, user_id) VALUES (?, ?);";
            $conn = Database::getBdd();
            $stmt = $conn->prepare($sql);
    
            $stmt->bind_param(
                "ii", // tells you what type the vars will be (check php docs for more info)
                $groupId,
                $userId
            );
            $stmt->execute();
            $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
            $stmt->close();
    
            $this->deleteRequest($groupId, $userId);
            return $this->find($insertedId);
        }
        
        return null;
    }

    public function deleteRequest($groupId, $userId){
        $sql = "DELETE FROM group_request where group_id=? AND user_id=?;";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $groupId,
            $userId
        );
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function leaveGroup($groupId, $userId){
        $sql = "DELETE FROM user_group where user_id=? AND group_id=?;";
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $userId,
            $groupId
        );
        $stmt->execute();
        $stmt->close();
        return true;
    }
	
}