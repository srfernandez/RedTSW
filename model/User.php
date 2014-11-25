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
    $this->mail = $mail;
    $this->passwd = $passwd; 
	$this->username = $username;
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
      if (strlen($this->emailU) < 5) {
	$errors["emailU"] = "El email debe contener al menos 5 caracteres de longitud";
      }
      if (strlen($this->passwd) < 5) {
	$errors["passwd"] = "LA contraseña debe contener al menos 5 caracteres de longitud";	
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "El users no es válido");
      }
  } 

  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO users values (?,?,?)");
    $stmt->execute(array($user->getUsername(), $user->getPasswd(), $user->getMail()));  
  }
  

  
  public function usernameExists($username) {
    $stmt = $this->db->prepare("SELECT count(username) FROM users where username=?");
    $stmt->execute(array($username));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }
  
  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
    $stmt->execute(array($username, $passwd));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }
  

  
  public function ver_datos($username) {
		$stmt = $this->db->prepare("SELECT * FROM users where username=?");
		$stmt->execute(array($username));
		$users_db=$stmt->fetch(PDO::FETCH_ASSOC);
		
		if(sizeof($users_db)==0){
			return null;
		}else{
			return new User(
			$users_db["username"],
			$users_db["passwd"],
			$users_db["mail"]
			);
		}
	}
}


