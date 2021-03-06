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

	$html = '<div class="row h-auto min-vh-100 justify-content-center align-items-center">';
	foreach ($result['peliculas'] as $pelicula) {//Por cada pelicula

		foreach ($result2['peliculas'] as $key => $likesUsuario) {//Por cada pelicula que el usuario haya dado like
			//Si el titulo de la pelicula actual coincide con una que el usuario haya dado like
			if($likesUsuario['titulo'] == $pelicula['titulo'] ){
				$pelicula['reaccion'] = $likesUsuario['reaccion'];//Significa que el boton debe estar activo
			}
		} 
		//Verificamos si la pelicula se encuentra disponible
		if($pelicula['disponibilidad'] == 'Available'){
			$html .= "<div class='col-md-4 container_foto'>";
			//Si tiene la sesion iniciada, mostrara el boton para agregar la pelicula al carrito
			$html .= isset($_COOKIE['sessionId']) ? "<div class='ver_mas text-center'> <button type='button' onclick=\"addToShopping($pelicula[id_pelicula], '$pelicula[imagen]', '$pelicula[titulo]', $pelicula[precio_alquiler], $pelicula[precio_venta], $pelicula[stock])\">Añadir al carrito</button> </div>" : " ";
			
			$html .=	"
						<article>
							<h2> " . $pelicula["titulo"] . "</h2>
							<h4> " . $pelicula["descripcion"] . "</h4>
							<div class='text-center pb-2 text-success'>
								<span class='badge'>Comprar $". $pelicula["precio_venta"] ."</span>
								<span class='badge'>Alquilar $". $pelicula["precio_alquiler"] ."</span>
								<span class='badge'>Stock ". $pelicula["stock"] ."</span>
							</div>
							";
							
						if($pelicula["reaccion"] == 'Activo'){
							$html .= "<button type='button' class='like__btn' onclick='changeReaction(". $pelicula['id_pelicula'] . ")'>
								<i class='like__icon fa fa-heart'></i>
								<span class='like__text'>". $pelicula["likes"] ." Me gusta</span>
							</button>";
						}else{
							$html .= "<button type='button' class='like__btn disabled' onclick='changeReaction(". $pelicula['id_pelicula'] . ")'>
								<i class='like__icon fa fa-heart'></i>
								<span class='like__text'>". $pelicula["likes"] ." Me gusta</span>
							</button>";
						}
			$html .= "	</article>
						<img src=".BASE_DIR."assets/img/movies/".$pelicula["imagen"]." alt='imagen-pelicula'>
					</div>";
		}
		else{//Si la pelicula no esta disponible no se muestra la card
			$html .= "";
		}
	}
	$html .= '</div>';
	echo $html;
}
