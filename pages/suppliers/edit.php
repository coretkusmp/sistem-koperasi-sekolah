<?php 
require_once __DIR__ . "/../../repositories/supplier-repository.php";

session_start();

$supplier_id = (int) ($_GET['id'] ?? 0);
$supplier = getSupplier($supplier_id);

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$data = !empty($old) ? $old : $supplier;
unset($_SESSION['errors'], $_SESSION['old']);

$productTypes = [];
if (!empty($data['product_types'])) {
    if (is_array($data['product_types'])) {
        $productTypes = $data['product_types'];
    } else {
        $productTypes = array_map('trim', explode(',', strtolower($data['product_types'])));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Supplier</title>
   <link rel="stylesheet" href="/style/base.css">
</head>

<body>
   <?php require_once __DIR__ . "/../../components/navbar.php" ?>

   <form method="post" action="/actions/suppliers/update.php">
      <input type="hidden" name="supplier_id" value="<?= $supplier_id ?>">   

      <ul>
         <li>
            <label>Nama Supplier</label>
            <input name="supplier_name" type="text" value="<?= htmlspecialchars($data['supplier_name'] ?? '') ?>">
            <?php if (isset($errors['supplier_name'])): ?>
               <p><?= $errors['supplier_name'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label>Email</label>
            <input name="email" type="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
               <p><?= $errors['email'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label>Telepon</label>
            <input name="phone" type="tel" value="<?= htmlspecialchars($data['phone'] ?? '') ?>">
            <?php if (isset($errors['phone'])): ?>
               <p><?= $errors['phone'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label>Alamat</label>
            <textarea name="address"><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
            <?php if (isset($errors['address'])): ?>
               <p><?= $errors['address'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label>Jenis Produk</label>
            <div>
               <label><input type="checkbox" name="product_types[]" value="food" <?= in_array('food', $productTypes) ? 'checked' : '' ?>> Food</label>
               <label><input type="checkbox" name="product_types[]" value="drink" <?= in_array('drink', $productTypes) ? 'checked' : '' ?>> Drink</label>
               <label><input type="checkbox" name="product_types[]" value="stationery" <?= in_array('stationery', $productTypes) ? 'checked' : '' ?>> Stationery</label>
               <label><input type="checkbox" name="product_types[]" value="uniform" <?= in_array('uniform', $productTypes) ? 'checked' : '' ?>> Uniform</label>
            </div>
            <?php if (isset($errors['product_types'])): ?>
               <p><?= $errors['product_types'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label>Tanggal Kemitraan</label>
            <input name="partnership_date" type="date" value="<?= htmlspecialchars($data['partnership_date'] ?? '') ?>">
            <?php if (isset($errors['partnership_date'])): ?>
               <p><?= $errors['partnership_date'] ?></p>
            <?php endif; ?>
         </li>
      </ul>

      <div class="submit-cancel">
         <a href="/pages/suppliers/index.php">cancel</a>
         <button type="submit" name="update">submit</button>
      </div>
   </form>

</body>
</html>