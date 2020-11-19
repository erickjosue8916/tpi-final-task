<?php
  $active = "Main";
  if (isset($_REQUEST['controller'])){
    $active = $_REQUEST['controller'];
  }
  echo "<script> const baseDir = '" . BASE_DIR . "'; </script>"
?>
<!DOCTYPE html>
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
    
    
    <title>TPI -render con OOP-</title>
</head>
<body>
<?php if (isset($_COOKIE["sessionId"])) { ?>

<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
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
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>" class="btn <?=($active == "Main") ? "active": ""; ?>">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/list" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Users/login" class="btn <?=($active == "Main") ? "active": ""; ?>">Login</a>
          </li>
          <?php
          if ($_COOKIE["sessionId"]) {
            if ($_COOKIE['rol'] && $_COOKIE['rol'] === 'Administrador') {
              ?>
                <a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/create" class="btn <?=($active == "Main") ? "active": ""; ?>">Nueva pelicula</a>
              <?php
            }
          } else {
            header("Location: "  . BASE_DIR . "Users/login");
          }
          ?>
          <li class="nav-item">
          
          
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

</header>

  <?php } ?>