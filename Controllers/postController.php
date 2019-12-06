<?php

// TODO: Can't test without having groups done first
class postController extends Controller
{
    function create()
    {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require(ROOT . 'Models/Post.php');
            $post = new Post();
            $results = $post->create(
                $_POST["group_id"],
                $_POST["user_id"],
                $_POST["content"]
            );
            // echo json_encode(Mail::resultToArray($results)[0]);
            $this->redirect("/post");
        }
    }

    // TODO: Can't test without having groups done first
    function show($id)
    {
        $this->authed();
        require(ROOT . 'Models/Post.php');
        $post = new Post();
        $results["post"] = Post::resultToArray($post->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

}
?>