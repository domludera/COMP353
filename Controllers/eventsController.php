<?php

class eventsController extends Controller
{
    
    function index()
    {
        $this->authed();
        require_once(ROOT . 'Models/Event.php');
        $event = new Event();
        $results["events"] = Event::resultToArray($event->all());
        $this->set($results);
        $this->render("index");
    }

    function create()
    {
        $this->authed();

        require_once(ROOT . 'Models/User.php');
        
        // Get current user
        $user = new User();
        // var_dump($user->isAdmin($_SESSION["user"]));
        if(!$user->isAdmin($_SESSION["user"])){
            $this->redirect("/events");
        }

        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once(ROOT . 'Models/Event.php');
            require_once(ROOT . 'Models/Group.php');
            
            $event = new Event();
            $eventResult = Event::resultToArray(
                $event->create(
                    $_POST["name"],
                    $_POST["type"],
                    $_POST["start"],
                    $_POST["end"],
                    (isset($_POST["reoccuring"]) && $_POST["reoccuring"] == 'on') ? true : false,
                    $_POST["manager_id"]
                )
            )[0];
			
			//Create event group
			$group = new Group();
			$groupName = $_POST["name"] . " group";
			$groupResult = Group::resultToArray(
				$group->create(
					$groupName,
					$_POST["manager_id"])
				)[0];
			
			$group->addToEvent(
				$eventResult["id"],
				$groupResult["id"]);
				
            
            if(isset($_POST["attending_ids"])){
                foreach ($_POST["attending_ids"] as $key => $attenderId) {
                    $event->attend($eventResult["id"],$attenderId);
					$group->join($groupResult["id"],$attenderId);
                }
            }

            $this->redirect("/events");

        }
        
        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
                
            require_once(ROOT . 'Models/EventType.php');
            require_once(ROOT . 'Models/User.php');
            $eventType = new EventType();
            $results["EventTypes"] = EventType::resultToArray($eventType->all());
            
            $users = new User();
            $results["users"] = User::resultToArray($users->listing());

            $this->set($results);
            $this->render("create");
        }
    }

    function show($id)
    {
        $this->authed();
        require_once(ROOT . 'Models/Event.php');
        require_once(ROOT . 'Models/Group.php');
        $event = new Event();
        $group = new Group();
        $results["event"] = Event::resultToArray($event->find($id))[0];
        $results["attendees"] = Event::resultToArray($event->attendees($results["event"]["id"]));

        $results["groups"] = Event::resultToArray($event->groups($results["event"]["id"]));
        
        // var_dump($results);
        $this->set($results);
        $this->render("show");
    }

    function managing()
    {
        $this->authed();
        require_once(ROOT . 'Models/Event.php');
        require_once(ROOT . 'Models/User.php');

        // Get current user
        $user = new User();
        $authed =  User::resultToArray($user->find($_SESSION["user"]))[0];
        
        $event = new Event();
        $results["events"] = Event::resultToArray($event->managed($authed["id"]));

        $this->set($results);
        $this->render("managing");
    }

    function attending()
    {
        $this->authed();
        require_once(ROOT . 'Models/Event.php');
        require_once(ROOT . 'Models/User.php');

        // Get current user
        $user = new User();
        $authed =  User::resultToArray($user->find($_SESSION["user"]))[0];

        $event = new Event();
        $results["events"] = Event::resultToArray($event->attending($authed["id"]));

        $this->set($results);
        $this->render("attending");
    }

}
?>