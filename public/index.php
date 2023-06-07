<?php
include_once __DIR__ . '/../database/CurrenciesTable.php';
include_once __DIR__ . '/../mvc/Models/CurrenciesAPI.php';

//Paginacja
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsPerPage = 10;
$offset = ($page - 1) * $recordsPerPage;

$table = new \CurrenciesTable();
$tableData = $table->getTableData($recordsPerPage, $offset);
$displayValues = $tableData['data'];

$totalRecords = $tableData['totalRecords'];
$totalPages = ceil($totalRecords / $recordsPerPage);

//Zaaktualizuj tabele z kursami.
$time = new CurrenciesAPI();
if(date("H:i:s") >= date("21:59:00")){
    $time->updateCurrencies();
}

//Pobierz i wyświetl tabelę z ostatnimi przewalutowaniami.
$converts = $table ->getConvertCurrencies();


//$ŁADUJEMY = new CurrenciesAPI();
//$jadom = $ŁADUJEMY->insertCurrencies();

?>
 <?php include_once __DIR__ . '/../mvc/Views/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/public/style.css" rel="stylesheet">
    <title>Title</title>
</head>
<body>

<table class="table table-hover table-dark">
    <thead>
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Currency</th>
        <th scope="col">Code</th>
        <th scope="col">Rate</th>
    </tr>
    </thead>
    <tbody>
    <!-- Tabela Kursów Walut -->
    <p class="text-center"> Current Currencies</p>
    <tbody>
    <?php foreach($displayValues as $currency): ?>
        <tr>
            <td><?php echo $currency['effective_date']; ?></td>
            <td><?php echo $currency['currency']; ?></td>
            <td><?php echo $currency['code']; ?></td>
            <td><?php echo $currency['rate']; ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
