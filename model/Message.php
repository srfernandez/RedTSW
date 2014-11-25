<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Friend {

  private $db;
  private $id;  
  private $sender;
  private $recipient;
  private $content;
  
   
   public function __construct($id=NULL, User $sender=NULL,User $recipient=NULL, $content=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->id = $id;
    $this->sender = $sender; 
	$this->recipient = $recipient;
	$this->content=$content;
  }
   
  public function getId() {
    return $this->id;
  }

   public function getSender() {
    return $this->sender;
  }
  public function setSender(User $sender) {
    $this->sender = $sender;
  }
  
   public function getRecipient() {
    return $this->recipient;
  }

  public function setRecipient(User $recipient) {
    $this->recipient = $recipient;
  }
  
  public function getContent(){
	return $this->sender;
  }
 
 public function setContent($content){
	$this->content = $content;
 }
 

  public function save($message) {
    $stmt = $this->db->prepare("INSERT INTO messages values (?,?,?)");
    $stmt->execute(array($message->getSender(), $message->getRecipient(),$message->getContent()));  
  }
  
  public function findBySender($sender){
    $stmt = $this->db->prepare("SELECT * FROM Messages WHERE sender=?");
    $stmt->execute(array($sender));
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!sizeof($message) == 0) {
      return new Post(
	$message["id"],
	$message["content"],
	new User($post["sender"]), new User($post["recipient"]));
    } else {
      return NULL;
    }   
  }
  
   public function findByRecipient($recipient){
    $stmt = $this->db->prepare("SELECT * FROM Messages WHERE recipient=?");
    $stmt->execute(array($recipient));
    $message = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!sizeof($message) == 0) {
      return new Post(
	$message["id"],
	$message["content"],
	new User($post["sender"]), new User($post["recipient"]));
    } else {
      return NULL;
    }   
  }

}