<?php
session_start();
class homeController extends Controller
{
    function index()
    {
        $this->render("index");
    }

    function home()
    {

        require(ROOT . 'Models/Event.php');
        $event = new Event();
        $results["currentEvents"] = Event::resultToArray($event->attendingSoon($_SESSION["user"], 5));

		
        $this->set($results);

        //session_start();
        //if($_SESSION["user"]){
            $this->render("home");
        //} else{
            //$this->redirect("/auth/login");
		//	$this->redirect("/");
       //}
    }
}
?>