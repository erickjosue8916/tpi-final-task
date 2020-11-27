<div class="fondo">
<main class="container h-100 d-flex justify-content-center align-items-center">
<div class="container table-responsive py-5 ">
	<?php
        $headers = ['#', 'Titulo', 'Descripcion', 'Imagen', 'Stock', 'Preciolquiler', 'PrecioVenta', 'Disponibilidad', 'Likes', 'Editar', 'Eliminar'];

        $rows = $result['peliculas'];
        $config = [
            'headers' => $headers,
            'rows' => $rows
		];
    ?>

    <section class="">
        <h2>Peliculas</h2>
	<table class="table table-bordered table-hover table-admin" >
	<thead class="thead-dark">
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
		<td scope="col"><a href="<?=BASE_DIR?>Peliculas/update&id=<?=$cols['id_pelicula']?>">Editar</a></td>
        <td scope="col"><a onclick='return checkDelete()' href="<?=BASE_DIR?>Peliculas/delete&id=<?=$cols['id_pelicula']?>">Eliminar</a></td>
		</tr>
		<?php
        }
	?>
	</tbody>
	</table>
	<script language="JavaScript" type="text/javascript">
        function checkDelete(){//Pide confirmacion si el usuario desea borrar un registro
           return confirm('Seguro que desea borrar este registro?');
        }
    </script>
    </section>
    </main>
</div>