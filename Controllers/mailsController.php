<?php

class mailsController extends Controller {

    function index() {
        $this->authed();
        require_once(ROOT . 'Models/Mail.php');
        $mail = new Mail();
        $results["mails"] = Mail::resultToArray($mail->inbox($_SESSION["user"]));
        $this->set($results);
        $this->render("index");
    }

    function create() {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once(ROOT . 'Models/Mail.php');
            $user = new Mail();
            $results = $user->create(
                    $_SESSION["user"], $_POST["to"], $_POST["subject"], $_POST["content"]
            );
            // echo json_encode(Mail::resultToArray($results)[0]);
            $this->redirect("/mails");
        }

        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->render("create");
        }
    }

    function show($id) {
        $this->authed();
        require_once(ROOT . 'Models/Mail.php');
        $mail = new Mail();
        $results["mail"] = Mail::resultToArray($mail->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

}

?>