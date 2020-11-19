<?php
class BaseLayout {

    public function __construct()
    {
        
    }

    public static function renderHead()
    {
        require_once "views/header.php";
    }

    public static function renderFoot()
    {
        require_once "views/footer.php";
    }
}