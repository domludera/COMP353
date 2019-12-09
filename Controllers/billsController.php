<?php

class billsController extends Controller {

    function index() {
        $this->authed();
        require_once(ROOT . 'Models/Bill.php');
        $bill = new Bill();
        $results["bills"] = Bill::resultToArray($bill->all());
        $this->set($results);
        $this->render("index");
    }

    function show($id) {
        $this->authed();
        require_once(ROOT . 'Models/Bill.php');
		require_once(ROOT . 'Models/EventResources.php');
        $bill = new Bill();
		$eventResources = new EventResources();
		$results["bills"] = Bill::resultToArray($bill->find($id))[0];
        $results["eventResources"] = Bill::resultToArray($bill->eventResources($id))[0];
        $this->set($results);
        $this->render("show");
    }

}

?>