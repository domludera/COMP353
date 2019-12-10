<?php

class Bill extends Model {

    public function all() {
        $sql = "SELECT * FROM bill;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Find a given record by its ID
     */
    public function find($id) {
        if (!$id) {
            return $id;
        };
		$sql = "SELECT Distinct bill.id, event_resources.start_at AS start_at, event_resources.end_at AS end_at, bill.total FROM bill 
				JOIN billed_event_resources ON bill.id = billed_event_resources.bill_id
				JOIN event_resources ON bill.event_id = event_resources.event_id 
				WHERE bill.id=?;";
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
     * Creates a bill
     */
    public function create($event_id, $total) {
        $sql = "INSERT INTO bill 
                (event_id , total) 
                VALUES (?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "ii", // tells you what type the vars will be (check php docs for more info)
                $event_id,
				$total
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }
	
	/**
     * Event Resources Section
     */
     public function eventResources($id){
		if(!$id){
            return $id;
        };
		$sql = "SELECT resources.name AS resource_name, resources.rate FROM event_resources 
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