<?php

session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/suppliers-validation.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
   try {
      $pdo->beginTransaction();

      $request = getSupplierRequest($_POST);
      $errors = validateSupplier($request);

      if (!empty($errors)) {
         $pdo->rollBack();
         $_SESSION['errors'] = $errors; 
         $_SESSION['old'] = $request; 
         header("Location: ../../pages/suppliers/create.php");
         exit;
      }

      $productTypes = isset($request['product_types']) && is_array($request['product_types']) ? implode(', ', $request['product_types']) : '';

      $query = "INSERT INTO suppliers (supplier_name, email, phone, address, product_types, partnership_date) 
                VALUES (:supplier_name, :email, :phone, :address, :product_types, :partnership_date)";

      $stmt = $pdo->prepare($query);
      $stmt->execute([
         "supplier_name"     => htmlspecialchars(trim($request['supplier_name'])),
         "email"             => htmlspecialchars(trim($request['email'])),
         "phone"             => htmlspecialchars(trim($request['phone'])),
         "address"           => htmlspecialchars(trim($request['address'])),
         "product_types"     => htmlspecialchars(trim($productTypes)),
         "partnership_date"  => htmlspecialchars(trim($request['partnership_date'])),
      ]);

      $pdo->commit();

      header("Location: ../../pages/suppliers/index.php");
      exit;

   } catch (PDOException $e) {
      $pdo->rollBack();
      throw $e;
   }
}