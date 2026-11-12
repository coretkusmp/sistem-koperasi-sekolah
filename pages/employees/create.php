<?php
require_once __DIR__ . "/../../repositories/employee-repository.php";

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

   <form method="post" action="/actions/employees/store.php">
      <ul>
         <li>
            <label for="">Nomor Karyawan</label>
            <input name="employee_number" type="text" value="<?= $old['employee_number'] ?? '' ?>">
            <?php if (isset($errors['employee_number'])): ?>
               <p><?= $errors['employee_number'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label for="">Nama Lengkap</label>
            <input name="full_name" type="text" value="<?= $old['full_name'] ?? '' ?>">
            <?php if (isset($errors['full_name'])): ?>
               <p><?= $errors['full_name'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label for="">Kelamin</label>
            <div class="radio-buttons">
               <span class="gender-radio-button">
                  <label for="">Laki-Laki</label>
                  <input type="radio" name="gender" value="M" <?= (isset($old['gender']) && $old['gender'] === 'M') ? 'checked' : '' ?>>
               </span>
               <span class="gender-radio-button">
                  <label for="">Perempuan</label>
                  <input type="radio" name="gender" value="F" <?= (isset($old['gender']) && $old['gender'] === 'F') ? 'checked' : '' ?>>
               </span>
            </div>
            <?php if (isset($errors['gender'])): ?>
               <p><?= $errors['gender'] ?></p>
            <?php endif; ?>
         </li>
         <li>
            <label for="">Tanggal Lahir</label>
            <input name="birth_date" type="date" value="<?= $old['birth_date'] ?? '' ?>">
         <li>
            <label for="">Jabatan</label>
            <select name="position" id="">
               <option value="none">-</option>
               <option value="Cashier">Cashier</option>
               <option value="Warehouse Staff">Warehouse Staff</option>
               <option value="Admin">Admin</option>
            </select>
         </li>
         <li>
            <label for="">Gaji</label>
            <input name="salary" type="number" value="<?= $old['salary'] ?? '' ?>">
            <?php if (isset($errors['salary'])): ?>
               <p><?= $errors['salary'] ?></p>
            <?php endif; ?>
         </li>

         <div class="submit-cancel">
            <a href="/pages/employees/index.php">cancel</a>
            <button type="submit" name="store">submit</button>
         </div>
   </form>

</body>

</html>