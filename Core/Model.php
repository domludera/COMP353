<?php
    class Model
    {
        public static function resultToArray($sqliResults){
            if(!$sqliResults){
                return $sqliResults;
            }
            $compiled = [];
            while ($row = $sqliResults->fetch_assoc()) {
                $compiled[] = $row;
            }
            return $compiled;
        }


        public function connectDB($sql){
            $conn = Database::getBdd();
            $stmt = $conn->prepare($sql);
            echo mysqli_error($conn);

            return $stmt;
        }

        public function execSQL($stmt){
            $stmt->execute();
            $stmt->close();
        }
    }
?>