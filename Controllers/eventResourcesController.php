<?php

class eventResourcesController extends Controller {

    function index() {
        $this->authed();
        require_once(ROOT . 'Models/EventResources.php');
        $eventResource = new Resource();
        $results["eventResources"] = Resource::resultToArray($eventResource->all());
        $this->set($results);
        $this->render("index");
    }

    function show($id) {
        $this->authed();
        require_once(ROOT . 'Models/EventResources.php');
        $eventResource = new Resource();
        $results["eventResources"] = Resource::resultToArray($eventResource->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

   
}

?>