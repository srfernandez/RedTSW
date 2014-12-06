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

  public function save($friend1, $friend2) {
    $stmt = $this->db->prepare("INSERT INTO friends (friend1, friend2) values (?,?)");
	$stmt->execute(array($friend1, $friend2));
	
  }
  
  public function findAllFriends($currentuser) {   
	$stmt = $this->db->prepare("SELECT * FROM users where username in (SELECT friend1 from Friends where friend2 = ? and status='1' UNION SELECT friend2 from Friends where friend1 = ? and status='1') ORDER BY username");  
	
	$stmt->execute(array($currentuser, $currentuser));	
	
    $friends_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$friends=array();
	
	foreach ($friends_db as $friend) {
		array_push($friends, new User($friend["username"], $friend["passwd"], $friend["mail"]));
    }   
    return $friends;
  }

    public function findRequests($currentuser) {   
    $stmt = $this->db->prepare("SELECT * FROM users where username in ( SELECT friend1 from friends where friend2 = ? and status='0' ORDER BY dateFriend) ");  
	$stmt->execute(array($currentuser));	
    $requests_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $requests=array();
	foreach ($requests_db as $request) {
		array_push($requests, new User($request["username"], $request["passwd"], $request["mail"]));
    }   
    return $requests;
  }
  
  public function findPeticion($user1,$currentuser){
	$stmt = $this->db->prepare("SELECT * FROM Friends WHERE friend1= ? and friend2= ? and status = '0'");
	$stmt->execute(array($user1,$currentuser));
	$requests_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$requests=array();
	foreach ($requests_db as $request) {
		array_push($requests, new Friend($request["friend1"], $request["friend2"], $request["status"]));
    }   
	if(!empty($requests)){
		return $requests;
	}
	else{ return NULL;}
    
  }
  
  public function deleteFriend($friend, $user){
	$stmt = $this->db->prepare("DELETE FROM Friends WHERE friend1= ? and friend2= ?");
	$stmt->execute(array($friend, $user));
  }
  
  public function updateFriend($friend, $user){
	$stmt = $this->db->prepare("UPDATE Friends SET status='1' WHERE friend1= ? and friend2= ?");
	$stmt->execute(array($friend, $user));
  }
  
  public function findUsuarios($username){
		$stmt = $this->db->prepare("SELECT * FROM Users WHERE username = ?");
	$stmt->execute(array($username));
	$search_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$result=array();
	foreach ($search_db as $search) {
		array_push($result, new User($search["username"], $search["passwd"], $search["mail"]));
    }   
    return $result;
  }
  
  
}