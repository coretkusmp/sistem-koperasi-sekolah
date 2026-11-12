<?php

session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employees-validation.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
   try {
      $pdo->beginTransaction();

      $request = getemployeeRequest($_POST);
      $errors = validateemployee($request);

      if (!empty($errors)) {
         $pdo->rollBack();
         $_SESSION['errors'] = $errors; 
         $_SESSION['old'] = $request; 
         header("Location: ../../pages/employees/create.php");
         exit;
      }

      $query = "INSERT INTO employees (employee_number, full_name, gender, birth_date, position, salary)
                VALUES (:employee_number, :full_name, :gender, :birth_date, :position, :salary)";

      $stmt = $pdo->prepare($query);
      $stmt->execute([
         "employee_number"     => htmlspecialchars(trim($request['employee_number'])),
         "full_name"             => htmlspecialchars(trim($request['full_name'])),
         "gender"             => htmlspecialchars(trim($request['gender'])),
         "birth_date"           => htmlspecialchars(trim($request['birth_date'])),
         "position"  => htmlspecialchars(trim($request['position'])),
         "salary"  => htmlspecialchars(trim($request['salary'])),
      ]);

      $pdo->commit();

      header("Location: ../../pages/employees/index.php");
      exit;

   } catch (PDOException $e) {
      $pdo->rollBack();
      throw $e;
   }
}