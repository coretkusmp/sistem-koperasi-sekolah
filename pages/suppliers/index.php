<?php
require_once __DIR__ . "/../../repositories/supplier-repository.php";

session_start();
$suppliers  = getSuppliers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Supplier</title>

   <link rel="stylesheet" href="/style/base.css">
</head>

<body>
   <?php require_once __DIR__ . "/../../components/navbar.php" ?>

   <div class="toolbar">
      <a href="create.php" class="btn btn-primary">+ Tambah Supplier</a>
   </div>

   <div class="card">
      <table>
         <thead>
            <tr>
               <th>Nama Supplier</th>
               <th>Email</th>
               <th>Nomor Telepon</th>
               <th>Alamat</th>
               <th>Tipe Produk</th>
               <th>Tanggal Partnership</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($suppliers as $supplier): ?>
               <tr>
                  <td><?= $supplier['supplier_name'] ?></td>
                  <td><?= $supplier['email'] ?></td>
                  <td><?= $supplier['phone'] ?></td>
                  <td><?= $supplier['address'] ?></td>
                  <td><?= $supplier['product_types'] ?></td>
                  <td><?= $supplier['partnership_date'] ?></td>
                  <td><a href="edit.php?id=<?= $supplier['supplier_id'] ?>">Edit</a> <a href="/actions/suppliers/destroy.php?id=<?= $supplier['supplier_id'] ?>">Hapus</a></td>
               </tr>
            <?php endforeach; ?>

</body>

</html>