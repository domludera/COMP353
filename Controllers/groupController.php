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

            $user->createGroup(
                $_POST["groupname"],
                $_SESSION["user"],
                $_POST["event_name"]
            );
            $group = new Group();
            $groupId = Group::resultToArray($group->getLastGroupId())[0];
            $user->addEventGroup(
                $_POST['event_name'],
                $groupId["MAX(id)"]
            );

            $this->redirect("/group");
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            $this->render("create");
        }
    }

    function join(){
        $this->authed();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/Group.php');
            $user = new Group();

            $user->joinGroup(
                $_SESSION["user"],
                $_POST["groupid"]
            );

            $this->redirect("/group");
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            $this->render("join");
        }

    }

}