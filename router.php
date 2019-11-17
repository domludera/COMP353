<?php

class Router
{

    static public function parse($url, $request)
    {
        $url = trim($url);

        $explode_url = explode('/', $url);

        if(isset($explode_url[1]) && $explode_url[1] != ""){
            echo 1;
            $request->controller = $explode_url[1];
        } else{
            $request->controller = 'home';
        }


        if(isset($explode_url[2]) && $explode_url[2] != ""){
            $request->action = $explode_url[2];
        } else{
            $request->action = 'index';
        }
        
        if(isset($explode_url[2])){
            $request->params = array_slice($explode_url, 3);
        } else{
            $request->params = [];
        }

    }
}
?>