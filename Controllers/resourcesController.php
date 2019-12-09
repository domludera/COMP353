<?php

class resourcesController extends Controller {

    function index() {
        $this->authed();
        require_once(ROOT . 'Models/Resource.php');
        $resource = new Resource();
        $results["resources"] = Resource::resultToArray($resource->all());
        $this->set($results);
        $this->render("index");
    }

    function show($id) {
        $this->authed();
        require_once(ROOT . 'Models/Resource.php');
        $resouce = new Resource();
        $results["resources"] = Resource::resultToArray($resource->find($id))[0];
        $this->set($results);
        $this->render("show");
    }

    function edit() {
        $this->authed();
        // METHOD: POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //var_dump($_POST);

            require_once(ROOT . 'Models/Resource.php');
            $resourceModel = new Resource();
            $id = $_SESSION["user"];
            if ((isset($_POST["resourceIds"]) && is_array($_POST["resourceIds"])) && (isset($_POST["rates"]) && is_array($_POST["rates"]))) {
                $resourceIds = $_POST["resourceIds"];
                $rates = $_POST["rates"];
                $index = 0;
                // Build an associative arry that maps the resources ids to the edited rates.
                foreach ($resourceIds as $resourceId) {
                    //$resourceRates[$resourceId] = $rates[$index];
                    $resourceModel->changeRate($resourceId, $rates[$index]);
                    //echo $resourceId . "_" . $rates[$index];
                    $index++;
                }
            }
            
            $results["resources"] = Resource::resultToArray($resourceModel->all());
            $this->set($results);
            $this->render("index");
        }

        // METHOD: GET
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->authed();
            require_once(ROOT . 'Models/Resource.php');
            $resourceModel = new Resource();
            $results["resources"] = Resource::resultToArray($resourceModel->all());
            $this->set($results);
            $this->render("edit");
        }
    }

    function saveChanges() {
        $this->authed();
        require_once(ROOT . 'Models/Resource.php');
        $resource = new Resource();

        $results["resources"] = Resource::resultToArray($resource->all());
        $this->set($results);
        $this->render("index");
    }

}

?>