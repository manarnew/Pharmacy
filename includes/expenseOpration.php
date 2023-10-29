<?php
session_start();
include '../controller/expenseController.php';
// add Expense
if (isset($_POST['addSupplier'])) {
   $note = $_POST['note'];
   $price = $_POST['price'];
   $expe = new ExpenseController();
   if ($expe->expenseAdd($note, $price)) {
      $_SESSION['flush'] =  'Expense created successfully';
      header("location: ../view/expenses/expenses.php");
      exit;
   } else {
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/expenses/expenses.php");
      exit;
   }
}

//delete expenseController

if (isset($_GET['id'])) {
   $id = $_GET['id'];
   $sup = new ExpenseController();
   if ($sup->deleteExpenses($id)) {
      $_SESSION['flush'] = 'Expense deleted successfully';
      header("location: ../view/expenses/expenses.php");
      exit;
   } else {
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/expenses/expenses.php");
      exit;
   }
}
// update Expense
if (isset($_POST['expenseId'], $_POST['note'], $_POST['price'])) {
   $expenseId = $_POST['expenseId'];
   $note = $_POST['note'];
   $price = $_POST['price'];
   $sup = new ExpenseController();
   if ($sup->edit($expenseId, $note, $price)) {
      $_SESSION['flush'] =  'Expense updated successfully';
      header("location: ../view/expenses/expenses.php");
      exit;
   } else {
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/expenses/expenses.php");
      exit;
   }
}
