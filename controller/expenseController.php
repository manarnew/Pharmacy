<?php
include '../model/expenses.php';
class ExpenseController extends Expenses
{
    public function expenseAdd($note, $price)
    {
        if ($note == '' || $price == '') {
            $_SESSION['flush'] = 'check the input all the filed are required';
            header("location: ../view/expenses/expenses.php");
            exit;
        }
        if ($this->add($note, $price)) {
            return true;
        } else {
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/expenses/expenses.php");
        }
    }
    public function deleteExpenses($id)
    {
        if ($this->delete($id)) {
            return true;
        } else {
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/expenses/expenses.php");
        }
    }

    public function edit($expenseId, $note, $price)
    {
        if ($expenseId == '' || $note == '' || $price == '' ) {
            $_SESSION['flush'] = 'check the input all the filed are required';
            header("location: ../view/expenses/expenses.php");
            exit;
        }
        if ($this->update($expenseId, $note, $price)) {
            return true;
        } else {
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/expenses/expenses.php");
        }
    }
}
