<?php

class userController extends Controller
{
    
    function index()
    {
        $this->authed();
        require(ROOT . 'Models/User.php');
        $user = new User();
        $results["user"] = User::resultToArray($user->all())[0];
        $this->set($results);
        $this->render("index");
    }

    function self()
    {
        $this->authed();
        require(ROOT . 'Models/User.php');
        $user = new User();
        $results["user"] = User::resultToArray($user->find($_SESSION["user"]))[0];
        $this->set($results);
        $this->render("self");
    }
}
?>