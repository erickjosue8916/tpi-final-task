<main class="container h-100 d-flex justify-content-center align-items-center">
    <div>
    <?php
        $headers = ['#', 'titulo', 'descripcion', 'imagen', 'stock', 'precio_alquiler', 'precio_venta', 'disponibilidad'];

        $rows = $result['peliculas'];
        $config = [
            'headers' => $headers,
            'rows' => $rows
        ];

        require_once "components/table.php";
    ?>
    </div>
</main>