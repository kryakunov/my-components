<?php

class flash
{

    /*
        Parameters: 
            string - $name 
            string - $message 
        Description: sets a message to the session
    */

    static function set($name, $message) {
        $_SESSION[$name] = $message;
    }

    /*
        Parameters: 
            string - $name 
        Description: displays a message from the session
    */

    static function display($name) {
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]); 
        }
    }
}
