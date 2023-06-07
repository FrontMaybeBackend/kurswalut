<?php

namespace Controllers;
include_once __DIR__ . '/../../database/CurrenciesTable.php';
include_once __DIR__ . '/../../database/ConvertCurrencies.php';

class CalculatorController extends \CurrenciesTable
{
    public float $current_currency;

    public float $calculated_value;

    public float $selected_current;

    public float $score;
   public function __construct($current_currency,$selected_current, $calculated_value )
   {
       $this->current_currency = $current_currency;

       $this->calculated_value = $calculated_value;

       $this->selected_current = $selected_current;

   }

    public function calc()
    {
        try {
            if ($this->validation() == false) {
                throw new \Exception('Select currency');
            } else {
                $currentRate = $_POST['current_select'];
                $targetRate = $_POST['target'];

                $this->score = $this->current_currency * (floatval($currentRate) / floatval($targetRate));

                $insert = new \ConvertCurrencies($this->current_currency,floatval($currentRate),$targetRate, $this->score);

                $insert->insertConvertCurrencies();
                return round($this->score, 2);
            }
        } catch (\Exception $e) {
            echo 'Error: '  . $e->getMessage();
        }
    }

   public function validation() {
       $check = false;
       if(isset($this->current_currency) || isset($this->selected_current) || isset($this->calculated_value)){
           $check = true;
       }if($this->current_currency == 0 || $this->selected_current == 0 || $this->calculated_value == 0){
           throw new \Exception( "Fill in the blanks, cannot divide by 0");
       }

       return $check;
   }




}