<?php
echo "Seeding: Events\n";

// Seeded model
require(ROOT . "Models/Event.php");
require(ROOT . "Models/Group.php");

$eventManager = new Event();
$groupManager = new Group();
$userManager = new User();

$zach = User::resultToArray($userManager->byEmail("zach@353.com"))[0];
$eventManager->create("Zach's Birthday Party",1,"2020-03-15","2020-03-15",1,$zach);
$groupManager->create("Zach's Birthday Party group",$zach);
$groupManager->addToEvent(1, 1);
$groupManager->join(1, $zach);


$eventManager->create("Group 22 Party",2,"2019-12-10","2019-12-12",0,1);
$groupManager->create("Group 22 Party group",$zach);
$groupManager->addToEvent(2, 2);

$eventManager->attend(2, 1);
$groupManager->join(2, 1);
$eventManager->attend(2, 2);
$groupManager->join(2, 2);
$eventManager->attend(2, 3);
$groupManager->join(2, 3);
$eventManager->attend(2, 4);
$groupManager->join(2, 4);
$eventManager->attend(2, 5);
$groupManager->join(2, 5);