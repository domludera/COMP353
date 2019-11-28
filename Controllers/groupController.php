<?php


class groupController extends Controller
{

    function index(){
        $this->authed();
        require(ROOT . 'Models/Group.php');
        $group = new Group();
        $results["groups"] = Group::resultToArray($group->partOf($_SESSION["user"]));
        $this->set($results);
        $this->render("index");
    }

    function create(){
        $this->authed();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/Group.php');
            $user = new Group();

            $results = $user->createGroup(
                $_POST["groupname"],
                $_SESSION["user"]
            );

            $this->redirect("/group");
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            $this->render("create");
        }
    }

}