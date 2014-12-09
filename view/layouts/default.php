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
			<a href="index.php?controller=language&amp;action=change&amp;lang=es"><?=i18n("Espanol")?></a>
			<a href="index.php?controller=language&amp;action=change&amp;lang=en"><?=i18n("Ingles")?></a>
			<div id="apagar">
				
				<a href="index.php?controller=users&action=logout"><img src="css/apagar.png"  alt="LogOut" height="30" width="30" id="logout"></a>
			</div>
			
		</div>
		<main>
		
			<div id="right_column">
				<div id="perfil">
					<a href="index.php?controller=posts&action=indexAuthor&id=<?=$_SESSION["currentuser"]?>"><img src="css/Usuario-Icono.jpg"  alt="Usuario" height="100" width="100" id="usuario"> <?=$_SESSION["currentuser"]?></a>
				</div>

				<ul id="sidebar">
					<li id="enlaceMuro">
					<a href="index.php?controller=posts&action=index"><?=i18n("MURO")?></a>
					</li>
					<li id="enlaceFavoritos">
					<a href="index.php?controller=posts&action=favoritos" ><?=i18n("FAVORITOS")?></a>
					</li>
					<li id="Amigos">
					<a href="index.php?controller=friends&action=show"><?=i18n("AMIGOS")?></a>
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