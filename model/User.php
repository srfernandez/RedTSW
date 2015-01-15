<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class User {

  private $db;
  private $mail;  
  private $passwd;
  private $username;
   
   public function __construct($username=NULL, $passwd=NULL, $mail=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->username = $username;
    $this->passwd = $passwd; 
	$this->mail = $mail;
  }
   
  public function getMail() {
    return $this->mail;
  }

  public function setMail($mail) {
    $this->mail = $mail;
  }
  
  public function getPasswd() {
    return $this->passwd;
  }

  public function setPasswd($passwd) {
    $this->passwd = $passwd;
  }
 
  public function getUsername() {
    return $this->username;
  }

  public function setUsername($username) {
    $this->username = $username;
  }
  

  public function checkIsValidForRegister() {
      $errors = array();
	  if (strlen($this->username) < 5) {
	$errors["username"] = "El username debe contener al menos 5 caracteres de longitud";
      }
      if (strlen($this->mail) < 5) {
	$errors["mail"] = "El email debe contener al menos 5 caracteres de longitud";
      }
      if (strlen($this->passwd) < 5) {
	$errors["passwd"] = "LA contraseña debe contener al menos 5 caracteres de longitud";	
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "El users no es válido");
      }
  } 

 
  

}


