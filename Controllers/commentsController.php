<?php

// TODO: Can't test without having groups done first
class commentsController  extends Controller
{
    function create($postId)
    {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once(ROOT . 'Models/Comment.php');
            require_once(ROOT . 'Models/Post.php');
            $post = new Post();
            $comment = new Comment();
            $results = $comment->create(
                $postId,
                $_SESSION["user"],
                $_POST["content"]
            );

            $eventId = Post::resultToArray($post->find($postId))[0]["event_id"];
            $this->redirect("/events/show/$eventId");
        }
    }

    // TODO: Can't test without having groups done first
    function show($id)
    {
        $this->authed();
        require_once(ROOT . 'Models/Comment.php');
        $comment = new Comment();
        $results["comment"] = Comment::resultToArray($comment->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

}
?>