<?php
echo "Seeding: Billed Event Resources\n";

// Seeded model
require(ROOT . "Models/BilledEventResources.php");
$billedEventResources = new BilledEventResources();
$billedEventResources->create(1, 1);
$billedEventResources->create(1, 2);
$billedEventResources->create(1, 3);
$billedEventResources->create(1, 6);