<!DOCTYPE html>
<?php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $view->setVariable("title", "Login");
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 
?>
<link href="../../resources/css/styles.css" rel="stylesheet">
<body>
		<div id="container">
		<div id="encabezado">
		</div>
		
		<div id="formularios">
		<div id="lform"
		<legend>Login</legend>
		<form action = "index.php?controller=users&action=login" method = "POST">
			<p>
			<label>User </label></br> <input type="text" name= "username" /></br>
			<label>Password </label></br> <input type="password" name= "passwd" /></br>
			</p>
			<p align="right"><input type = "submit" value="Login" /></p>
		
		</form>
		
		</div>
		<div id="rform">
		<legend>Register here!</legend>
		<form action = "index.php?controller=users&action=register" method = "POST">
			<p>
			<label>User </label></br> <input type="text" name= "username" /></br>
			<label>Password </label></br> <input type="password" name= "passwd" /></br>
			<label>Email </label></br> <input type="text" name= "mail" /></br>
			</p>
			<p align="right"><input type = "submit" value="Register" /></p>
		
		</form>
		
		</div>
		</div>
		</div>
	</body>

</html>
