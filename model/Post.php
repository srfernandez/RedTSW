<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Post {

  private $db;
  private $idPost;  
  private $content;
  private $author;
  private $numLikes;
  private $datePost;
   
   public function __construct($idPost=NULL, $content=NULL,$author=NULL, $numLikes=NULL, $datePost=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->idPost = $idPost;
    $this->content = $content; 
	$this->author = $author;
	$this->numLikes = $numLikes;
	$this -> datePost = $datePost;
  }
   
  public function getIdPost() {
    return $this->idPost;
  }

  public function getContent() {
    return $this->content;
  }

  public function setContent($content) {
    $this->content = $content;
  }
 
  public function getAuthor() {
    return $this->author;
  }

  public function setAuthor($author) {
    $this->author = $author;
  }
  
    public function getLikes() {
    return $this->numLikes;
  }

  public function setLikes($numLikes) {
    $this->numLikes = $numLikes;
  }
  
    public function getdatePost() {
    return $this->datePost;
  }

  public function setdatePost($datePost) {
    $this->datePost = $datePost;
  }



}
