<?php
class EventResources extends Model
{
    public function all()
    {
		$sql = "SELECT event_resources.* FROM event_resources 
				JOIN events ON event_resources.event_id = events.id
				JOIN resources ON event_resources.resource_id = resources.id;";
       
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
		$sql = "SELECT event_resources.*, events.name AS event_name, resources.name AS resource_name FROM event_resources 
				JOIN events ON event_resources.event_id = events.id
				JOIN resources ON event_resources.resource_id = resources.id;
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
     * Creates an event resource
     */
    public function create($eventId,$resourceId,$rate,$start,$end)
    {
        $sql = "INSERT INTO event_resources
                (event_id , resource_id, rate, start_at, end_at) 
                VALUES (?, ?, ?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "iiidd", // tells you what type the vars will be (check php docs for more info)
            $eventId,
            $resourceId,
			$rate,
            $start,
            $end
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

    public function getAllResources($id){
		if(!$id){
            return $id;
        };
		$sql = "SELECT resources.name AS resource_name, event_resources.rate FROM event_resources 
				JOIN events ON event_resources.event_id = events.id
				JOIN resources ON event_resources.resource_id = resources.id
				WHERE event_resources.event_id=?;";
				
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

}
?>