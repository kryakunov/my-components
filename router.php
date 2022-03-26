<?php

class Router 
{
    static function check($uri, $routes) 
    {
        if(array_key_exists($uri, $routes)) {
            include $routes[$uri]; exit;
        } else {
            dd(404);
        }
    }


}