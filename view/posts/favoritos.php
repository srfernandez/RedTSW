<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $favoritos = $view->getVariable("favoritos");

?>


	
<div>
	<h1>favoritos</h1>
</div>	
<?php 
if($favoritos == NULL): ?>
	<h3>No tienes ningun favorito</h3>
<?php else : ?>
<?php foreach ($favoritos as $post): ?>
		<h2><?=$post-> getAuthor()?></h2>
		<?=$post -> getContent()?>
		<a href="index.php?controller=favorite&action=addFav">Añadir Favorito</a>
		
<?php endforeach; ?>
<?php endif; ?>