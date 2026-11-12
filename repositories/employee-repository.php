<?php

require_once __DIR__ . "/../config/database.php";
function getEmployees(){
   global $pdo;
   
   $query = "select * from employees";

   $stmt = $pdo->prepare($query);
   $stmt->execute();

   $employees = $stmt->fetchAll();

   return $employees;
};

function getEmployee($id)
{
   global $pdo;

   $query = "select * from employees where employee_id = :employee_id";

   $stmt = $pdo->prepare($query);
   $stmt->execute([
      "employee_id" => $id
   ]);

   $employee = $stmt->fetch();


   if (!$employee) {
      header("Location: ../employees/index.php");
      exit;
   }
   return $employee;
}