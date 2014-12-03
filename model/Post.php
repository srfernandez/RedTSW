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

  public function save($post) {
    $stmt = $this->db->prepare("INSERT INTO posts values (?,?)");
    $stmt->execute(array($post->getContent(), $post->getAuthor()));  
  }

   public function update($post) {
    $stmt = $this->db->prepare("UPDATE posts set content=? where id=?");
    $stmt->execute(array( $post->getContent(), $post->getIdPost()));    
  }
  
  public function isValid(){
		$errors = array();
		 $errors = array();
	  if (strlen($this->content) == 0) {
			$errors["content"] = "El contenido del post no puede estar vacio";
      }
		if(sizeof($errors) > 0){
			throw new ValidationException($errors, "post is not valid");
		}
	}

  

  public function findPosts($usuario){
	$stmt = $this->db-> prepare("SELECT * FROM posts where author in ( SELECT friend1 from friends where friend2 = ? and status='1' UNION SELECT friend2 from friends where friend1 = ? and status='1' ) UNION SELECT * from posts where author = ? order by datePost DESC");
	$stmt -> execute(array($usuario,$usuario, $usuario));
	$post_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	print_r($post_db);
	$posts=array();
	foreach($post_db as $post) {
		array_push($posts, new Post($post["idPost"], $post["content"],$post["author"], $post["numLikes"], $post["datePost"]));
	}
	if(!empty($posts)){
	return $posts;}
	else{ return NULL;}
  }
}
