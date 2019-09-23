<?php

require 'App/Classes/DatabaseConnector.php';

/**
 * Main Execution
 * 
 * Setup required: Have a database with a pre-existing table with data called 'users'
 * Execute app by loading the main index page
 */

//  Settings
$connection = new DatabaseConnector();

// Retrieve all entries
$connection->connect(); // Connect to the DB
$connection->prepare("SELECT * FROM users"); //Prepare an sql statement to be executed
$connection->execute(); // Execute the prepared statement
$results = $connection->get(); // retrieve the results from the statement
$connection->close(); // Close the active connection to the database

// Print to screen
var_dump($results);