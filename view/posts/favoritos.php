<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $favoritos = $view->getVariable("favoritos");
  $view->setVariable("title", "Favorites");

?>
<div>
	<h1><?=i18n("Favoritos")?></h1>
</div>

	<?php 
		if($favoritos == NULL): ?>
	<h3><?=i18n("No tienes ningun favorito")?></h3>
	<?php else : ?>
		<?php foreach ($favoritos as $post): ?>
	
		<div id="post">
			<div id="header"> 
				<a href="index.php?controller=posts&action=indexAuthor&id=<?=$post->getAuthor()?>"><img src="css/Usuario-Icono.jpg"  alt="Usuario" height="20" width="20" id="usuario"> <?=$post-> getAuthor()?></a>
			</div>
			<div id="cuerpo"> <p><?=$post -> getContent()?></p></div>
			<div id="footer">
				
				<span><?=$post -> getLikes()?></span><a href="index.php?controller=favorites&action=addFav&id=<?=$post->getidPost()?>"></a> 
			</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>		
