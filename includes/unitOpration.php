<?php
session_start();
include '../controller/unitController.php';
// add Unit
if(isset($_POST['addUnit'])){
   $unitName=$_POST['unitName'];
   $isMaster=$_POST['isMaster'];
   $unit = new unitController();
   if($unit->unitAdd($unitName,$isMaster)){
    $_SESSION['flush'] =  'Unit created successfully';
    header("location: ../view/units/units.php");
    exit;
   };
}

   //delete unit
 
   if(isset($_GET['id'])){
    $id=$_GET['id'];
    $unit = new unitController();
   if( $unit->deleteUnit($id)){
   $_SESSION['flush'] = 'Unit deleted successfully';
    header("location: ../view/units/units.php");
   }
}
   // update unit
if(isset($_POST['updateUnit'])){
   $unitName=$_POST['unitName'];
   $isMaster=$_POST['isMaster'];
   $id=$_POST['unitId'];
   $cat = new unitController();
   if($cat->edit($unitName,$isMaster,$id)){
    $_SESSION['flush'] =  'Unit updated successfully';
   header("location: ../view/units/units.php");
    exit;
   };
}