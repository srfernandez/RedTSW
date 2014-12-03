<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $request = $view->getVariable("request");

?>

<div>
	<h1>Buscar amistades</h1>
</div>	
		<form action="index.php?controller=friends&action=search" method="POST">
		<input type="text" name= "friend"/>
		<input type="submit" id= "search" name ="search" value="Buscar"/>
		</form>
	
<div>
	<h1>Solicitudes</h1>
</div>	
<?php 
if($request == NULL): ?>
	<h3>No hay solicitudes pendientes </h3>
<?php else : ?>
<?php foreach ($request as $solicitud): ?>
		<form action="index.php?controller=friends&action=rejectRequest" method="POST">
		<h2><?=$solicitud->getUsername()?></h2>
		<input type="submit" id="reject" name="reject" value="Rechazar solicitud"/>
		</form>
		<form action="index.php?controller=friends&action=acceptRequest" method="POST">
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