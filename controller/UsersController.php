<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../controller/DBController.php");

class UsersController extends DBController {
 
  private $user;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->user = new User();
  }

  public function login() {
  
   if (isset($_POST["username"])){ 
   
	  if ($this->user->isValidUser($_POST["username"], $_POST["password"])) {

		$user_db=$this->user->ver_datos($POST["username"]);
		$_SESSION["currentuser"]=$user_db;
		
		$this->view->setVariable("user", $user_db );
		
		// envia al usuario a una area restringida (su zona de usuario)
		$this->view->redirect("posts", "dashboard");  
	
	  }else{
		$errors = array();
		$errors["general"] = "El usuario no esta registrado";
		$this->view->setVariable("errors", $errors);
	  }
    }     
	
    // renderiza la vista (/view/users/login.php)
    $this->view->render("vistas", "login");    //falta poner bien
  }
  
  
  

  public function register() {
    
    $user = new User();
    
    if (isset($_POST["username"])){ 
      
      $user->setUsername($_POST["username"]);
      $user->setPasswd($_POST["passwd"]);
	  $user->setMail($_POST["mail"]);
      
      try{
	$user->checkIsValidForRegister(); 
	
	// comprueba si el correo ya existe en la base de datos
	if (!$this->userMapper->usernameExists($_POST["username"])){
	
	  // guarda el objeto User en la base de datos
	  $this->userMapper->save($user);
	  
	  $this->view->setFlash("Usuario ".$userMapper->getNombreU()." corrrectamente añadido");
	  
	  // cabecera("Location: index.php?controller=users&action=login")
	  
	  $this->view->redirect("users", "login");
	} else {
	  $errors = array();
	  $errors["username"] = "El usuario ya existe";
	  $this->view->setVariable("errors", $errors);
	}
      }catch(ValidationException $ex) {
	
	$errors = $ex->getErrors();

	$this->view->setVariable("errors", $errors);
      }
    } 
    $this->view->setVariable("user", $user);  
   
    // renderiza la vista (/view/users/registro.php)
    $this->view->render("vistas", "login"); 
    
  }

  
}
