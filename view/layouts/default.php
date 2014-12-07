<?php
 //file: view/layouts/default.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");
 
?><!DOCTYPE html>
<html>
  <head>
    <title><?= $view->getVariable("title", "no title") ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
  </head>
  <body>    
	<div id="container">
		<div id="encabezado">
			<div id="apagar">
				<a href="index.php?controller=users&action=logout"></a>
			</div>
			
		</div>
		<main>
		
			<div id="right_column">
				<div id="perfil">
					<input type= "button" name="perfil" OnClick="#">
					<a href="#"><?=$_SESSION["currentuser"]?></a>
				</div>

				<ul id="sidebar">
					<li id="enlaceMuro">
					<a href="index.php?controller=posts&action=index">MURO</a>
					</li>
					<li id="enlaceFavoritos">
					<a href="index.php?controller=posts&action=favoritos" >FAVORITOS</a>
					</li>
					<li id="Amigos">
					<a href="index.php?controller=friends&action=show">AMIGOS</a>
					</li>
					</li>
				</ol>
			</div>
			
			
			<div id="left_column">
				<div id="flash">
					<?= $view->popFlash() ?>
				</div>
		  
				<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>    
				
			</div>
		</main>
	</div>
  </body>
</html>