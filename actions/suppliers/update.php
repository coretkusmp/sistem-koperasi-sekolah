<?php

session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/suppliers-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
   try {
      $pdo->beginTransaction();

      $request = getSupplierRequest($_POST);
      $errors = validateSupplier($request);

      if (!empty($errors)) {
         $pdo->rollBack();
         $_SESSION['errors'] = $errors;
         $_SESSION['old'] = $request;
         header("Location: ../../pages/suppliers/edit.php?id=" . $request['supplier_id']);
         exit;
      }

      $query = "UPDATE suppliers SET supplier_name = :supplier_name, email = :email, phone = :phone, address = :address, product_types = :product_types, partnership_date = :partnership_date WHERE supplier_id = :supplier_id";

      $stmt = $pdo->prepare($query);
      $stmt->execute([
         "supplier_name"    => htmlspecialchars($request['supplier_name']),
         "email"            => htmlspecialchars($request['email']),
         "phone"            => htmlspecialchars($request['phone']),
         "address"          => htmlspecialchars($request['address']),
         "product_types"    => htmlspecialchars($request['product_types']),
         "partnership_date" => htmlspecialchars($request['partnership_date']),
         "supplier_id"      => $request['supplier_id']
      ]);

      $pdo->commit();

      header("Location: ../../pages/suppliers/index.php");
      exit;

   } catch (PDOException $e) {
      $pdo->rollBack();
      throw $e;
   }
}