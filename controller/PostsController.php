<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/Posts.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../controller/DBController.php");

class PostsController extends DBController {
 
  private $postMapper;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->postMapper = new Post();
  }

  public function dashboard() {
       $posts =$this->postMapper->findAll();
	   
	
    
    $this->view->render("posts", "dashboard");    
  }
  

  
}
