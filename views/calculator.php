<?php

include_once __DIR__ . '/../database/CurrenciesTable.php';
include_once __DIR__ . '/../classes/CalculatorController.php';
//Przesłanie formularza, sprawdź czy są przesłane dane.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentCurrency = floatval($_POST['current_currency']);
    $currentSelect = floatval($_POST['current_select']);
    $targetSelect = floatval($_POST['target']);


    $value = new \CalculatorController($currentCurrency, $currentSelect, $targetSelect);
    $Calculate = $value->calc();
}


$show = new CurrenciesTable();
$currency = $show->getCurrencies();
include_once __DIR__ . '/../views/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/public/style.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/bootstrap-select.css">
    <title>Title</title>
</head>
<body>

<div class="form-container">
    <h2>Calculator</h2>
    <form id="4" method="POST">
        <div class="form-group">
            <label for="current_currency">Current Currency</label>
            <input type="number" min="1" class="form-control" name="current_currency" id="current_currency" required>
            <select class="form-select" id="current_select" name="current_select" aria-label="Default select example"
                    required>
                <option value="">Select Currency</option>
                <?php foreach ($currency as $result) : ?>
                    <?php $id = $result['id'];
                    //Jeśli waluta ma wartość 0 to nie pokazuj w formularzu
                    $rate = $result['rate'];
                    if ($rate != 0) : ?>
                        <option value="<?php echo $id; ?>"><?php echo $rate . ' - ' . $result['currency']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-select" id="target" name="target" aria-label="Default select example" required>
                <option value="">Exchange at</option>
                <?php foreach ($currency as $result) : ?>
                    <?php $id = $result['id'];
                    //Jeśli waluta ma wartość 0 to nie pokazuj w formularzu
                    $rate = $result['rate'];
                    if ($rate != 0) : ?>
                        <option value="<?php echo $id; ?>"><?php echo $rate . ' - ' . $result['currency']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <button id="Calculate" type="submit" name="Calculate">Calculate</button>
        <label for="Score" class="result-label">Value: <?php if (isset($Calculate)) {
                echo $Calculate;
            } ?></label>
    </form>
</div>
</body>
</html>