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
        $sql = "SELECT events.*, event_types.name as type FROM events 
            join event_types on events.event_type_id=event_types.id
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
     * Create new user TODO:: Check if email already in use
     */
    public function create($name,$type,$start,$end,$reoccuring)
    {
        // var_dump($reoccuring);
        $sql = "INSERT INTO events 
                (name , event_type_id, start_at , end_at , reoccuring) 
                VALUES (?, ?, ?, ?,?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $stmt->bind_param(
            "sissi", // tells you what type the vars will be (check php docs for more info)
            $name,
            $type,
            $start,
            $end,
            $reoccuring
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

}
?>