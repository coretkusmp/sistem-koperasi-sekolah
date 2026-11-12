<?php 
require_once __DIR__ . "/../../repositories/product-repository.php";

session_start();

$product = getProduct($_GET['id'] ?? 0);
$product_id = (int) ($_GET['id'] ?? 0);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$data = $old ?: $product;
unset($_SESSION['errors'], $_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">



<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>edit</title>

   <link rel="stylesheet" href="/style/base.css">

</head>

<body>
   <?php require_once __DIR__ . "/../../components/navbar.php" ?>

   <form method="post" action="/actions/products/update.php">
   <input type="hidden" name="product_id" value="<?= $product_id; ?>">   

      <ul>
         <li>
            <label for="">Kode Produk</label>
            <input name="product_code" type="text" value="<?= $data['product_code'] ?? '' ?>">
            <?php if(isset($errors['product_code'])):?>
               <p><?= $errors['product_code'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Nama Produk</label>
            <input name="product_name" type="text" value="<?= $data['product_name'] ?? '' ?>">
            <?php if(isset($errors['product_name'])):?>
               <p><?= $errors['product_name'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Kategori</label>
            <select name="category" id="">
               <option value="<?= strtolower($product['category']) ?>"><?= $product['category'] ?></option>
               <option value="none">-</option>
               <option value="food">Food</option>
               <option value="drink">Drink</option>
               <option value="stationery">Stationery</option>
               <option value="uniform">Uniform</option>
            </select>
            <?php if(isset($errors['category'])):?>
               <p><?= $errors['category'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Unit</label>
            <select name="unit" id="" value="<?= $data['unit'] ?>">
               <option value="<?= strtolower($product['unit']) ?>"><?= $product['unit'] ?></option>
               <option value="none">-</option>
               <option value="pcs">Pcs</option>
               <option value="pack">Pack</option>
               <option value="bottle">Bottle</option>
            </select>
            <?php if(isset($errors['unit'])):?>
               <p><?= $errors['unit'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Harga</label>
            <input name="price" type="number" value="<?= $data['price'] ?? '' ?>">
            <?php if(isset($errors['price'])):?>
               <p><?= $errors['price'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Stok</label>
            <input name="stock" type="number" value="<?= $data['stock'] ?? '' ?>">
            <?php if(isset($errors['stock'])):?>
               <p><?= $errors['stock'] ?></p>
            <?php endif;?>
         </li>
         <li>
            <label for="">Tanggal Masuk</label>
            <input name="entry_date" type="date" value="<?= $data['entry_date'] ?? '' ?>">
         </li>
         <li>
            <label for="">Deskripsi</label>
            <textarea name="description" id=""><?= $data['description'] ?></textarea>
            <?php if(isset($errors['description'])):?>
               <p><?= $errors['description'] ?></p>
            <?php endif;?>
         </li>
      </ul>

      <div class="submit-cancel">
         <a href="/pages/products/index.php">cancel</a>
         <button type="submit" name="update">submit</button>
      </div>
   </form>

</body>
</html>