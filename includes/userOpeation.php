<?php
session_start();

require_once "../model/user.php";
require_once "../controller/userController.php";
// add users to the database
if(isset($_POST["submit"])){

  $username=$_POST["name"];
  $type=$_POST["type"];
  $pass=$_POST["pass"];
  $repetPass=$_POST["repetPass"];
  $email=$_POST["email"];


  $signup= new userController($username,$type,$pass
  ,$repetPass,$email);

  $signup->signupUser();

  header("location: ../view/users/showUser.php");
  exit;

}


// Update user and profile 
if(isset($_POST["update_user"])){

  $username=$_POST["name"];
  $email=$_POST["email"];
  $password=$_POST["password"];
  $type=$_POST["type"]??'';

  require_once "../model/user.php";
  require_once "../controller/userController.php";

  $updateUser= new userController($username,$type,$password,'',$email);
  /* 
   condition if set $_POST['id'] update user from user page 
   and if set  $_SESSION['id'] update user from profile page
  */
  $id = $_POST['id'] ?? $_SESSION['id'];
  if($updateUser->updateUser($id)){
    if(isset($_POST['id'])){
      $_SESSION['flush'] =  'User updated successfully';
      header("location: ../view/users/showUser.php");
      exit;
    }else{
      $_SESSION['flush'] =  'Profile updated successfully';
      header("location: ../view/users/profile.php");
      exit;
    }
  }else{
    if(isset($_POST['id'])){
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/users/showUser.php");
      exit;
    }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
    header("location: ../view/users/profile.php");
    exit;
    }
   
  }

 

}

   //delete user
 
   if(isset($_GET['idForDelete'])){
    $id=$_GET['idForDelete'];
    $sup = new userController($id,null,null,null,null);
   if( $sup->deleteUser()){
   $_SESSION['flush'] = 'user deleted successfully';
    header("location: ../view/users/showUser.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/users/showUser.php");
      exit;
   }
}