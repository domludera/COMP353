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

    function update() {
        $this->authed();
        require(ROOT . 'Models/User.php');
        $user = new User();
        $id = $_SESSION["user"];
        //var_dump($_FILES);exit;
        if (isset($_POST["email"])) {
            if ($user->edit($id, $_POST["email"], $_POST["profession"], $_POST["dob"], $_POST["password"], $_POST["name"], $_POST["region"], $_FILES["fileToUpload"])) {
                header("Location: " . WEBROOT . "users/self");
            }
        }

        $results["user"] = User::resultToArray($user->find($_SESSION["user"]))[0];
        $this->set($results);
        $this->render("self");
    }

    function edit() {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!class_exists('Mail')) {
                require(ROOT . 'Models/User.php');
            }
            //require(ROOT . 'Models/Mail.php');
            $user = new Mail();
            $results = $user->create(
                    $_SESSION["user"], $_POST["to"], $_POST["subject"], $_POST["content"]
            );
            // echo json_encode(Mail::resultToArray($results)[0]);
            $this->redirect("/users");
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