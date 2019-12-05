<?php
class Event extends Model
{
    public function all()
    {
        $sql = "SELECT events.* FROM events 
            join event_types on events.event_type_id=event_types.id;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
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
        $sql = "SELECT events.*, event_types.name as type, users.email as manager_email FROM events 
            join event_types on events.event_type_id=event_types.id
            join users on events.manager_id=users.id
            WHERE events.id=?;";

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

    /**
     * Creates an event
     */
    public function create($name,$type,$start,$end,$reoccuring, $managerId)
    {
        $sql = "INSERT INTO events 
                (name , event_type_id, start_at , end_at , reoccuring, manager_id) 
                VALUES (?, ?, ?, ?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sissii", // tells you what type the vars will be (check php docs for more info)
            $name,
            $type,
            $start,
            $end,
            $reoccuring,
            $managerId
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

    public function managed($managerId){
        $sql = "SELECT events.*, event_types.name as type FROM events 
            join event_types on events.event_type_id=event_types.id
            WHERE events.manager_id=?;";
            
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $managerId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    
    /**
     * Groups Section
     */
    public function groups($eventId){
        $sql = "SELECT * FROM event_group
            join app_groups on event_group.group_id=app_groups.id
            WHERE event_id=?;";

        $stmt = $this->connectDB($sql);
        $stmt->bind_param(
            "i",
            $eventId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Attendance Section
     */
    public function attend($eventId,$userId){
        $sql = "INSERT INTO user_attending 
        (event_id, user_id) 
        VALUES (?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $eventId,
            $userId
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

    public function isAttending($eventId, $userId){
        $sql = "SELECT * FROM user_attending 
            WHERE event_id = ? AND user_id =?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii", // tells you what type the vars will be (check php docs for more info)
            $eventId,
            $userId
        );
        $stmt->execute();
        $found = Event::resultToArray($stmt->get_result());

        return count($found) > 0;
    }

    // List attendees
    public function attendees($eventId){
        $sql = "SELECT user_attending.* , users.email FROM user_attending 
        join users on user_attending.user_id=users.id
        WHERE user_attending.event_id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $eventId
        );
        $stmt->execute();
        return $stmt->get_result();
    }

    public function attending($userId){
        $sql = "SELECT events.*, event_types.name as type FROM events 
            join event_types on events.event_type_id=event_types.id
            WHERE events.id in (
                select event_id from user_attending where user_id = ?
            );";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $userId
        );
        $stmt->execute();
        return $stmt->get_result();
    }
	
	//Finds all events for a user over the next $days days
    public function attendingSoon($userId, $days){
        $sql = "SELECT events.*, event_types.name as type FROM events 
            join event_types on events.event_type_id=event_types.id
            WHERE events.id in (
                select event_id from user_attending where user_id = ?
            )
			AND events.start_at >= CURDATE()
			AND events.start_at <= CURDATE() + ?
			ORDER BY events.start_at;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "is", // tells you what type the vars will be (check php docs for more info)
            $userId,
			$days
        );
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>