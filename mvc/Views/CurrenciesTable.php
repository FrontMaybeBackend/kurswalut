<?php

namespace Views;
include_once __DIR__ . '/../../database/Connect.php';
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

        $this->conn = null;

        return [
            'data' => $results,
            'totalRecords' => $totalRecords
        ];
    }


}