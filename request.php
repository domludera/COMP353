<?php

/**
 * Custom Request object to add functionality to the base php request
 */
class Request
{
    public $url;

    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_URI"];
    }
}

?>