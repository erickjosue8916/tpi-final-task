<?php 
require_once "config/loginVerifier.php";
$estado = (isset($_GET['estado'])) ? $_GET['estado']: 'Pendiente';
$total = (isset($_GET['total'])) ? $_GET['total']: 20;
$fechaActual = strtotime(date("Y-m-d"));
$fechaEntrega = strtotime($result['alquileres'][0]['fecha_devolucion']);
$sobreCargo = 0;

if ($estado === 'Pendiente') {
	if ($fechaActual < $fechaEntrega) {
		echo  $fechaActual . "  $fechaEntrega<br>";
		$sobreCargo = RETRASO * round(abs($fechaEntrega - $fechaActual)/86400);
	}
	?>
	<a href="<?=BASE_DIR?>Transacciones/pagarTransaccion&id=<?=$_GET['id']?>&total=<?=$_GET['total']?>">Aplicar sobrecargo de <?=$sobreCargo?> quedando <?=$sobreCargo + $total?> </a>
	<?php
}

?>
<div class="fondo">
	<main class="container">
		<div class="row h-auto min-vh-100 justify-content-center align-items-center">
			<div class="col">
				<?php
					$headers = ['#', 'Cantidad', 'Pelicula', 'Fecha transaccion', 'Fecha de devolucion', 'Total'];

					$rows = $result['alquileres'];
					$config = [
						'headers' => $headers,
						'rows' => $rows
					];

				?>
				<h1 class="text-center m-5 font-weight-light text-white display-4">Alquileres realizados</h1>
				<section class="table-responsive">
					<table class="table-styles">
						<thead>
							<tr>
							<?php
							foreach ($headers as $key => $value) {//Por cada título en el arreglo creamos una columna
								?>
								<th><h1><?=$value?></h1></th>
								<?php
							}
							?>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($rows as $key => $cols) { //Por cada elemento en $rows creamos una fila
								?>
								<tr>
								<?php
									foreach ($cols as $key => $col) {//Accedemos a los valores que tiene almacenado cada fila uno a uno
									?>
										<td><?=$col?></td><!--Agregamos ese valor a la fila correspondiente-->
									<?php
									}
								?>
								</tr>
								<?php
								}
							?>
						</tbody>
					</table>
				</section>
			</div>
		</div>
    </main>
</div>