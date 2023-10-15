<?php
include '/xampp/htdocs/pharmacyapp/database/connection.php';
class Category extends connection{
  public function add($catName){
    $check = $query = $this->dbConnction()->prepare("SELECT categoryId  FROM categories where categoryName = ?
                                                     LIMIT 1");
    $check->execute([$catName]);
    $name=$query->fetchAll();
    if(count($name) > 0){
      $_SESSION['flush'] = 'This item is exist';
    header("location: ../view/category/category.php");
    exit;
    }
    $query = 'INSERT INTO categories (categoryName) VALUE (?)';

    $query =  $this->dbConnction()->prepare($query);
     
    $query->execute([$catName]);

    if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }

  public function index(){
      $query = $this->dbConnction()->prepare("SELECT *  FROM categories");
      $query->execute();
      return $query->fetchAll();
  }

  public function delete($id){
     $query = 'DELETE FROM categories WHERE categoryId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
  public function getOneCat($id){
    $query = 'SELECT * FROM categories WHERE categoryId=?';
    $query = $this->dbConnction()->prepare($query);
    $query->execute([$id]);
    return $query->fetch();
  }

  public function update($catName,$id){
     $query = 'UPDATE categories SET categoryName = ? WHERE categoryId=?';
     $query = $this->dbConnction()->prepare($query);
     $query->execute([$catName,$id]);
     if($query->rowCount()){
      return true;
     }else{
      return false;
     }
  }
}