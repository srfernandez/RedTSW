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

  public function index() {
	$currentuser= $_SESSION["currentuser"];
	if (!isset($currentuser)) {
      throw new Exception("Not in session. This action requires login");
    }
	print_r($currentuser);
	$posts =$this ->post->findPosts($currentuser);
	 if ($posts == NULL) {
      throw new Exception("No hay ningun post para: ".$currentuser);
    }
	$this->view->setVariable("posts", $posts);
	$this->view->render("posts","dashboard");
  }
  
	public function addPost(){
		$posts= new Post();
		$currentuser=$_SESSION["currentuser"];
		if (isset($_POST["add"])){ // reaching via HTTP Post...
		  $posts->setContent($_POST["content"]);
		  $posts->setAuthor($currentuser);
		  
		  try{
			
			if ($posts->isValid()){
				print_r("Hola");
			  $this->post->save($posts);
			 
			  $this->view->redirect("posts", "index");	  
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
	
	public function favoritos(){
	if (!isset($this->currentuser)) {
      throw new Exception("Not in session. This action requires login");
    }
	$favoritos =$this -> post ->findPosts($this->currentuser);
	 if ($posts == NULL) {
      throw new Exception("No se encontro ningun favorito de: ".$currentuser);
    }
	$this->view->setVariable("favoritos", $favoritos);
	$this->view->render("favorito","dashboard");
	}
   
  
}