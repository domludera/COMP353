<?php
    class Controller
    {
        var $vars = [];
        var $layout = "default";

        /**
         * Add variables to the current set of variables
         */
        function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

        function render($filename)
        {
            /**
             * Renders a view with parameters passed to it that can be used
             */

            // Turns associative array of variables into tangible scoped variables for each index
            extract($this->vars);

            ob_start();

            // Load the view we are trying to render (without sending it to the output buffer thanks to ob_start() )
            require(ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
            
            // Extract the current content 
            $content_for_layout = ob_get_clean();

            // contents layout not found
            if ($this->layout == false)
            {
                $content_for_layout;
            }

            // Content file found, load it (It will be sent to the output buffer)
            else
            {
                require(ROOT . "Views/Layouts/" . $this->layout . '.php');
            }
        }

        /**
         * Steralizes the input data and makes it html safe
         * Removes white spaces, slashes and html special characters
         */
        private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Secures (Steralises) all the form data and makes it html safe
        protected function secure_form($form)
        {
            foreach ($form as $key => $value)
            {
                $form[$key] = $this->secure_input($value);
            }
        }

        /**
         * Redirect the user to a location
         */
        function redirect($url, $statusCode = 303)
        {
            header('Location: ' . $url, true, $statusCode);
            die();
        }

        /**
         * Middleware that checks if the user is logged in.
         * If not, redirect to login page
         */
        function authed()
        {
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            } 

            if(!isset($_SESSION['user']) || !$_SESSION['user']){
                $this->redirect('/auth/login');
            }

            return true;
        }

    }
?>