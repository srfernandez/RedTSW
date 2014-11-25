<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Post {

  private $db;
  private $idPost;  
  private $content;
  private $author;
   
   public function __construct($idPost=NULL, $content=NULL,User $author=NULL) {
	$this->db = PDOConnection::getInstance();
    $this->idPost = $idPost;
    $this->content = $content; 
	$this->author = $author;
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

  public function setAuthor(User $author) {
    $this->author = $author;
  }
  

  public function save($post) {
    $stmt = $this->db->prepare("INSERT INTO posts values (?,?)");
    $stmt->execute(array($post->getContent(), $post->getAuthor()));  
  }
  
  public function findAll() {   
    $stmt = $this->db->query("SELECT * FROM posts, users WHERE users.username = posts.author");    
    $posts_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $posts = array();
    
    foreach ($posts_db as $post) {
      $author = new User($post["username"]);
      array_push($posts, new Post($post["idPost"], $post["content"], $author));
    }   
    return $posts;
  }
  
    public function findByAuthor($author){
    $stmt = $this->db->prepare("SELECT * FROM posts WHERE author=?");
    $stmt->execute(array($author));
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!sizeof($post) == 0) {
      return new Post(
	$post["idPost"],
	$post["content"],
	new User($post["author"]));
    } else {
      return NULL;
    }   
  }

   public function update($post) {
    $stmt = $this->db->prepare("UPDATE posts set content=? where id=?");
    $stmt->execute(array( $post->getContent(), $post->getIdPost()));    
  }

  

  

}
