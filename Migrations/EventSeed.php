<?php
echo "Seeding: Events\n";

// Seeded model
require(ROOT . "Models/Event.php");

$eventManager = new Event();
$userManager = new User();

$zach = User::resultToArray($userManager->byEmail("zach@353.com"))[0];
$eventManager->create("Zach's BirthdayParty",1,"2020-03-15","2020-03-15",1,$zach);

$eventManager->create("Group 22 Party",2,"2019-12-10","2019-12-12",0,1);

$eventManager->attend(1, $zach);
$eventManager->attend(2, 1);
$eventManager->attend(2, 2);
$eventManager->attend(2, 3);
$eventManager->attend(2, 4);
$eventManager->attend(2, 5);