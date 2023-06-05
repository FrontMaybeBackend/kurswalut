<?php

class AddConvertCurrencies extends CalculatorCurrencies
{

    public function __construct($current_currency, $selected_current, $calculated_value)
    {
        parent::__construct($current_currency, $selected_current, $calculated_value);
    }

    public function addConvert(){
        $query = "INSERT INTO "
    }

}