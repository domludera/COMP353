<?php

// TODO: Can't test without having groups done first
class postsController extends Controller
{
    function create($eventId)
    {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once(ROOT . 'Models/Post.php');
            $post = new Post();
            $results = $post->create(
                $eventId,
                $_SESSION["user"],
                $_POST["content"]
            );
            // var_dump(Post::resultToArray($results));
            $this->redirect("/events/show/$eventId");
        }
    }

    // TODO: Can't test without having groups done first
    function show($id)
    {
        $this->authed();
        require_once(ROOT . 'Models/Post.php');
        $post = new Post();
        $results["post"] = Post::resultToArray($post->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

}
?>