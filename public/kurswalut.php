<?php
include_once __DIR__ . '/../database/Connect.php';
include_once __DIR__ . '/../mvc/Views/CurrenciesTable.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsPerPage = 10;
$offset = ($page - 1) * $recordsPerPage;

$table = new \Views\CurrenciesTable();
$tableData = $table->getTableData($recordsPerPage, $offset);
$displayValues = $tableData['data'];

$totalRecords = $tableData['totalRecords'];
$totalPages = ceil($totalRecords / $recordsPerPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <!-- Tabela -->
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
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

</body>
</html>
