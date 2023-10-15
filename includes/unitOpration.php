<?php
session_start();
include '../controller/unitController.php';
// add Unit
if(isset($_POST['addUnit'])){
   $parentUnit=$_POST['parentUnit'];
   $childUnit=$_POST['childUnit'];
   $unit = new unitController();
   if($unit->unitAdd($parentUnit,$childUnit)){
    $_SESSION['flush'] =  'Unit created successfully';
    header("location: ../view/units/units.php");
    exit;
   };
}

   //delete categories
 
   if(isset($_GET['id'])){
    $id=$_GET['id'];
    $unit = new unitController();
   if( $unit->deleteUnit($id)){
   $_SESSION['flush'] = 'Unit deleted successfully';
    header("location: ../view/units/units.php");
   }
}
   // update category
if(isset($_POST['updateUnit'])){
   $parentUnit=$_POST['parentName'];
   $childUnit=$_POST['childName'];
   $id=$_POST['unitId'];
   $cat = new unitController();
   if($cat->edit($parentUnit,$childUnit,$id)){
    $_SESSION['flush'] =  'Unit updated successfully';
   header("location: ../view/units/units.php");
    exit;
   };
}