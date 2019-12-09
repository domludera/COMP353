<?php

class Resource extends Model {

    public function all() {
        $sql = "SELECT * FROM resources;";

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
        $sql = "SELECT * FROM resources WHERE resources.id=?;";

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
     * Creates a resource
     */
    public function create($name, $rate) {
        $sql = "INSERT INTO resources 
                (name , rate) 
                VALUES (?, ?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "si", // tells you what type the vars will be (check php docs for more info)
                $name, $rate
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

    public function changeRate($id, $rate) {        
        $sql = "UPDATE resources SET rate = ? WHERE id=?;";
             
        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
                "ii", // tells you what type the vars will be (check php docs for more info)
                $rate, $id
        );        
        $stmt->execute();
        return $stmt->get_result();
    }

}

?>