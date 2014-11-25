<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");

class Friend {

  private $db;
  private $id;  
  private $post;
  private $username;
   
   public function __construct($id=NULL, Post $post=NULL,User $username=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->id = $id;
    $this->post = $post; 
	$this->username = $username;
  }
   
  public function getId() {
    return $this->id;
  }

   public function getPost() {
    return $this->post;
  }
  public function setPost(Post $post) {
    $this->post = $post;
  }
  
   public function getUser() {
    return $this->username;
  }

  public function setUser(User $username) {
    $this->username = $username;
  }
 
 

  public function save($favorite) {
    $stmt = $this->db->prepare("INSERT INTO favorites values (?,?)");
    $stmt->execute(array($favorite->getPost(), $favorite->getUser()));  
  }
  

}