<?php
include '../model/unit.php';
class unitController extends Unit{
    public function unitAdd($parentUnit,$childUnit){
        if($parentUnit == ''){
            $_SESSION['flush'] = 'The unit parent unit name is require';
            header("location: ../view/units/units.php");
            exit;
        }
       if($this->add($parentUnit,$childUnit)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/units/units.php");
       }
    }
    public function deleteUnit($id){
        if($this->delete($id)){
            return true;
           }else{
            $_SESSION['flush'] = 'Something went wrong';
            header("location: ../view/units/units.php");
           }
    }

    public function edit($parentUnit,$childUnit,$id){
        if($parentUnit == ''||$id == ''){
            $_SESSION['flush'] = 'The  parent unit name is require';
            header("location: ../view/units/units.php");
            exit;
        }
       if($this->update($parentUnit,$childUnit,$id)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/units/units.php");
       }
    }
}