<?php

class Router 
{

    /*
        Parameters: 
            string - $uri (URL)
            array - $routes (routing list)
        Description: checks if the uri is in the routing list
    */

    static function check($uri, $routes) 
    {
        if(array_key_exists($uri, $routes)) {
            include $routes[$uri]; exit;
        } else {
            dd(404);
        }
    }

}