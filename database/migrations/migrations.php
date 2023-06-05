<?php
include_once __DIR__ . '/../../database/connect.php';

$migrationFile = "002_create_table_converted_currencies.sql";



$sql = new Connect();
$conn = $sql->conn;

try {
    $migrationSQL = file_get_contents($migrationFile);
    $statement = $conn->prepare($migrationSQL);
    $statement->execute();
    echo "Migracja pierwszej tabeli wykonana pomyślnie!";
}    catch (PDOException $e) {
    echo "Błąd migracji: " . $e->getMessage();
}

// druga tabela

$migrationFile2 = "001_create_table_currencies.sql";



$sql = new Connect();
$conn = $sql->conn;

try {
    $migrationSQL = file_get_contents($migrationFile2);
    $statement = $conn->prepare($migrationSQL);
    $statement->execute();
    echo "Migracja drugiej tabeli wykonana pomyślnie!";
}    catch (PDOException $e) {
    echo "Błąd migracji: " . $e->getMessage();
}


