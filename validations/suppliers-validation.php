<?php

function getSupplierRequest($request)
{
   $productTypes = $request['product_types'] ?? [];
   if (is_array($productTypes)) {
      $productTypes = implode(', ', $productTypes);
   }

   return [
      "supplier_id"      => (int) ($request['supplier_id'] ?? 0),
      "supplier_name"    => trim($request['supplier_name'] ?? ''),
      "email"            => trim($request['email'] ?? ''),
      "phone"            => trim($request['phone'] ?? ''),
      "address"          => trim($request['address'] ?? ''),
      "product_types"    => trim($productTypes),
      "partnership_date" => trim($request['partnership_date'] ?? ''),
   ];
}

function validateSupplier($request)
{
   $errors = [];

   if (empty($request['supplier_name'])) {
      $errors['supplier_name'] = "Nama supplier wajib diisi";
   } elseif (mb_strlen($request['supplier_name']) > 100) {
      $errors['supplier_name'] = "Nama supplier maksimal 100 karakter";
   }

   if (empty($request['email'])) {
      $errors['email'] = "Email wajib diisi";
   } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Format email tidak valid";
   }

   if (empty($request['phone'])) {
      $errors['phone'] = "Nomor telepon wajib diisi";
   } elseif (mb_strlen($request['phone']) > 15) {
      $errors['phone'] = "Nomor telepon maksimal 15 karakter";
   }

   if (empty($request['address'])) {
      $errors['address'] = "Alamat wajib diisi";
   }

   if (empty($request['product_types'])) {
      $errors['product_types'] = "Pilih minimal satu jenis produk";
   }

   if (empty($request['partnership_date'])) {
      $errors['partnership_date'] = "Tanggal kemitraan wajib diisi";
   }

   return $errors;
}
