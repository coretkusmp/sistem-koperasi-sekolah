<?php

require_once __DIR__ . "/../config/database.php";

function getProducts(){
   global $pdo;
   
   $query = "select * from products";

   $stmt = $pdo->prepare($query);
   $stmt->execute();

   $products = $stmt->fetchAll();

   return $products;
};

function getProduct($id)
{
   global $pdo;

   $query = "select * from products where product_id = :product_id";

   $stmt = $pdo->prepare($query);
   $stmt->execute([
      "product_id" => $id
   ]);

   $Product = $stmt->fetch();


   if (!$Product) {
      header("Location: ../products/index.php");
      exit;
   }
   return $Product;
}