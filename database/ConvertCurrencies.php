<?php

class ConvertCurrencies extends Connect
{

    public float $current_currency;

    public float $selected_current;

    public float $calculated_value;

    public float $value;

    public function __construct($current_currency,$selected_current, $calculated_value, $value)
    {
        $this->current_currency = $current_currency;
        $this->selected_current = $selected_current;
        $this->calculated_value = $calculated_value;
        $this->value=$value;
    }

    public function insertConvertCurrencies(){
        $query = new  Connect();
        $conn  = $query->conn;
        $query = "INSERT INTO converted_currencies (initial_value, source_currencies, rate_kurs,converted_amount) VALUES (:initial_value, :source_currencies, :rate_kurs, :converted_amount)";
        $statement = $conn->prepare($query);
        $statement ->bindParam(':initial_value', $this->current_currency);
        $statement ->bindParam(':source_currencies', $this->selected_current);
        $statement ->bindParam(':rate_kurs', $this->calculated_value);
        $statement ->bindParam(':converted_amount', $this->value);
        $statement->execute();
    }



}