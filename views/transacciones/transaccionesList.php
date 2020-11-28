<div class="fondo">
<main class="container justify-content-center align-items-center">
		<?php
			$headers = ['#', 'Fecha', 'Usuario', 'Correo', 'Total', 'Estado', 'Tipo', 'Detalles'];

			$rows = $result['transacciones'];
			$config = [
				'headers' => $headers,
				'rows' => $rows
			];
		?>
		<section class="">
			<h2>transacciones realizadas</h2>
			<table class="table table-dark table-responsive table-striped">
				<thead>
					<tr>
					<?php
						//Por cada título en el arreglo creamos una columna
						foreach ($headers as $key => $value) {
							?>
							<th scope="col"><?=$value?></th>
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
</main>
</div>