<?php

session_start();

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employees-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
   try {
      $pdo->beginTransaction();
      
      $request = getEmployeeRequest($_POST);
      $errors = validateEmployee($request);

      if (!empty($errors)) {
         $pdo->rollBack();
         $_SESSION['errors'] = $errors;
         $_SESSION['old'] = $request;
         header("Location: ../../pages/employees/edit.php?id=" . $request['employee_id']);
         exit;
      }

      $query = "UPDATE employees SET employee_number = :employee_number, full_name = :full_name, gender = :gender, birth_date = :birth_date, position = :position, salary = :salary WHERE employee_id = :employee_id";

      $stmt = $pdo->prepare($query);
      $stmt->execute([
         "employee_number"     => htmlspecialchars(trim($request['employee_number'])),
         "full_name"             => htmlspecialchars(trim($request['full_name'])),
         "gender"             => htmlspecialchars(trim($request['gender'])),
         "birth_date"           => htmlspecialchars(trim($request['birth_date'])),
         "position"  => htmlspecialchars(trim($request['position'])),
         "salary"  => htmlspecialchars(trim($request['salary'])),
         "employee_id" => htmlspecialchars(trim($request['employee_id']))
      ]);


      $pdo->commit();

      header("Location: ../../pages/employees/index.php");
      exit;
   } catch (PDOException $e) {
      $pdo->rollBack();
      throw $e;
   }
}
