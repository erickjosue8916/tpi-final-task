<?php
	$active = "Main";
	if (isset($_REQUEST['controller'])){
		$active = $_REQUEST['controller'];
	}
?>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- Font Awesome -->
		<link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet" />
		<!-- MDB -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/1.0.0/mdb.min.css" rel="stylesheet" />
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<!-- CSS Styles -->
		<link rel="stylesheet" href="<?=BASE_DIR?>assets/css/styles.css">

		<!-- Title -->
		<title>Cinema</title>
		<!-- Icon Title -->
		<link rel="shortcut icon" href="<?=BASE_DIR?>assets/img/fondo/favicon.ico">
	</head>
	<body>
	<!-- Header -->	
	<header>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-sm navbar-dark bg-dark flex-nowrap nav_color">
			<button class="navbar-toggler mr-2" type="button" data-toggle="collapse" data-target="#navbar5">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand w-25" href="<?=BASE_DIR?>">
				<img src="<?=BASE_DIR?>/assets/img/fondo/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
				CINEMA
			</a>
			<div class="navbar-collapse collapse w-100 justify-content-center" id="navbar5">
				<ul class="navbar-nav">
					<li class="nav-item m-2 active">
						<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>" class="btn <?=($active == "Main") ? "active": ""; ?>">Inicio</a>
					</li>
					<?php
						if (isset($_COOKIE["sessionId"])) {
							if ($_COOKIE['rol'] && $_COOKIE['rol'] === 'Administrador') {
								?>
								<li class="nav-item m-2">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Users/registerAdmin" class="btn <?=($active == "Clients") ? "active": ""; ?>">Añadir admin</a>
								</li>
								<li class="nav-item m-2 ">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/listAdmin" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
								</li>
								<li class="nav-item m-2 ">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/create" class="btn <?=($active == "Main") ? "active": ""; ?>">Nueva pelicula</a>
								</li>
								<li class="nav-item m-2 ">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Transacciones/list" class="btn <?=($active == "Main") ? "active": ""; ?>">Transacciones</a>
								</li>
								<?php
							}else{
								?>
								<li class="nav-item m-2 ">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/list" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
								</li>
								<?php
							}
							?>
								<li class="nav-item m-2">
								<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Users/logOut" class="btn <?=($active == "Main") ? "active": ""; ?>">Salir</a>
								</li>
							<?php
						}else{
							?>
								<li class="nav-item m-2 ">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Peliculas/list" class="btn <?=($active == "Clients") ? "active": ""; ?>">Peliculas</a>
								</li>
								<li class="nav-item m-2">
									<a class="nav-link" aria-current="page" href="<?=BASE_DIR?>Users/login" class="btn <?=($active == "Main") ? "active": ""; ?>">Iniciar Sesión</a>
								</li>
							<?php
						}
					?>
				</ul>
			</div>
			<div class="w-25"><!--spacer--></div>
		</nav>
		<!-- Fin Navbar -->
	</header>
	<!-- Fin Header -->
	