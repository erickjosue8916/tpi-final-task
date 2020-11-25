<?php
    /*
    Este archivo se creo para mandarse a llamar
    en aquellas vistas donde se requiera que el usuario
    este logueado
    */

    //primero comprobamos si existe una sesion abierta
    //para ello comprobamos si existe la cookie:
    if($_COOKIE["sessionId"]){
        //si esa cookie existe, vamos a reanudar o iniciar la sesion:
        session_start();
    }else{
        //si esa cookie no se encuentra redirigimos al usuario a la pagina de login:
        header("Location: "  . BASE_DIR . "Users/login");
    }
?>