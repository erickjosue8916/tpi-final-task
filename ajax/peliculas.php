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
	$result = $peliculas->list($page, $limit, $filter, $sort);
	$result = json_decode($result, true);
	$html = '<div class="row">';
	foreach ($result['peliculas'] as $pelicula) { 
		$html .= "<div class='col-md-4 container_foto '>
					<div class='ver_mas text-center'>
						<button type='button'>Añadir al carrito</button>
					</div>
					<article class='text-left'>
						<h2> " . $pelicula["titulo"] . "</h2>
						<h4> " . $pelicula["descripcion"] . "</h4>";
					if($pelicula["reaccion"] == 'Active'){
						$html .= "<button type='button' class='like__btn'>
							<i class='like__icon fa fa-heart'></i>
							<span class='like__text'>Me gusta</span>
						</button>";
					}else{
						$html .= "<button type='button' class='like__btn disabled'>
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
