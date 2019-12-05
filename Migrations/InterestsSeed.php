<?php
echo "Seeding: Interests\n";

// Seeded model
require(ROOT . "Models/Interest.php");

$eventManager = new Interest();
$eventManager->create("Computer Science");
$eventManager->create("Software Engineering");
$eventManager->create("Physics");
$eventManager->create("Biology");