<?php
class BilledEventResources extends Model
{
    public function all()
    {
		$sql = "SELECT * FROM billed_event_resources 
				JOIN event_resources ON billed_event_resources.event_resources_id = event_resources.id
				JOIN bill ON billed_event_resources.bill_id = bill.id;";
      
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
		$sql = "SELECT billed_event_resources.id, billed_event_resources.bill_id, event_resources.start_at, event_resources.end_at, bill.total FROM billed_event_resources 
				JOIN event_resources ON billed_event_resources.event_resources_id = event_resources.id
				JOIN bill ON billed_event_resources.bill_id = bill.id WHERE WHERE event_resources.event_id=?;";
    

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
     * Creates a billed event resource
     */
    public function create($id,$bill_id,$start,$end,$total)
    {
        $sql = "INSERT INTO billed_event_resources
                (id, bill_id, start_at, end_at, total) 
                VALUES (?, ?, ?, ?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "sissii", // tells you what type the vars will be (check php docs for more info)
            $id,
            $bill_id,
            $start,
            $end,
			$total
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }


}
?>