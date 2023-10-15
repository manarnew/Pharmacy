<?php
session_start();
include '../controller/categoryController.php';
// add categories
if(isset($_POST['addCategory'])){
   $name=$_POST['category'];
   $cat = new CategoryController();
   if($cat->catAdd($name)){
    $_SESSION['flush'] =  'Category created successfully';
    header("location: ../view/category/category.php");
    exit;
   };
}

   //delete categories
 
   if(isset($_GET['id'])){
    $id=$_GET['id'];
    $cat = new CategoryController();
   if( $cat->deleteCat($id)){
   $_SESSION['flush'] = 'Category deleted successfully';
    header("location: ../view/category/category.php");
   }
}
   // update category
if(isset($_POST['updateCat'],$_POST['category'],$_POST['categoryId'])){
   $name=$_POST['category'];
   $id=$_POST['categoryId'];
   $cat = new CategoryController();
   if($cat->edit($name,$id)){
    $_SESSION['flush'] =  'Category updated successfully';
   header("location: ../view/category/category.php");
    exit;
   };
}