<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $author = $view->getVariable("author");
 $postsAuthor = $view->getVariable("postsAuthor");
  $view->setVariable("title", "Posts");

?>
<div>
	<h1><?=i18n("Publicaciones de")?> <?=$author?></h1>
</div>
		<?php foreach ($postsAuthor as $post): ?>
	
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