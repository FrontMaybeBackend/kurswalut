<?php

include_once __DIR__ . '/Connect.php';
class CurrenciesTable extends \Connect
{

    public function getTableData($limit, $offset) {
        $query = "SELECT effective_date, currency, code, rate FROM kurs_walut LIMIT :limit OFFSET :offset";
        $countQuery = "SELECT COUNT(*) as count FROM kurs_walut";

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

    public function getCurrencies(){
        $query = "SELECT currency, rate FROM kurs_walut";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC); // Użyj FETCH_ASSOC, aby otrzymać wyniki w postaci asocjacyjnej

        return $results; // Zwróć wyniki bez dodatkowego opakowania
    }


}