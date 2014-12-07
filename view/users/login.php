<!DOCTYPE html>
<?php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $view->setVariable("title", "Login");
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
?>
		<div id="lform">
		<legend>Accede</legend>
		<form action = "index.php?controller=users&action=login" method = "POST">
			<p>
			<label>Usuario </label></br> <input type="text" name= "username" /></br>
			<label>Contraseña</label></br> <input type="password" name= "passwd" /></br>
			</p>
			<p align="right"><input type = "submit" value="Accede" /></p>
		
		</form>
		
		</div>
		<div id="rform">
		<legend>Registrate aqui</legend>
		<form action = "index.php?controller=users&action=register" method = "POST">
			<p>
			<label>Usuario</label></br> <input type="text" name= "username" /></br>
			<label>Contraseña </label></br> <input type="password" name= "passwd" /></br>
			<label>Email</label></br> <input type="text" name= "mail" /></br>
			</p>
			<p align="right"><input type = "submit" value="Registro"/></p>
		
		</form>
		
		</div>
