<?php
include '../model/Login.php';

class LoginController extends Login {

  private   $email;
  private   $pass;

  public function __construct($email,$pass)
  {
    $this->email=$email;
    $this->pass=$pass;
  }
  public function loginUser(){
    if($this->emptyInput()==false){
      session_start();
      $_SESSION['flush'] = 'User email and password is require';
      header("location: /pharnacyapp/index.php");
      exit;
    }
    $mdPass=md5($this->pass);
    $this->getUser($this->email,$mdPass);
  }

  private function emptyInput(){
    $result;
    if(empty($this->email)||empty($this->pass)){
        $result=false;
    }else{
        $result=true;
    }
    return $result;
  }


}

