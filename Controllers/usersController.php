<?php

class usersController extends Controller {

    function index() {
        $this->authed();
        require_once(ROOT . 'Models/User.php');
        $user = new User();
        $results["user"] = User::resultToArray($user->all())[0];
        $this->set($results);
        $this->render("index");
    }

    function edit() {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once(ROOT . 'Models/User.php');
            $user = new User();
            $id = $_SESSION["user"];
            //var_dump($_FILES);exit;
            if (isset($_POST["email"])) {
                if ($user->edit($id, $_POST["email"], $_POST["profession"], $_POST["dob"], $_POST["name"], $_POST["region"], $_FILES["fileToUpload"])) {
                    $this->render("self");
                }
            }

            $results["user"] = User::resultToArray($user->find($_SESSION["user"]))[0];
            $this->set($results);
            $this->render("self");
        }

        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->authed();
            require_once(ROOT . 'Models/User.php');
            $user = new User();
            $results["user"] = User::resultToArray($user->find($_SESSION["user"]))[0];
            $this->set($results);
            $this->render("edit");
        }
    }

    function self() {
    $this->authed();
    require_once(ROOT . 'Models/User.php');
    $user = new User();
    $results["user"] = User::resultToArray($user->find($_SESSION["user"]))[0];
    $this->set($results);
    $this->render("self");
}

}

?>
