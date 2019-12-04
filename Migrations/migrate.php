<?php

// Define the start of the project directory
if(strpos(php_uname(), 'Linux') !== false){
	define('ROOT', getcwd() . "/../");
}else{
	define('ROOT', getcwd() . "\\..\\");
}

// include configuration file ( Includes all base classes for the MVC)
require(ROOT . 'Config/core.php');

echo "Migrating Database";

$dbConfigs = parse_ini_file('../Config/config.ini');
$script_path = 'migrations.sql';
// Create the DB
$command = 'mysql'
        . ' --host=' . $dbConfigs['servername']
        . ' --user=' . $dbConfigs['username']
        . ' --password=' . $dbConfigs['password']
        . ' --execute="SOURCE ' . $script_path
;

shell_exec($command);

// Call seeding files
include 'EventTypesSeed.php';
include 'UserSeed.php';
