<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/User.php");

class Friend {

  private $db;
  private $friend1;  
  private $friend2;
  private $status;
   
   public function __construct($friend1=NULL, $friend2=NULL, $status=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->friend1 = $friend1;
    $this->friend2 = $friend2; 
	$this->status = $status;
  }
   
  public function getFriend1() {
    return $this->friend1;
  }

  public function setFriend1($friend1) {
    $this->friend1 = $friend1;
  }
  
   public function getFriend2() {
    return $this->friend2;
  }

  public function setFriend2($friend2) {
    $this->friend2 = $friend2;
  }
 
  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

 
  
  
}