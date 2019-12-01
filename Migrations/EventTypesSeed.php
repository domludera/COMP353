<?php
echo "Seeding: Event Types\n";

// Seeded model
require(ROOT . "Models/EventType.php");

$eventManager = new EventType();
$eventManager->create("Birthday");
$eventManager->create("Office Party");
