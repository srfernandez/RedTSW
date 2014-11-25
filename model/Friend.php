<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Friend {

  private $db;
  private $friend1;  
  private $friend2;
  private $status;
   
   public function __construct(User $friend1=NULL, User $friend2=NULL, $status=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->friend1 = $friend1;
    $this->friend2 = $friend2; 
	$this->status = $status;
  }
   
  public function getFriend1() {
    return $this->friend1;
  }

  public function setFriend1(User $friend1) {
    $this->friend1 = $friend1;
  }
  
   public function getFriend2() {
    return $this->friend2;
  }

  public function setFriend2(User $friend2) {
    $this->friend2 = $friend2;
  }
 
  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function save($friends) {
    $stmt = $this->db->prepare("INSERT INTO friends values (?,?,?)");
    $stmt->execute(array($friends->getFriend1(), $friends->getFriend2(), $friends->getStatus()));  
	$stmt = $this->db->prepare("INSERT INTO friends values (?,?,?)");
    $stmt->execute(array($friends->getFriend2(), $friends->getFriend1(), $friends->getStatus()));  
  }
  
  public function findAllFriends($username) {   
    $stmt = $this->db->query("SELECT * FROM friends WHERE friend1 = ?");  
	$stmt->execute(array($username));	
    $friends_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $friends_db;
  }
}
