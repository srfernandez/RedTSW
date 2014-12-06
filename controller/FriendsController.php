<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Friend.php");
require_once(__DIR__."/../controller/DBController.php");

class FriendsController extends DBController {
 
  private $amigo;   
 
  
  public function __construct() {    
    parent::__construct();
    $this->amigo = new Friend();
  }
  

  public function show() {
	$currentuser=$_SESSION["currentuser"];
	$friends = $this->amigo->findAllFriends($currentuser);
	$request = $this->amigo->findRequests($currentuser);
	if(isset($_POST["friend"])){
		$busqueda=$_POST["friend"];
		$search = $this->amigo->findUsuarios($busqueda);
		if ($search == NULL) {
		  throw new Exception("No hay usuarios");
		}
		$this->view->setVariable("search", $search);
		//$this->view->redirect("friends","resultados");
	}
	$this->view->setVariable("request", $request);
	$this->view->setVariable("friends", $friends);
	$this->view->render("friends","index");
  }
  
  
     public function requests() { 
		$currentuser = $_SESSION["currentuser"];
		
		$request = $this->amigo->findRequests($currentuser);
		
		if ($request == NULL) {
		  throw new Exception("There're no friendship request for: ".$currentuser);
		}
		$this->view->setVariable("request", $request);
		$this->view->render("friends", "index");
  }
  
  public function requestFriendship(){
	$currentuser = $_SESSION["currentuser"];
	//if(isset($_POST["solicitar"])){
		if(isset($_GET["id"])){
		$friend=$_GET["id"];
		
		if($this->amigo->findPeticion($currentuser, $friend) == NULL){
		
			$this->amigo->save($currentuser, $friend);
			$this->view->setFlash("Solicitud de amistad a ".$friend." enviada correctamente");
			$this->view->setVariable("search", NULL);
			$this->view->redirect("friends","show");
		
		}else{
			$this->view->setFlash("Ya has enviado una solicitud a ".$friend);
		}
		$this->view->render("friends","index");
	}
  }
  
    
   public function acceptRequest() { 
   
		$currentuser = $_SESSION["currentuser"];
		
		if (isset($_POST["accept"])){
			$friendU=$_GET["id"];
			print_r($friendU);
			$friendship = $this->amigo->findPeticion($friendU, $currentuser);
			
			if ($friendship == NULL) {
			  throw new Exception("There's no relationship between the users: ");
			}
			$this->amigo->updateFriend($friendU, $currentuser);
			$this->view->redirect("friends", "show");
		}
		$this->view->render("friends", "index");   
   }
   
     
   public function rejectRequest($solicitud) {
	
	$currentuser = $_SESSION["currentuser"];
		if (isset($_POST["reject"])){
			$friendU=$_GET["id"];
			$friendship = $this->amigo->findPeticion($friendU, $currentuser);
			if ($friendship == NULL) {
			  throw new Exception("There's no relationship between the users: ");
			}
			$this->amigo->deleteFriend($friendship);
			$this->view->redirect("friends", "show"); 
		}
		$this->view->render("friends", "index"); 
   }
   
  
}
