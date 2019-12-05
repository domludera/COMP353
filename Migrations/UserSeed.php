<?php
echo "Seeding: Users\n";

// Seeded model
require(ROOT . "Models/User.php");
// require(ROOT . "Models/Privilege.php"); // Already declared!

$userManager = new User();
$privilegeManager = new Privilege();
$userManager->create("erik@353.com", "secret", "Erik", "2019-11-13", "Montreal", "Student");
$userManager->create("dom@353.com", "secret", "Dominik", "2019-11-13", "Montreal", "Student");
$userManager->create("priscilla@353.com", "secret", "Priscilla", "2019-11-13", "Montreal", "Student");
$userManager->create("zach@353.com", "secret", "Zachary", "2019-11-13", "Montreal", "Student");
$userManager->create("hugo@353.com", "secret", "Hugo", "2019-11-13", "Montreal", "Student");

// Privileged users
$admin = User::resultToArray(
    $userManager->create("admin@353.com", "secret", "Admin Name", "2019-11-13", "Montreal", "Admin")
)[0];

$controller = User::resultToArray(
    $userManager->create("controller@353.com", "secret", "Controller Name", "2019-11-13", "Montreal", "Controller")
)[0];

// Privilege assignment
$adminPriv = Privilege::resultToArray($privilegeManager->byName('admin'))[0];
$privilegeManager->give($adminPriv["id"],$admin["id"]);

$controllerPriv = Privilege::resultToArray($privilegeManager->byName('controller'))[0];
$privilegeManager->give($controllerPriv["id"],$controller["id"]);
