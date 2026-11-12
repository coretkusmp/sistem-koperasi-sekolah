<?php
session_start();
require __DIR__ . "/../../config/database.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET"){
   try{
      $pdo->beginTransaction();

      $query = "delete from suppliers where supplier_id = :id";

      $stmt = $pdo->prepare($query);
      $stmt->execute([
         "id" => $_GET['id']
      ]);

      $pdo->commit();
      header('Location: ../../pages/suppliers/index.php');
      exit;
   } catch (PDOException $e){
      $pdo->rollBack();
         throw $e;
   }
}