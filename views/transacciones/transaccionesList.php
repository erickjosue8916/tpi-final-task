<?php 
require_once "config/loginVerifier.php";
?>
<div class="fondo">
	<main class="container">
		<div class="row h-auto min-vh-100 justify-content-center align-items-center">
			<div class="col">
			<?php
				$headers = ['#', 'Fecha', 'Usuario', 'Correo', 'Total', 'Estado', 'Tipo', 'Detalles'];

				$rows = $result['transacciones'];
				$config = [
					'headers' => $headers,
					'rows' => $rows
				];
			?>
			<h1 class="text-center m-5 font-weight-light text-white display-4">Transacciones realizadas</h1>
			<section class="table-responsive">
				<table class="table-styles">
					<thead>
						<tr>
						<?php
							//Por cada título en el arreglo creamos una columna
							foreach ($headers as $key => $value) {
								?>
								<th scope="col"><h1><?=$value?></h1></th>
								<?php
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
						//Por cada elemento en $rows creamos una fila
						foreach ($rows as $key => $cols) { 
						?>
						<tr>
							<?php
							//Accedemos a los valores que tiene almacenado cada fila uno a uno
							foreach ($cols as $key => $col) {
							?>
								<td><?=$col?></td><!--Agregamos ese valor a la fila correspondiente-->
							<?php
							}
							$string = $cols["tipo_transaccion"] == "Compra" ? "detalleCompra":"detalleAlquiler";
							$string = BASE_DIR."Transacciones/" . $string . "&id=".$cols["id_transaccion"];
							?>
							<td><a class="btn btn-outline-info text-capitalize" href="<?=$string?>">Detalle</a></td>
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