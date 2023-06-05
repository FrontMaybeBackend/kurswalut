<?php
include_once __DIR__ . '/../../src/classes/CalculatorCurrencies.php';
include_once __DIR__ . '/../../database/CurrenciesTable.php';

//Przesłanie formularza, sprawdź czy są przesłane dane.
if (isset($_POST['Calculate'])) {

    //Wartość do obliczenia
    $current = floatval($_POST['current_currency']);
    //Wybrana waluta
    $selected_current = floatval($_POST['current_select']);
    // Docelowa waluta
    $selected_target = floatval($_POST['target']);



    $score = new CalculatorCurrencies($current,$selected_current,$selected_target);
    $Calculate =$score->calc();
    var_dump($current);
    echo " <- to wartosc wpisana \n";

    var_dump($selected_current);
    echo "<- to z selecta \n";
    var_dump($selected_target);
    echo " <- to z drugiego selecta\n";


}
$show = new CurrenciesTable();
$currency = $show->getCurrencies();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Title</title>
</head>
<body>

<div>
    <form id="4" method="POST">
        <div class="mb-3">
            <label for="current_currency" class="form-label">Current Currency</label>
            <input  type="number" class="form-control" name="current_currency" id="current_currency">
            <select class="form-select" id="current_select" name="current_select" aria-label="Default select example">
                <option selected>Wybierz Walutę</option>
                <?php foreach($currency as $result) :?>
                <option value="<?php echo $result['rate']?>"><?php echo $result['currency']?></option>
                <?php endforeach ;?>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-select" id="target" name="target" aria-label="Default select example">
                <option selected>Wymień na</option>
                <?php foreach($currency as $result) :?>
                    <option value="<?php echo $result['rate']?>"><?php echo $result['currency']?></option>
                <?php endforeach ;?>
            </select>
        </div>
        <button class="p-2 m-3 align-content-end d-flex" id="Calculate" type="submit" name="Calculate">Calculate</button>
        <label for="Score" class="form-label center">Wartość: <?php if(isset($Calculate)){ echo $Calculate;} ?></label>
    </form>
</div>
</body>
</html>