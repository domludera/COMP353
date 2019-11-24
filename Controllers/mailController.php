<?php

class mailController extends Controller
{
    
    function index()
    {
        $this->authed();
        
        require(ROOT . 'Models/Mail.php');
        $mail = new Mail();
        $results["mails"] = Mail::resultToArray($mail->inbox($_SESSION["user"]));
        // $results["mails"] = $mail->inbox($_SESSION["user"]);
        // var_dump($results,$_SESSION["user"]);
        $this->set($results);
        $this->render("index");
    }

    function create()
    {
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/Mail.php');
            $user = new Mail();
            $results = $user->create(
                $_SESSION["user"],
                $_POST["to"],
                $_POST["subject"],
                $_POST["content"]
            );
            // echo json_encode(Mail::resultToArray($results)[0]);
            $this->redirect("/mail");
        }
        
        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->render("create");
        }
    }


}
?>