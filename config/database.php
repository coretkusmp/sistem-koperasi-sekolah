<?php
$host = "localhost";
$username = "root";
$password = "";
$dbName = "db_cooperative";

$dsn = "mysql:hostname=$host;dbname=$dbName;";

try{
   $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false
   ];
   
   $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e){
   die($e);
}