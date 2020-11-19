<?php

class MainController {
    public function __construct()
    {
        
    }

    public function home () {
        require_once "views/home.php";
    }
    
    public function protected () {
        require_once "views/protected.php";
    }

}