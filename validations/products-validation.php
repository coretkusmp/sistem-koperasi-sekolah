<?php

require_once __DIR__ . "/../repositories/product-repository.php";


function getProductRequest($request){
   return [
      "product_id" => $request['product_id'] ?? 0, 
      "product_code" => htmlspecialchars(trim($request['product_code'] ?? '')),
      "product_name" => htmlspecialchars(trim($request['product_name'] ?? '')),
      "category" => htmlspecialchars(trim($request['category'] ?? '')),
      "unit" => htmlspecialchars(trim($request['unit'] ?? '')),
      "price" => htmlspecialchars(trim($request['price'] ?? 0)),
      "stock" => htmlspecialchars(trim($request['stock'] ?? 0)),
      "entry_date" => htmlspecialchars(trim($request['entry_date'] ?? date('Y-m-d'))),
      "description" => htmlspecialchars(trim($request['description'] ?? '')),
   ];
}

function validateProduct($request, $ignoredId = 0){
   $errors = [];

   if (mb_strlen($request['product_code']) > 10){
      $errors['product_code'] = "kode produk tidak boleh lebih dari 10 karakter";
   }
   elseif (empty($request['product_code'])){
      $errors['product_code'] = "kode produk wajib diisi";
   }
   
   if (mb_strlen($request['product_name']) > 10){
      $errors['product_name'] = "nama produk tidak boleh lebih dari 10 karakter";
   }
   else if (empty($request['product_name'])){
      $errors['product_name'] = "nama produk wajib diisi";
   }

   if ($request['category'] != 'food' && $request['category'] != 'drink' && $request['category'] != 'stationery' && $request['category'] != 'uniform'){
      $errors['category'] = "kategori tidak valid";
   }
   
   if ($request['unit'] != 'pcs' && $request['unit'] != 'pack' && $request['unit'] != 'bottle'){
      $errors['unit'] = "unit tidak valid";
   }

   if (empty($request['price'])){
      $errors['price'] = "harga wajib diisi";
   }
   
   if (empty($request['stock'])){
      $errors['stock'] = "stok wajib diisi";
   }

   if (empty($request['description'])){
      $errors['description'] = "deskripsi wajib diisi";
   }

   return $errors;
}