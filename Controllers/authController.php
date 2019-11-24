<?php

class authController extends Controller
{
    function register()
    {
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/User.php');
            $user = new User();
            $parameters = $_POST;
            $results = $user->create(
                $parameters["email"],
                $parameters["password"],
                $parameters["dob"],
                $parameters["region"],
                $parameters["profession"]
            );
            echo json_encode(User::resultToArray($results)[0]);
        }
        
        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->render("register");
        }
    }

    function login()
    {
        session_start(); // needed to access $session array
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/User.php');
            $user = new User();
            $parameters = $_POST;
            $rawResults = $user->validate(
                $parameters["email"],
                $parameters["password"]
            );
            
            // Parse results
            $result = User::resultToArray($rawResults);
            if(isset($result[0])){
                // Store user id (log them in)
                $_SESSION['user'] = $result[0]['id'];
                // echo json_encode($result[0]);
                $this->redirect("/home/home");
            } else{
                echo json_encode(null);
            }
        }
        
        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->render("login");
        }
    }

    function logout()
    {
        session_start(); // needed to access $session array
        if(isset($_SESSION['user']) && $_SESSION['user']){
            unset($_SESSION['user']);
            // echo json_encode([
            //     "message" => "logged out successfully!",
            //     "error" => false
            // ]);
            $this->redirect("/auth/login");
        } else{
            echo json_encode([
                "message" => "Not logged in!",
                "error" => true
            ]);
        }
    }

}
?>