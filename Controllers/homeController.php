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