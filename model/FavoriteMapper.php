<?php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
class FavoriteMapper {

public function __construct() {
	$this->db = PDOConnection::getInstance();
  }
  
  
   public function incrementar($post){
	$stmt = $this->db->prepare("UPDATE posts SET numLikes= numLikes+1 WHERE idPost = ?");
	$stmt -> execute(array($post));
  }

  
 public function save($post,$username) {
    $stmt = $this->db->prepare("INSERT INTO favorites (post, username) values (?,?)");
    $stmt->execute(array($post, $username));  
  }
  public function favoritoExists($post, $username){
	$stmt = $this->db->prepare("SELECT count(post) from favorites where post= ? and username = ?");
	$stmt->execute(array($post,$username));
	 if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }
  
  public function eliminar($post, $username){
	$stmt = $this->db->prepare("DELETE FROM favorites WHERE post= ? and username= ?");
	$stmt->execute(array($post,$username));
  }
    public function restar($post){
	$stmt = $this->db->prepare("UPDATE posts SET numLikes= numLikes-1 WHERE idPost = ?");
	$stmt -> execute(array($post));
  }
  
  }
  
  ?>