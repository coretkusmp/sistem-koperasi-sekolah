<?php
require_once __DIR__ . "/../../repositories/product-repository.php";


session_start();
$products  = getProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Produk</title>

   <link rel="stylesheet" href="/style/base.css">
</head>

<body>
   <?php require_once __DIR__ . "/../../components/navbar.php" ?>

   <div class="toolbar">
      <a href="create.php" class="btn btn-primary">+ Tambah Produk</a>
   </div>

   <div class="card">
      <table>
         <thead>
            <tr>
               <th>Kode Produk</th>
               <th>Nama Produk</th>
               <th>Kategori</th>
               <th>Unit</th>
               <th>Harga</th>
               <th>Stok</th>
               <th>Tanggal Masuk</th>
               <th>Deskripsi</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($products as $product): ?>
               <tr>
                  <td><?= $product['product_code'] ?></td>
                  <td><?= $product['product_name'] ?></td>
                  <td><?= $product['category'] ?></td>
                  <td><?= $product['unit'] ?></td>
                  <td><?= $product['price'] ?></td>
                  <td><?= $product['stock'] ?></td>
                  <td><?= $product['entry_date'] ?></td>
                  <td><?= $product['description'] ?></td>
                  <td><a href="edit.php?id=<?= $product['product_id'] ?>">Edit</a> <a href="/actions/products/destroy.php?id=<?= $product['product_id'] ?>">Hapus</a></td>
               </tr>
            <?php endforeach; ?>
</body>

</html>