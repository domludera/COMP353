<?php

/**
 * Custom class connects to database, execute statements and retireve results
 * as either collections or single items.
 */
class DatabaseConnector{

    // Database information
    // These should go into a .env file
    const HOST = "localhost";
    const USERNAME = "homestead";
    CONST PASSWORD = "secret";
    CONST DATABASE = "tft";

    // Private variables
    private $connection = null;
    private $statement = null;

    /**
     * Public methods
     */

    // Establish a live connection with the database we want to execute commands on.
    public function connect(){
        $this->connection = new PDO('mysql:host='.self::HOST.';dbname=' . self::DATABASE,  self::USERNAME,  self::PASSWORD);
        return $this->connection;
    }

    // Prepare a statement to be executed
    // NOTE: This does not execute the command directly
    public function prepare($query){
        $this->statement = $this->connection->prepare($query);
        return $this->statement;
    }

    // Execute the stored prepared statement.
    // NOTE: This does not retrieve the results.
    public function execute(){
        return $this->statement->execute();
        return $values;
    }

    // Retrieve a collection of items that resulted from the statement execution
    public function get(){
        return $this->statement->fetchAll();
    }

    // Retrieve a single item (first item) that resulted from the statement execution
    public function first(){
        $values = $this->statement->fetchAll();
        if(count($values) == 0){
            return null;
        }
        return $values[0];
    }

    // Terminate all connections to the database
    // Done by setting pointers to null
    public function close(){
        $this->connection = null;
        $this->statement = null;
    }
}