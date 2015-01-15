<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
class PostMapper {

public function __construct() {
	$this->db = PDOConnection::getInstance();
  }
  
   public function save($post) {
    $stmt = $this->db->prepare("INSERT INTO posts (content, author) values (?,?)");
    $stmt->execute(array($post->getContent(), $post->getAuthor()));  
  }

   public function update($post) {
    $stmt = $this->db->prepare("UPDATE posts set content=? where id=?");
    $stmt->execute(array( $post->getContent(), $post->getIdPost()));    
  }
  
  public function isValid($post){
		$errors = array();
		
	  if (strlen($post->getContent()) == 0) {
			$errors["content"] = "El contenido del post no puede estar vacio";
			return false;
      }
		if(sizeof($errors) > 0){
			throw new ValidationException($errors, "post is not valid");
		}
		return true;
	}

  

  public function findPosts($usuario){
	$stmt = $this->db-> prepare("SELECT * FROM posts where author in ( SELECT friend1 from friends where friend2 = ? and status='1' UNION SELECT friend2 from friends where friend1 = ? and status='1' ) UNION SELECT * from posts where author = ? order by datePost DESC");
	$stmt -> execute(array($usuario,$usuario, $usuario));
	$post_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$posts=array();
	foreach($post_db as $post) {
		array_push($posts, new Post($post["idPost"], $post["content"],$post["author"], $post["numLikes"], $post["datePost"]));
	}
	if(!empty($posts)){
	return $posts;}
	else{ return NULL;}
  }

    public function favoritos($usuario){
	$stmt = $this->db->prepare("SELECT * from posts where idPost in (SELECT post from favorites where username= ?)");
	$stmt -> execute(array($usuario));
	$post_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$posts=array();
	foreach($post_db as $post) {
		array_push($posts, new Post($post["idPost"], $post["content"],$post["author"], $post["numLikes"], $post["datePost"]));
	}
	return $posts;
  }
  
  public function findByAuthor($usuario){
	$stmt = $this->db->prepare("SELECT * from posts where author= ?");
	$stmt -> execute(array($usuario));
	$post_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$posts=array();
	foreach($post_db as $post) {
		array_push($posts, new Post($post["idPost"], $post["content"],$post["author"], $post["numLikes"], $post["datePost"]));
	}
	return $posts;
  }
  
  }
  
  ?>