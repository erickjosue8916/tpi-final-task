<?php

class ClientsController {
    public function __construct()
    {
        
    }

    public function list () {
        require_once "models/Client.php";
        $clients = new Client();
        $result = $clients->list();
        $result = json_decode($result, true);
        require_once "views/clientsList.php";
    }
    
    public function create () {
        if ($_COOKIE["sessionId"]) {
        if ($_COOKIE['rol'] != 'admin') {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        
        if (empty($_POST)) {
            require_once "views/clientCreate.php";
        } else {
            require_once "models/Client.php";
            $client = new Client();
            $client->setName($_POST['name']);
            $client->setLastName($_POST['lastname']);
            $client->setAddress($_POST['address']);
            $client->setImage('');
            $client->setEmail($_POST['email']);

            $result = $client->create();
            if ($result['success']) {
                header("Location: " . BASE_DIR . "Clients/list");
            } else {
                $error = $result['error'];
                require_once "views/registerUser.php";
            }
            
        }
    }
    
    public function update () {
        require_once "models/Client.php";
        $clients = new Client();
        $result = $clients->list();
        $result = json_decode($result, true);
        require_once "views/clientsList.php";
    }

    public function details () {

        if ($_COOKIE["sessionId"]) {
            session_start();
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }

        require_once "models/Client.php";
        $clients = new Client();
        $result = $clients->details($_GET['id']);
        $result = json_decode($result, true);
        require_once "views/clientDetails.php";
    }
    public function delete () {
        if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] != 'admin') {
                header("Location: "  . BASE_DIR . "Users/login");
            }
        } else {
            header("Location: "  . BASE_DIR . "Users/login");
        }
        require_once "models/Client.php";
        $clients = new Client();
        $result = $clients->delete($_GET['id']);
        $result = json_decode($result, true);
        header("Location: " . BASE_DIR . "Clients/list");
    }
    
}