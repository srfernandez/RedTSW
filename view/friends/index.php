<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $request = $view->getVariable("request");
  $search = $view->getVariable("search");

?>

<div>
	<h1>Buscar amistades</h1>
</div>	
		<form action="index.php?controller=friends&action=show" method="POST">
		<input type="text" name= "friend" value="friend"/>
		<input type="submit" id= "search" name ="search" value="Buscar"/>
		</form>
<?php 
if($search == NULL): ?>
	<h3>No se ha realizado ninguna busqueda </h3>
<?php else : ?>
<?php foreach ($search as $resultado): ?>
	<h2><?=$resultado->getUsername()?></h2>
		<form action="index.php?controller=friends&action=requestFriendship&id=<?=$resultado->getUsername()?>" method="POST">
		<input type="submit" id="solicitar" name="solicitar" value="Solicitar Amistad"/>
		</form>
<?php endforeach; ?>
<?php endif; ?>
<div>
	<h1>Solicitudes</h1>
</div>	
<?php 
if($request == NULL): ?>
	<h3>No hay solicitudes pendientes </h3>
<?php else : ?>
<?php foreach ($request as $solicitud): ?>
	<h2><?=$solicitud->getUsername()?></h2>
		<form action="index.php?controller=friends&action=rejectRequest&id=<?=$solicitud->getUsername()?>" method="POST">
		<input type="submit" id="reject" name="reject" value="Rechazar solicitud"/>
		</form>
		<form action="index.php?controller=friends&action=acceptRequest&id=<?=$solicitud->getUsername()?>" method="POST">
		<input type="submit" id="accept" name="accept" value="Aceptar solicitud"/>
		</form>
<?php endforeach; ?>
<?php endif; ?>
<div>
	<h1>Amigos</h1>
</div>	
<?php 
if($friends == NULL): ?>
	<h3>No tienes amigos :( </h3>
<?php else : ?>
<?php 
			foreach ($friends as $friend): ?>
			<h2><?=$friend->getUsername()?></h2>
			
<?php endforeach; ?>
<?php endif; ?>