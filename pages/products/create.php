<?php 
require_once __DIR__ . "/../../repositories/product-repository.php";

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

   <form method="post" action="/actions/products/store.php">
      <ul>
         <li>
            <label for="">Kode Produk</label>
            <input type="text" value="<?= $old['product_code'] ?>">
            <?php if(!empty($errors['product_code'])):?>
               <p><?= $errors['product_code'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Nama Produk</label>
            <input type="text" value="<?= $old['product_name'] ?>">
            <?php if(!empty($errors['product_name'])):?>
               <p><?= $errors['product_name'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Kategori</label>
            <select name="category" id="">
               <option value="none">-</option>
               <option value="food">Food</option>
               <option value="drink">Drink</option>
               <option value="stationery">Stationery</option>
               <option value="uniform">Uniform</option>
            </select>
            <?php if(!empty($errors['category'])):?>
               <p><?= $errors['category'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Unit</label>
            <select name="unit" id="">
               <option value="none">-</option>
               <option value="pcs">Pcs</option>
               <option value="pack">Pack</option>
               <option value="bottle">Bottle</option>
            </select>
            <?php if(!empty($errors['unit'])):?>
               <p><?= $errors['unit'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Harga</label>
            <input type="number" value="<?= $old['price'] ?>">
            <?php if(!empty($errors['price'])):?>
               <p><?= $errors['price'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Stok</label>
            <input type="number" value="<?= $old['stock'] ?>">
            <?php if(!empty($errors['stock'])):?>
               <p><?= $errors['stock'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Tanggal Masuk</label>
            <input type="date" value="<?= $old['entry_date'] ?>">
         </li>
         <li>
            <label for="">Deskripsi</label>
            <textarea name="description" id=""></textarea>
            <?php if(!empty($errors['description'])):?>
               <p><?= $errors['description'] ?></p>
            <?php endif;?>
         </li>
      </ul>

      <div class="submit-cancel">
         <a href="/pages/products/index.php">cancel</a>
         <button type="submit" name="store">submit</button>
      </div>
   </form>

</body>

</html>