<?php
require_once __DIR__ . "/../../repositories/employee-repository.php";


session_start();
$employees  = getEmployees();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Karyawan</title>

   <link rel="stylesheet" href="/style/base.css">
</head>

<body>
   <?php require_once __DIR__ . "/../../components/navbar.php" ?>

   <div class="toolbar">
      <a href="create.php" class="btn btn-primary">+ Tambah Kategori</a>
   </div>

   <div class="card">
      <table>
         <thead>
            <tr>
               <th>Nomor Karyawan</th>
               <th>Nama Lengkap</th>
               <th>Kelamin</th>
               <th>Tanggal Lahir</th>
               <th>Jabatan</th>
               <th>Gaji</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($employees as $employee): ?>
               <tr>
                  <td><?= $employee['employee_number'] ?></td>
                  <td><?= $employee['full_name'] ?></td>
                  <td><?= $employee['gender'] ?></td>
                  <td><?= $employee['birth_date'] ?></td>
                  <td><?= $employee['position'] ?></td>
                  <td><?= $employee['salary'] ?></td>
                  <td><a href="edit.php?id=<?= $employee['employee_id'] ?>">Edit</a> <a href="/actions/employees/destroy.php?id=<?= $employee['employee_id'] ?>">Hapus</a></td>
               </tr>
            <?php endforeach; ?>
</body>

</html>