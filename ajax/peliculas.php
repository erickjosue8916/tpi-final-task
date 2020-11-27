<?php
require_once "../config/configControllers.php";
require_once "../config/db.php";
require_once "../config/configControllers.php";
require_once "../database/Connection.php";
require_once "../database/MySqlConnection.php";
require_once "../database/IMySqlActions.php";
require_once "../models/Peliculas.php";
if (isset($_REQUEST)) {
	$page = (!isset($_GET['page'])) ? 1 : $_GET['page'];
	$limit = (!isset($_GET['limit'])) ? 20 : $_GET['limit'];
	$filter = (!isset($_GET['filter'])) ? [] : $_GET['filter'];
	$sort = (!isset($_GET['sort'])) ? [] : $_GET['sort'];
	$peliculas = new Peliculas();
	$result = $peliculas->list($page, $limit, $filter, $sort); //Obtenemos la lista de peliculas
	$result = json_decode($result, true);

	$result2 = $peliculas->likedbyUser();//Obtenemos todas las peliculas que el usuario actual le ha dado like
	$result2 = json_decode($result2, true);

	$html = '<div class="row justify-content-center align-items-center">';
	foreach ($result['peliculas'] as $pelicula) {//Por cada pelicula

		foreach ($result2['peliculas'] as $key => $likesUsuario) {//Por cada pelicula que el usuario haya dado like
			//Si el titulo de la pelicula actual coincide con una que el usuario haya dado like
			if($likesUsuario['titulo'] == $pelicula['titulo'] ){
				$pelicula['reaccion'] = $likesUsuario['reaccion'];//Significa que el boton debe estar activo
			}
		} 

		$html .= "<div class='col-md-4 container_foto '>
					<div class='ver_mas text-center'>
						<button type='button' onclick=\"addToShopping($pelicula[id_pelicula], '$pelicula[imagen]', '$pelicula[titulo]', $pelicula[precio_alquiler], $pelicula[precio_venta])\">Añadir al carrito</button>
					</div>
					<article class='text-left'>
						<h2> " . $pelicula["titulo"] . "</h2>
						<h4> " . $pelicula["descripcion"] . "</h4>";
						
						
					if($pelicula["reaccion"] == 'Activo'){
						$html .= "<button type='button' class='like__btn' onclick='changeReaction(". $pelicula['id_pelicula'] . ")'>
							<i class='like__icon fa fa-heart'></i>
							<span class='like__text'>Me gusta</span>
						</button>";
					}else{
						$html .= "<button type='button' class='like__btn disabled' onclick='changeReaction(". $pelicula['id_pelicula'] . ")'>
							<i class='like__icon fa fa-heart'></i>
							<span class='like__text'>Me gusta</span>
						</button>";
					}
		$html .= "	</article>
					<img src=".BASE_DIR."assets/img/movies/".$pelicula["imagen"]." alt='imagen-pelicula'>
				</div>";
	}
	$html .= '</div>';
	echo $html;
}
