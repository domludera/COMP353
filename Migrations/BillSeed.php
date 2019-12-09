<?php
echo "Seeding: Bill\n";

// Seeded model
require(ROOT . "Models/Bill.php");

$bill = new Bill();
$bill->create(1, 290);