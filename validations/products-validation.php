<?php

require_once __DIR__ . "/../repositories/product-repository.php";


function getProductRequest($request){
   return [
      "id" => $request['id'] ?? '', 
      "product_code" => trim($request['product_code']),
      "product_name" => trim($request['product_name']),
      "category" => trim($request['category']),
      "unit" => trim($request['unit']),
      "price" => trim($request['price']),
      "stock" => trim($request['stock']),
      "entry_date" => trim($request['entry_date']),
      "description" => trim($request['description']),
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