<?php
/**
 * This is the first page that is hit by the php request
 * We are redirected here by the root .htaccess file
 * 
 * We compule the request and handle it using the dispatcher class
 */

// Define the start of the web route directory
define('WEBROOT', str_replace("Webroute/index.php", "", $_SERVER["SCRIPT_NAME"]));

// Define the start of the project directory
define('ROOT', str_replace("Webroute/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

// include configuration file ( Includes all base classes for the MVC)
require(ROOT . 'Config/core.php');

// Require the essential routing classes needed for directign traffic
require(ROOT . 'router.php'); // Breaks down the request into constituant parts
require(ROOT . 'request.php'); // custom request to extend request functionality
require(ROOT . 'dispatcher.php'); // does the redirect to the correct controllers' actions

// Instanciate the main routing class
// Route the route the incoming request
$dispatch = new Dispatcher();
$dispatch->dispatch();
?>