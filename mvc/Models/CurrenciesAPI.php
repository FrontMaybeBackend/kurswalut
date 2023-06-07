<?php
include_once __DIR__ . '/../../database/Connect.php';
class CurrenciesAPI extends Connect
{
    protected $url;


    public $rates;

    public function __construct()
    {
        parent::__construct();
    }



    public function getExchangesRates()
    {
        $this->url = "https://api.nbp.pl/api/exchangerates/tables/B/?format=json";
        $data = file_get_contents($this->url);

        if ($data === false) {
            die('Nie udalo się pobrać danych z API');
        }


        $this->rates = json_decode($data, true);

        if ($this->rates === null) {
            die('Bład dekodowania JSON');
        }
        return $this->rates;

    }

    public function insertCurrencies(){
        $this->rates = $this->getExchangesRates();
        $statement = $this->conn->prepare("INSERT INTO currency_rate (table_name, effective_date, currency, code,rate) VALUES (:table_name, :effective_date, :currency, :code,:rate)");

        foreach ($this->rates[0]['rates']as $rate) {
            $tableName = $this->rates[0]['table']; // Name of the table from the API response
            $effectiveDate = $this->rates[0]['effectiveDate']; // Value from the API response
            $currency = $rate['currency']; // Value from the API response
            $currencyCode = $rate['code']; // Value from the API response
            $rateValue = $rate['mid'] ;     // Value from the API response

            $statement->bindParam(':table_name', $tableName);
            $statement->bindParam(':effective_date', $effectiveDate);
            $statement->bindParam(':currency', $currency);
            $statement->bindParam(':code', $currencyCode);
            $statement->bindParam(':rate', $rateValue);

            $statement->execute();
        }

    }

    public function updateCurrencies(){
        $this->rates = $this->getExchangesRates();
        $statement = $this->conn ->prepare( 'UPDATE currency_rate SET rate =:rate WHERE table_name =:table_name AND effective_date = :effective_date AND currency = :currency AND code = :code');
        foreach ($this->rates[0]['rates'] as $rate) {
            $tableName = $this->rates[0]['table']; // Name of the table from the API response
            $effectiveDate = $this->rates[0]['effectiveDate']; // Value from the API response
            $currency = $rate['currency']; // Value from the API response
            $currencyCode = $rate['code']; // Value from the API response
            $rateValue = $rate['mid'];     // Value from the API response

            $statement->bindParam(':table_name', $tableName);
            $statement->bindParam(':effective_date', $effectiveDate);
            $statement->bindParam(':currency', $currency);
            $statement->bindParam(':code', $currencyCode);
            $statement->bindParam(':rate', $rateValue);

            $statement->execute();
        }
    }


}