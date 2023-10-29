<?php
session_start();
include '../model/settings.php';

   // update product
if(isset($_POST['updateSetting'])){
   $appName=$_POST['appName'];
   $qtyNumber=$_POST['qtyNumber'];
   $notifyDate=$_POST['notifyDate'];
   $image=$_POST['oldImage'];
      if(isset($_FILES["image"]["name"])){
         unlink("../view/include/images/$image");
   if ($_FILES["image"]["error"] == UPLOAD_ERR_OK){
      $folder = "../view/include/images/";
      if(!file_exists($folder))mkdir($folder);
      $temp = explode(".",$_FILES["image"]["name"]);
      $tempName = $_FILES["image"]["tmp_name"];
      $newFileName = round(microtime(true)) . '.'. end($temp);
      move_uploaded_file($tempName, $folder.$newFileName);
      $image = $newFileName;
  }
}
if($appName==''||$image==''||$notifyDate==''||$qtyNumber==''){
   $_SESSION['flush'] =  'All the filed are required';
   header("location: ../view/settings/details.php");
    exit;
}
   $pro = new Settings();
   if($pro->update($appName,$image,$notifyDate,$qtyNumber)){
    $_SESSION['flush'] =  'Settings updated successfully';
   header("location: ../view/settings/details.php");
    exit;
   }else{
      $_SESSION['flush'] =  'Error something wrong try agin';
      header("location: ../view/settings/details.php");
      exit;
   }
}