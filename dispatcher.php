<?php

class Dispatcher
{
    private $request;

    // Main routing call used immediately after the base php request
    // Build our custom request object and executes to the correct controllers' method we are trying to call
    public function dispatch()
    {
        // Build a request object from the Native PHP request
        $this->request = new Request();
        Router::parse($this->request->url, $this->request);

        // Create the correct controller we are trying to route to
        $controller = $this->loadController();

        // Call the method inside the controller and pass it the parameters we've gathered fro mthe request
        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        // file name of the controller we are trying to access
        $name = $this->request->controller . "Controller";
        
        // Files absolute path in the file system
        $file = ROOT . 'Controllers/' . $name . '.php';
        
        // Require the found controller
        require($file);

        // instantiate it now that it is included
        $controller = new $name();
        return $controller;
    }

}
?>