<?php

include_once __DIR__ . '/Connect.php';

class CurrenciesTable extends \Connect
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTableData($limit, $offset)
    {
        $query = "SELECT effective_date, currency, code, rate FROM 	currency_rate LIMIT :limit OFFSET :offset";
        $countQuery = "SELECT COUNT(*) as count FROM currency_rate";

        $statement = $this->conn->prepare($query);
        $statement->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $statement->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $statement->execute();
        $results = $statement->fetchAll();

        $countStatement = $this->conn->prepare($countQuery);
        $countStatement->execute();
        $countResult = $countStatement->fetch();
        $totalRecords = $countResult['count'];


        return [
            'data' => $results,
            'totalRecords' => $totalRecords
        ];
    }

    public function getCurrencies()
    {
        $query = "SELECT currency, rate,id FROM currency_rate ";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC); // Użyj FETCH_ASSOC, aby otrzymać wyniki w postaci asocjacyjnej

        return $results; // Zwróć wyniki bez dodatkowego opakowania
    }

    //Połączenia do zwracania danych do widoku.
    public function getConvertCurrencies()
    {
        $query = "SELECT * FROM converted_currencies INNER JOIN currency_rate ON converted_currencies.source_currencies=currency_rate.id";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $convert = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $convert;
    }

    public function getSourceCurrent()
    {
        $query = "SELECT * FROM converted_currencies INNER JOIN currency_rate ON converted_currencies.rate_kurs=currency_rate.id;";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $source = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $source;
    }


}