<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");

class Favorite {

  private $db;
  private $id;  
  private $post;
  private $username;
   
   public function __construct($id=NULL, $post=NULL, $username=NULL) {
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
  public function setPost($post) {
    $this->post = $post;
  }
  
   public function getUser() {
    return $this->username;
  }

  public function setUser($username) {
    $this->username = $username;
  }
  

}