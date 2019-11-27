<?php

class eventController extends Controller
{
    
    function index()
    {
        $this->authed();
        require(ROOT . 'Models/Event.php');
        $event = new Event();
        $results["events"] = Event::resultToArray($event->all());
        $this->set($results);
        $this->render("index");
    }

    function create()
    {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/Event.php');
            var_dump($_POST);
            $event = new Event();
            $results = $event->create(
                $_POST["name"],
                $_POST["type"],
                $_POST["start"],
                $_POST["end"],
                (isset($_POST["reoccuring"]) && $_POST["reoccuring"] == 'on') ? true : false
            );
            // echo json_encode(Mail::resultToArray($results)[0]);
            $this->redirect("/event");
        }
        
        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
                
            require(ROOT . 'Models/EventType.php');
            $eventType = new EventType();
            $results["EventTypes"] = EventType::resultToArray($eventType->all());
            $this->set($results);
            $this->render("create");
        }
    }

    function show($id)
    {
        $this->authed();
        require(ROOT . 'Models/Event.php');
        $event = new Event();
        $results["event"] = Event::resultToArray($event->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

}
?>