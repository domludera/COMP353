<?php
echo "Seeding: Event Resources\n";

// Seeded model
require(ROOT . "Models/EventResources.php");

$eventResources = new EventResources();
$eventResources->create(1, 1, 100, "2020-03-15","2020-03-15");
$eventResources->create(1, 2, 100, "2020-03-15","2020-03-15");
$eventResources->create(1, 3, 100, "2020-03-15","2020-03-15");
$eventResources->create(1, 6, -10, "2020-03-15","2020-03-15");
