<?php

if(isset($_POST["submit"])){

  $email=$_POST["email"];
  $pass=$_POST["Password"];

  require_once "../controller/loginController.php";

  $login= new LoginController($email,$pass);

  $login->loginUser();

  header("location: ../view/category/category.php");
  exit;


}