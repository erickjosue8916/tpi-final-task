<?php 
require_once "config/loginVerifier.php";
?>
<div class="fondo">
	<main class="container">
		<div class="row h-auto min-vh-100 justify-content-center align-items-center">
			<div class="col">
				<?php
					$headers = ['#', 'Cantidad', 'Pelicula', 'Fecha', 'Total'];
					
					$rows = $result["compras"];
					$config = [
						'headers' => $headers,
						'rows' => $rows
					];

				?>
				<h1 class="text-center m-5 font-weight-light text-white display-4">Compras realizadas</h1>
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