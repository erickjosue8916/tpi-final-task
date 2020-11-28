<?php
  $active = "Main";
  if (isset($_REQUEST['controller'])){
    $active = $_REQUEST['controller'];
  }
  
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Font Awesome -->
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/1.0.0/mdb.min.css" rel="stylesheet" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- CSS Styles -->
    <link rel="stylesheet" href="<?=BASE_DIR?>assets/css/styles.css">
    
    <title>Cinema</title>

    <link rel="shortcut icon" href="<?=BASE_DIR?>assets/img/fondo/favicon.ico">
</head>
<body>

<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg nav_color">
    <div class="container-fluid">
    <img href="<?=BASE_DIR?>" src="<?=BASE_DIR?>/assets/img/fondo/icon.png" width="40px" height="40px" class="d-inline-block align-top" alt="">
      <a class="icon" href="<?=BASE_DIR?>">CINEMA</a>
    
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarExample01"
        aria-controls="navbarExample01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarExample01">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0 ">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>" class="btn <?=($active == "Main") ? "active": ""; ?>">Home</a>
          </li>
          <?php
          if (isset($_COOKIE["sessionId"])) {
            if ($_COOKIE['rol'] && $_COOKIE['rol'] === 'Administrador') {
              ?>
              <li class="nav-item ">
                <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/listAdmin" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/create" class="btn <?=($active == "Main") ? "active": ""; ?>">Nueva pelicula</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Transacciones/list" class="btn <?=($active == "Main") ? "active": ""; ?>">Transacciones</a>
              </li>
              <?php
            }else{
              ?>
              <li class="nav-item ">
                <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/list" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
              </li>
              <?php
            }
            ?>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Users/logOut" class="btn <?=($active == "Main") ? "active": ""; ?>">Sign out</a>
            </li>
            <?php
          } else {
            ?>
            <li class="nav-item ">
              <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/list" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Users/login" class="btn <?=($active == "Main") ? "active": ""; ?>">Sign in</a>
            </li>
            <?php
            //header("Location: "  . BASE_DIR . "Users/login");
          }
          ?>

          <!--
          <li class="nav-item">
          </li>
          -->
          
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

</header>