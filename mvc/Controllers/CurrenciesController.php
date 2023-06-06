<?php

namespace Controllers;

class CurrenciesController extends \Currencies
{

    public function render($file) {
        $filePath = __DIR__ . '/../mvc/Views/' . $file . '.php';
        include $filePath;
    }

}