<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../controller/DBController.php");

class PostsController extends DBController {
 
  private $post;   
 
  
  public function __construct() {    
    parent::__construct();
    
    $this->post = new Post();

  }

  public function dashboard() {
	$currentuser=$_SESSION["currentuser"];
	$posts =$this -> post ->findPosts($currentuser);
	 if ($posts == NULL) {
      throw new Exception("No se encontro ningun amigo de: ".$currentuser->getUsername());
    }
	$this->view->setVariable("posts", $posts);
	$this->view->render("posts","dashboard");
  }
  
	public function newPost(){
		$posts= new Post();
		$currentuser=$_SESSION["currentuser"];
		if (isset($_POST["content"])){ // reaching via HTTP Post...
		  $posts->setContent($_POST["content"]);
		  $posts->setAuthor($currentuser);
		  
		  try{
			
			if ($posts->validFormat(); ){
			  $this->post->save($post);
			 
			  $this->view->redirect("posts", "dashboard");	  
			} else {
			  $errors = array();
			  $errors["general"] = "Error al publicar el post";
			  $this->view->setVariable("errors", $errors);
			}
		  }catch(ValidationException $ex) {

		$errors = $ex->getErrors();

		$this->view->setVariable("errors", $errors);
		  }
		}
		
		$this->view->setVariable("posts", $posts);
		
		$this->view->render("posts", "dashboard");
		
	  }

   
  
}