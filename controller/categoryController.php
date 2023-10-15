<?php
include '../model/category.php';
class CategoryController extends Category{
    public function catAdd($catName){
        if($catName == ''){
            $_SESSION['flush'] = 'The category name is require';
            header("location: ../view/category/category.php");
            exit;
        }
       if($this->add($catName)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/category/category.php");
       }
    }
    public function deleteCat($id){
        if($this->delete($id)){
            return true;
           }else{
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/category/category.php");
           }
    }

    public function edit($catName,$id){
        if($catName == ''||$id == ''){
            $_SESSION['flush'] = 'The category name is require';
            header("location: ../view/category/category.php");
            exit;
        }
       if($this->update($catName,$id)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/category/category.php");
       }
    }
}