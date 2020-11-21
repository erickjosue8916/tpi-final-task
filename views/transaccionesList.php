<main class="container h-100 d-flex justify-content-center align-items-center">
    <div>
    <?php
        $headers = ['#', 'fecha', 'usuario', 'correo', 'total', 'estado', 'tipo'];

        $rows = $result['transacciones'];
        $config = [
            'headers' => $headers,
            'rows' => $rows
        ];

        require_once "components/table.php";
    ?>
    </div>
</main>