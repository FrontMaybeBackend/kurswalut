<?php

namespace Controllers;
include_once __DIR__ . '/../../database/CurrenciesTable.php';

class CalculatorController extends \CurrenciesTable
{
    public float $current_currency;

    public float $calculated_value;

    public float $selected_current;

    public float $score;
   public function __construct($current_currency,$selected_current, $calculated_value, )
   {
       $this->current_currency = $current_currency;

       $this->calculated_value = $calculated_value;

       $this->selected_current = $selected_current;


   }

    public function Calc()
    {
        try {
            if ($this->validation() == false) {
                throw new \Exception('Select currency');
            } else {
                $currentRate = floatval($_POST['current_select']);
                $targetRate = floatval($_POST['target']);

                $this->score = $this->current_currency * ($currentRate / $targetRate);
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
       }
       return $check;


   }
}