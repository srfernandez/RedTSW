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
		<input type="text" name= "friend" placeholder="Buscar Amigos" />
		<input type="submit" value="Buscar"/>
		</form>
	
<div>
	<h1>Solicitudes</h1>
</div>	
<?php foreach ($request as $solicitud): ?>
		<h2><?=$solicitud->getUsername()?></h2>
		<form action="index.php?controller=friends&action=rejectRequest" method="POST">
		<input type="submit" value="Rechazar solicitud"/>
		</form>
		<form action="index.php?controller=friends&action=acceptRequest" method="POST">
		<input type="submit" value="Aceptar solicitud"/>
		</form>
<?php endforeach; ?>
<div>
	<h1>Friends</h1>
</div>	
<?php 
			foreach ($friends as $friend): ?>
			<h2><?=$friend->getUsername()?></h2>
			
<?php endforeach; ?>