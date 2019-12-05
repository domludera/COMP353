<?php
class Interest extends Model
{
    public function all()
    {
        $sql = "SELECT * FROM interests;";

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
        $sql = "SELECT * FROM interests WHERE id=?;";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param(
            "i", // tells you what type the vars will be (check php docs for more info)
            $id
        );
        $stmt->execute();
        return $stmt->get_result();
    }


    public function create($name)
    {
        $sql = "INSERT INTO interests 
                (name) 
                VALUES (?);";

        $conn = Database::getBdd();
        $stmt = $conn->prepare($sql);

        echo mysqli_error($conn);

        $stmt->bind_param(
            "s", // tells you what type the vars will be (check php docs for more info)
            $name
        );
        $stmt->execute();
        $insertedId = $stmt->insert_id; // get le id of the last inserted auto increment record
        $stmt->close();

        return $this->find($insertedId);
    }

}
?>