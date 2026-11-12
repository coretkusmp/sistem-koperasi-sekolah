<?php

require_once __DIR__ . "/../repositories/employee-repository.php";

function getEmployeeRequest($request) {
   return [
      "employee_id"     => (int) ($request['employee_id'] ?? 0),
      "employee_number" => htmlspecialchars(trim($request['employee_number'] ?? '')),
      "full_name"       => htmlspecialchars(trim($request['full_name'] ?? '')),
      "gender"          => htmlspecialchars(trim($request['gender'] ?? '')),
      "birth_date"      => htmlspecialchars(trim($request['birth_date'] ?? date('Y-m-d'))),
      "position"        => htmlspecialchars(trim($request['position'] ?? '')),
      "salary"          => htmlspecialchars(trim($request['salary'] ?? 0)),
   ];
}

function validateEmployee($request, $ignoredId = 0) {
   $errors = [];

   if (empty($request['employee_number'])) {
      $errors['employee_number'] = "Nomor karyawan wajib diisi";
   } elseif (mb_strlen($request['employee_number']) > 10) {
      $errors['employee_number'] = "Nomor karyawan maksimal 10 karakter";
   }

   if (empty($request['full_name'])) {
      $errors['full_name'] = "Nama lengkap wajib diisi";
   } elseif (mb_strlen($request['full_name']) > 100) {
      $errors['full_name'] = "Nama lengkap maksimal 100 karakter";
   }

   if (!in_array($request['gender'], ['M', 'F'])) {
      $errors['gender'] = "Kelamin tidak valid";
   }

   if (empty($request['birth_date'])) {
      $errors['birth_date'] = "Tanggal lahir wajib diisi";
   }

   if (!in_array($request['position'], ['Cashier', 'Warehouse Staff', 'Admin'])) {
      $errors['position'] = "Jabatan tidak valid";
   }

   if (empty($request['salary'])) {
      $errors['salary'] = "Gaji wajib diisi";
   }

   return $errors;
}