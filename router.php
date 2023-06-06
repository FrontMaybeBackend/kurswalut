<?php
$controller = new \Controllers\CurrenciesController();

// Obsługa żądania
if (isset($_GET['page'])) {
    $page = $_GET['page'];

   if ($page === 'calculator') {
        $controller->render('calculator');
   } else {
    $controller->render('default_view');
}
}