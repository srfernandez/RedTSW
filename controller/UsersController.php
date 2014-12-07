<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../controller/DBController.php");

class UsersController extends DBController {
 
  private $usuario;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->usuario = new User();
	 $this->view->setLayout("welcome");  
  }

  public function login() {
   if (isset($_POST["username"])){ 
	  if ($this->usuario->isValidUser($_POST["username"], $_POST["passwd"])) {
		$_SESSION["currentuser"]=$_POST["username"];
		$this->view->redirect("posts", "index");  
	  }else{
		$errors = array();
		$errors["general"] = "El usuario no esta registrado";
		$this->view->setVariable("errors", $errors);
	  }
    }     
    $this->view->render("users", "login");
  }
  
public function register() {
    $user = new User();
    if (isset($_POST["username"])){ 
      $user->setUsername($_POST["username"]);
      $user->setPasswd($_POST["passwd"]);
	  $user->setMail($_POST["mail"]);
	  try{
		$user->checkIsValidForRegister(); 
		if (!$this->usuario->usernameExists($_POST["username"])){
		  $this->usuario->save($user);
		 
		  $this->view->setFlash("Username ".$user->getUsername()." successfully added. Please login now");
		  $this->view->redirect("users", "login");	  
		} else {
		  $errors = array();
		  $errors["username"] = "Username already exists";
		  $this->view->setVariable("errors", $errors);
		}
      }catch(ValidationException $ex) {
	$errors = $ex->getErrors();
	$this->view->setVariable("errors", $errors);
      }
    }
    $this->view->setVariable("user", $user);
    $this->view->render("users", "login");
  }

    public function logout() {
    session_destroy();
    $this->view->redirect("users", "login");
  }
}
