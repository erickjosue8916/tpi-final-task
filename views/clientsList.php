<main class="container h-100 d-flex justify-content-center align-items-center">
    <div>
    <?php
        $headers = ['#', 'name', 'lastName', 'address', 'email'];

        $rows = $result['clients'];
        $config = [
            'headers' => $headers,
            'rows' => $rows
        ];

        require_once "components/table.php";
    ?>
    </div>
</main>