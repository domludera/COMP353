<?php


class groupsController extends Controller
{

    function index(){
        $this->authed();
        require_once(ROOT . 'Models/Group.php');
        $group = new Group();
        $results["groups"] = Group::resultToArray($group->partOf($_SESSION["user"]));
        $this->set($results);
        $this->render("index");
    }

    function show($id)
    {
        $this->authed();
        require_once(ROOT . 'Models/Group.php');
        require_once(ROOT . 'Models/User.php');
        $group = new Group();
        $results["group"] = Group::resultToArray($group->find($id))[0];
        $results["members"] = Group::resultToArray($group->members($results["group"]["id"]));

        $event = Group::resultToArray($group->event($results["group"]["id"]));
        if($event){
            $event = $event[0];
        }
        $results["event"] = $event;
        $this->set($results);
        $this->render("show");
        // var_dump($results);
    }

    function create($eventId = null){
        $this->authed();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once(ROOT . 'Models/Group.php');
            $group = new Group();

            $groupResult = Group::resultToArray($group->create(
                    $_POST["group_name"],
                    $_SESSION["user"]
                )
            )[0];

            if($_POST["event_id"]){
                $group->addToEvent(
                    $_POST["event_id"],
                    $groupResult["id"]
                );
            }

            if(isset($_POST["invite_ids"])){
                foreach ($_POST["invite_ids"] as $key => $inviteeId) {
                    // TODO: convert this to invites instead of direct joins
                    $group->join($groupResult["id"],$inviteeId);
                }
            }
            
            $this->redirect("/groups/show/".$groupResult["id"]);
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            require_once(ROOT . 'Models/User.php');
            $results = ['eventId' => $eventId];

            $users = new User();
            $results["users"] = User::resultToArray($users->listing());

            $this->set($results);
            $this->render("create");
        }
    }

    function join(){
        $this->authed();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once(ROOT . 'Models/Group.php');
            $group = new Group();

            $group->join(
                $_SESSION["user"],
                $_POST["group_id"]
            );

            $this->redirect("/groups");
        }

        if ($_SERVER['REQUEST_METHOD'] == "GET"){
            $this->render("join");
        }

    }

}