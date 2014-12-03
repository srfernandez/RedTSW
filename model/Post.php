<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../core/ValidationException.php");

class Post {

  private $db;
  private $idPost;  
  private $content;
  private $author;
   
   public function __construct($idPost=NULL, $content=NULL,$author=NULL) {
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

  public function setAuthor($author) {
    $this->author = $author;
  }
  

  public function save($post) {
    $stmt = $this->db->prepare("INSERT INTO posts values (?,?)");
    $stmt->execute(array($post->getContent(), $post->getAuthor()));  
  }

   public function update($post) {
    $stmt = $this->db->prepare("UPDATE posts set content=? where id=?");
    $stmt->execute(array( $post->getContent(), $post->getIdPost()));    
  }

  public function findPosts($usuario){
	$stmt = $this->db-> prepare("SELECT * FROM posts where author in ( SELECT friend1 from friends where friend2 = ? and status='1' UNION SELECT friend2 from friends where friend1 = ? and status='1' ) UNION SELECT * from posts where author = ? order by datePost DESC");
	$stmt -> execute(array($usuario,$usuario, $usuario));
	$post_db = $stmt->fetch(PDO::FETCH_ASSOC);
	$posts=array();
	foreach($post_db as $post) {
		array_push($posts, new Post($post["idPost"], $post["content"],$post["author"]));
	}
	if(!empty($posts)){
	return $posts;}
	else{ return NULL;}
  
  }
}
