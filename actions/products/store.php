<?php

session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/products-validation.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
   try{
      $pdo->beginTransaction();

      $request = getProductRequest($_POST);
      $errors = validateProduct($request);

      if (!empty($errors)){
         $pdo->rollBack();
         $_SESSION['errors'] = $errors; 
         $_SESSION['old'] = $request; 
         header("Location: ../../pages/products/create.php");
         exit;
      }

      $query = "insert into products (product_code, product_name, category, unit, price, stock, entry_date, description) values (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)";

      $stmt = $pdo->prepare($query);
      $stmt->execute([
         "product_code" => htmlspecialchars(trim($request['product_code'])),
         "product_name" => htmlspecialchars(trim($request['product_name'])),
         "category" => htmlspecialchars(trim($request['category'])),
         "unit" => htmlspecialchars(trim($request['unit'])),
         "price" => htmlspecialchars(trim($request['price'])),
         "stock" => htmlspecialchars(trim($request['stock'])),
         "entry_date" => htmlspecialchars(trim($request['entry_date'])),
         "description" => htmlspecialchars(trim($request['description'])),

      ]);

      $pdo->commit();

      header("Location: ../../pages/products/index.php");
      exit;

   }
   catch(PDOException $e){
      $pdo->rollBack();
      throw $e;
   }
}
