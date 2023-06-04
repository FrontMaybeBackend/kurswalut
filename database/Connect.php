<?php

class Connect
{

    public $conn;
   public function __construct()
   {
       try {
           $this->conn = new PDO('mysql:host=localhost;dbname=waluty', 'root', '');
           $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
           echo "Failed:" . $e->getMessage();
       }


   }

}