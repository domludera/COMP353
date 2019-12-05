<?php
echo "Seeding: Users\n";

// Seeded model
require(ROOT . "Models/User.php");

$userManager = new User();
$userManager->create("erik@353.com", "secret", "Erik", "2019-11-13", "Montreal", "Student");
$userManager->create("dom@353.com", "secret", "Dominik", "2019-11-13", "Montreal", "Student");
$userManager->create("priscilla@353.com", "secret", "Priscilla", "2019-11-13", "Montreal", "Student");
$userManager->create("zach@353.com", "secret", "Zachary", "2019-11-13", "Montreal", "Student");
$userManager->create("hugo@353.com", "secret", "Hugo", "2019-11-13", "Montreal", "Student");