<?php

// TODO: Can't test without having groups done first
class commentsController  extends Controller
{
    function create()
    {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/Comment.php');
            $comment = new Comment();
            $results = $comment->create(
                $_POST["post_id"],
                $_POST["user_id"],
                $_POST["content"]
            );
            // echo json_encode(Mail::resultToArray($results)[0]);
            // $this->redirect("home");
        }
    }

    // TODO: Can't test without having groups done first
    function show($id)
    {
        $this->authed();
        require(ROOT . 'Models/Comment.php');
        $comment = new Comment();
        $results["comment"] = Comment::resultToArray($comment->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

}
?>