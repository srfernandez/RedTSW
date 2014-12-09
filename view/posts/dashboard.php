<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $posts = $view->getVariable("posts");
  $view->setVariable("title", "Dashboard");

?>


<div id="nueva">
	<p><?=i18n("Nueva Publicacion")?></p>
	<form action="index.php?controller=posts&action=AddPost" method="POST">
	<textarea name="content" rows="6" cols="200"></textarea>
	<input type="submit" id= "add" name ="add" value="<?=i18n("Enviar")?>"/>
	
	</form>
					
</div>

	<?php 
		if($posts == NULL): ?>
	<h3><?=i18n("No hay ninguna publicacion")?></h3>
	<?php else : ?>
		<?php foreach ($posts as $post): ?>
	
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

	

	
		
		
		
		

