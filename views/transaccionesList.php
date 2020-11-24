<main class="container h-100 d-flex justify-content-center align-items-center">
<div>
    <?php
        $headers = ['#', 'fecha', 'usuario', 'correo', 'total', 'estado', 'tipo'];

        $rows = $result['transacciones'];
        $config = [
            'headers' => $headers,
            'rows' => $rows
        ];

    ?>

    <section class="sectionTable">
	<table class="container">
	<thead>
		<tr>
		<?php
		foreach ($headers as $key => $value) {//Por cada título en el arreglo creamos una columna
			?>
			<th scope="col"><?=$value?></th>
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
				<td scope="col"><?=$col?></td><!--Agregamos ese valor a la fila correspondiente-->
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
    </main>
</div>