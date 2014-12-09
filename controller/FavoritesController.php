<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/Favorite.php");
require_once(__DIR__."/../model/Post.php");
require_once(__DIR__."/../controller/DBController.php");

class FavoritesController extends DBController {
 
  private $favorito;   
 
  
  public function __construct() {    
    parent::__construct();
    
    $this->favorito = new Favorite();
	$this->post= new Post();

  }
  
  public function addFav(){
	if(isset($_GET["id"])){
		$post=$_GET["id"];
		$currentuser=$_SESSION["currentuser"];
		if(!$this->favorito->favoritoExists($post,$currentuser)){
		$this->favorito->save($post,$currentuser);
		$this->favorito->incrementar($post);
		$this->view->redirect("posts","index");
		}else{
			$this->favorito->eliminar($post, $currentuser);
			$this->favorito->restar($post);
			$this->view->redirect("posts","index");
		}
		
	}
	$this->view->render("posts","dashboard");
  }
}