<?php

namespace Controllers;

class CurrenciesController extends \CurrenciesAPI
{

    public function render($file) {
        $filePath = __DIR__ . '/../mvc/Views/' . $file . '.php';
        include $filePath;
    }

}