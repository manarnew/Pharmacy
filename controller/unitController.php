<?php
include '../model/unit.php';
class unitController extends Unit{
    public function unitAdd($unitName,$isMaster){
        if($unitName == ''){
            $_SESSION['flush'] = 'The unit name is require';
            header("location: ../view/units/units.php");
            exit;
        }
       if($this->add($unitName,$isMaster)){
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

    public function edit($unitName,$isMaster,$id){
        if($unitName == ''||$id == ''){
            $_SESSION['flush'] = 'The unit name is require';
            header("location: ../view/units/units.php");
            exit;
        }
       if($this->update($unitName,$isMaster,$id)){
        return true;
       }else{
        $_SESSION['flush'] = 'Something went wrong';
        header("location: ../view/units/units.php");
       }
    }
}