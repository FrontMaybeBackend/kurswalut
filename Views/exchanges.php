<?php
include_once __DIR__ . '/navbar.php';

include_once __DIR__ . '/../database/CurrenciesTable.php';


$table = new \CurrenciesTable();
$converts = $table->getConvertCurrencies();
$source = $table->getSourceCurrent();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/public/style.css" rel="stylesheet">
    <title>Title</title>
</head>
<body>
<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">Price</th>
        <th scope="col">From</th>
        <th scope="col">At</th>
        <th scope="col">Final amount</th>
    </tr>
    </thead>
    <tbody>
    <!-- Tabela Przeliczonych Walut -->
    <p class="text-center">Recent Exchanges</p>

    <tbody>
    <?php foreach ($converts as $index => $convert): ?>
        <?php $sources = $source[$index]; ?>
        <tr>
            <td><?php echo $convert['initial_value']; ?></td>
            <td><?php echo $convert['currency'] . ' ' . $convert['rate']; ?></td>
            <td><?php echo $sources['currency'] . ' ' . $sources['rate']; ?></td>
            <td><?php echo $convert['converted_amount']; ?></td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</html>

