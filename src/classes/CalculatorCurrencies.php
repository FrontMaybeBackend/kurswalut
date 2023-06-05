<?php

include_once __DIR__ . '/../../database/CurrenciesTable.php';
class CalculatorCurrencies extends \CurrenciesTable
{
    public $selected_current;

    public  $current_currency;

    public  $calculated_value;

    public  float $score;

    public function __construct(  $current_currency,  $selected_current,  $calculated_value)
    {
        $this->current_currency = $current_currency;
        $this->selected_current = $selected_current;
        $this->calculated_value = $calculated_value;
    }

    private $errors = array(
        "empty" => "Inputs can't be empty",
        "numeric" => "Inputs must be numeric"

    );
    public function calc()
    {
        $check = true;
        if($this->validationCalc() == false){
            return $this->errors['empty'];
            $check = false;
        }
        if($this->valIsFloat() == false){
            return $this->errors['numeric'];
            $check = false;
        }if($check == true){


            $scoress = new CurrenciesTable();
            $endvalue = $scoress->getCurrencies();


        $currentRate = floatval($endvalue[$this->selected_current]['rate']);
        $targetRate = floatval($endvalue[$this->calculated_value]['rate']);

            var_dump($currentRate);
            echo " <- to przekazane w klasie calc \n";
            var_dump($targetRate);
            echo "  <- to tez \n";

            $this->score = $this->current_currency * ($currentRate / $targetRate);
            return $this->score;

        }


    }


    public function validationCalc(){
        $calc = true;
        if(empty($this->current_currency) || empty($this->selected_current || empty($this->calculated_value))){
            $calc = false;
        }else{
            $calc  = true;
        }
        return $calc;
    }

    public function valIsFloat()
    {
        $calcNum = true;
        if (!is_numeric($this->current_currency)) {
            $calcNum = false;
        }else{
            $calcNum = true;
        }
        return $calcNum;

    }




}