<?php
echo "Seeding: Event Types\n";

// Seeded model
require(ROOT . "Models/EventType.php");

$eventManager = new EventType();
$eventManager->create("Birthday");
$eventManager->create("Office Party");
$eventManager->create("Wedding");
$eventManager->create("Conference");
$eventManager->create("Graduation");
$eventManager->create("Lan Party");