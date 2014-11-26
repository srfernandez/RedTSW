<?php
  require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Register");
 
?>
<link href="../../resources/css/styles.css" rel="stylesheet">
<body>
		<div id="container">
		<div id="encabezado">
		</div>
		
		<div id="formulario">
		<legend>Register here!</legend>
		<form action = "index.php?controller=users&action=register" method = "POST">
			<p>
			<label>User </label></br> <input type="text" name= "username" /></br>
			<label>Password </label></br> <input type="password" name= "passwd" /></br>
			<label>Email </label></br> <input type="text" name= "mail" /></br>
			</p>
			<p align="right"><input type = "submit" value="Register" /></p>
		
		</form>
		<a href="index.php?controller=users&action=login">Already an user? Login here!</a>
		</div>
		
		
		</div>
	</body>

</html>