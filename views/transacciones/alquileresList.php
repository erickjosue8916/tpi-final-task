<?php 
require_once "config/loginVerifier.php";
$estado = (isset($_GET['estado'])) ? $_GET['estado']: 'Pendiente';
$total = (isset($_GET['total'])) ? $_GET['total']: 20;
$fechaActual = strtotime(date("Y-m-d"));
$fechaEntrega = strtotime($result['alquileres'][0]['fecha_devolucion']);
$sobreCargo = 0;

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
				<?php
						if ($estado === 'Pendiente') {
							if ($fechaActual > $fechaEntrega) {
								$sobreCargo = RETRASO * round(abs($fechaEntrega - $fechaActual)/86400);
								?>
								<div class="d-flex justify-content-center">
									<div class="text-center alert alert-danger w-50" role="alert">
										<strong>Se ha retrasado en la devolucion</strong>
										<a class="btn btn-block btn-outline-danger" href="<?=BASE_DIR?>Transacciones/pagarTransaccion&id=<?=$_GET['id']?>&total=<?=$_GET['total']?>">Aplicar sobrecargo de $<?=$sobreCargo?> quedando $<?=$sobreCargo + $total?></a>
									</div>
								</div>
								<?php
							}
							else{
							?>							
							<div class="d-flex justify-content-center">
								<div class="text-center alert alert-info w-50" role="alert">
									<strong>No hay retrasos en la devolucion</strong>
									<a class="btn btn-block btn-outline-info" href="<?=BASE_DIR?>Transacciones/pagarTransaccion&id=<?=$_GET['id']?>&total=<?=$_GET['total']?>">Aplicar sobrecargo de $<?=$sobreCargo?> quedando $<?=$sobreCargo + $total?></a>
								</div>
							</div>
							<?php
							}
						}
					?>
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