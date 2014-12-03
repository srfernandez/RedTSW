<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $posts = $view->getVariable("posts");

?>

<div>
	<h1>Nuevo Post</h1>
</div>	
		<form action="index.php?controller=posts&action=AddPost" method="POST">
		<input type="textarea" name= "post"/>
		<input type="submit" id= "search" name ="search" value="Añadir"/>
		</form>
	
<div>
	<h1>Posts</h1>
</div>	
<?php 
if($posts == NULL): ?>
	<h3>No hay ningun post para mostrar</h3>
<?php else : ?>
<?php foreach ($posts as $post): ?>
		<h2><?=$post-> getAuthor()?></h2>
		<?=$post -> getContent()?>
		<a href="index.php?controller=favorite&action=addFav">Añadir Favorito</a>
		
<?php endforeach; ?>
<?php endif; ?>
