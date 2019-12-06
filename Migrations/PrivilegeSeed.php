<?php
echo "Seeding: Privileges\n";

// Seeded model
require(ROOT . "Models/Privilege.php");

$privilegeManager = new Privilege();
$privilegeManager->create("Admin");
$privilegeManager->create("Controller");