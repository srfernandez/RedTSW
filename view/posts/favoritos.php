<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $favoritos = $view->getVariable("favoritos");
  $view->setVariable("title", "Favoritos");

?>
<div>
	<h1>Favoritos</h1>
</div>

	<?php 
		if($favoritos == NULL): ?>
	<h3>No tienes ningun favorito</h3>
	<?php else : ?>
		<?php foreach ($favoritos as $post): ?>
	
		<div id="post">
			<div id="header"> 
				<a href="#"><?=$post-> getAuthor()?></a> 
			</div>
			<div id="cuerpo"> <p><?=$post -> getContent()?></p></div>
			<div id="footer">
				
				<span><?=$post -> getLikes()?></span><a href="index.php?controller=favorites&action=addFav&id=<?=$post->getidPost()?>"></a> 
			</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>		
