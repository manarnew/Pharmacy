<?php
require_once "../model/user.php";

class userController extends User{

  private   $username;
  private   $type;
  private   $pass;
  private   $repetPass;
  private    $email;

  public function __construct($username,$type,$pass,$repetPass,$email)
  {
    $this->username=$username;
    $this->type=$type;
    $this->pass=$pass;
    $this->repetPass=$repetPass;
    $this->email=$email;
  }
  public function signupUser(){
    if($this->emptyInput()==false){
        $_SESSION['flush'] = 'invalid input';
        header("location: ../view/users/addUser.php");
        exit;
    }
   
    if($this->passMatch()==false){
        $_SESSION['flush'] = 'passwords are not matching';
        header("location: ../view/users/addUser.php");
      exit;
    }
    $this->checkUser($this->username,$this->email);
    $mdPass=md5($this->pass);
    $this->setUser($this->username,$mdPass,$this->type,$this->email);
  }

  private function emptyInput(){
    $result;
    if(empty($this->username)||empty($this->pass)||empty($this->repetPass)||empty($this->email)){
        $result=false;
    }else{
        $result=true;
    }
    return $result;
  }
  private function passMatch(){
    $result;
    if($this->pass !== $this->repetPass){
        $result=false;
    }
    else
    {
        $result=true;
    }
    return $result;
  }

  public function updateUser($id){
    $mdPass=md5($this->pass);
    if($this->editUser($this->username,$this->type,$mdPass,$this->email,$id)){
      return true;
    }else{
      return false;
    }
  }
}