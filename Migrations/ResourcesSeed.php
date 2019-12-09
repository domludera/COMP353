<?php
echo "Seeding: Resources \n";

// Seeded model
require(ROOT . "Models/Resource.php");

$resources = new Resource();
$resources->create("Base Event Fee","1 Time Charge", 100);
$resources->create("Storage", "5GB / month", 100);
$resources->create("Base Bandwith","5GB / month", 100);
$resources->create("Storage Overage","Per 1GB exceeded", 15);
$resources->create("Bandwith Add On","Per additional 1GB", 15);
$resources->create("Reoccuring Event Discount","Per month", -10);