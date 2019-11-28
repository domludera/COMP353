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
    }
?>