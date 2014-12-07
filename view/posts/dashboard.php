<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $posts = $view->getVariable("posts");
  $view->setVariable("title", "Dashboard");

?>


<div id="nueva">
					<form action="index.php?controller=posts&action=AddPost" method="POST">
					<p>Nuevo Post
					
					<input type="submit" id= "add" name ="add" value="Añadir"/></p>
					<textarea name="content" rows="6" cols="200"></textarea>
					</textarea>
					</form>
					
</div>

	<?php 
		if($posts == NULL): ?>
	<h3>No hay ningun post para mostrar</h3>
	<?php else : ?>
		<?php foreach ($posts as $post): ?>
	
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

	

	
		
		
		
		

