<?php 
require_once __DIR__ . "/../../repositories/supplier-repository.php";
session_start();

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Create</title>

   <link rel="stylesheet" href="/style/base.css">
</head>

<body>
   <?php require_once __DIR__ . "/../../components/navbar.php" ?>

   <form method="post" action="/actions/suppliers/store.php">
      <ul>
         <li>
            <label for="">Nama Supplier</label>
            <input name="supplier_name" type="text" value="<?= $old['supplier_name'] ?? '' ?>">
            <?php if(isset($errors['supplier_name'])):?>
               <p><?= $errors['supplier_name'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Email</label>
            <input name="email" type="email" value="<?= $old['email'] ?? '' ?>">
            <?php if(isset($errors['email'])):?>
               <p><?= $errors['email'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Telepon</label>
            <input name="phone" type="tel" value="<?= $old['phone'] ?? '' ?>">
            <?php if(isset($errors['phone'])):?>
               <p><?= $errors['phone'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Alamat</label>
            <textarea name="address" id=""><?= $old['address'] ?? '' ?></textarea>
            <?php if(isset($errors['address'])):?>
               <p><?= $errors['address'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Jenis Produk</label>
            <div>
               <label><input type="checkbox" name="product_types[]" value="food"> Food</label>
               <label><input type="checkbox" name="product_types[]" value="drink"> Drink</label>
               <label><input type="checkbox" name="product_types[]" value="stationery"> Stationery</label>
               <label><input type="checkbox" name="product_types[]" value="uniform"> Uniform</label>
            </div>
            <?php if(isset($errors['product_types'])):?>
               <p><?= $errors['product_types'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Tanggal Kemitraan</label>
            <input name="partnership_date" type="date" value="<?= $old['partnership_date'] ?? '' ?>">
            <?php if(isset($errors['partnership_date'])):?>
               <p><?= $errors['partnership_date'] ?></p>
            <?php endif;?>
         </li>
      </ul>

      <div class="submit-cancel">
         <a href="/pages/suppliers/index.php">cancel</a>
         <button type="submit" name="store">submit</button>
      </div>
   </form>

</body>

</html>