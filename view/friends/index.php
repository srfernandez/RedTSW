<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $friends = $view->getVariable("friends");
 $request = $view->getVariable("request");
  $search = $view->getVariable("search");
   $view->setVariable("title", "Friends");

?>

<div id="busqueda">
	<h1><?=i18n("Buscar amistades")?></h1>
	
		<form action="index.php?controller=friends&action=show" method="POST">
		<input type="text" name= "friend"/>
		<input type="submit" id= "search" name ="search" value="<?=i18n("Buscar")?>"/>
		</form>

<?php 
if($search == NULL): ?>
	<h3><?i18n("No se ha realizado ninguna busqueda")?></h3>
<?php else : ?>
<?php foreach ($search as $resultado): ?>
		<h2><?=$resultado->getUsername()?></h2>
		<form action="index.php?controller=friends&action=requestFriendship&id=<?=$resultado->getUsername()?>" method="POST">
		<input type="submit" id="solicitar" name="solicitar" value="<?=i18n("Solicitar amistad")?>"/>
		</form>
<?php endforeach; ?>
<?php endif; ?>
</div>
<div id="solicitudes">
	<h1><?=i18n("Solicitudes")?></h1>
	
<?php 
if($request == NULL): ?>
	<h3><?=i18n("No hay solicitudes pendientes")?></h3>
<?php else : ?>
<?php foreach ($request as $solicitud): ?>
	<h2><img src="css/Usuario-Icono.jpg"  alt="Usuario" height="50" width="50" id="usuario"> <?=$solicitud->getUsername()?></h2>
		<form action="index.php?controller=friends&action=rejectRequest&id=<?=$solicitud->getUsername()?>" method="POST">
		<input type="submit" id="reject" name="reject" value="<?=i18n("Rechazar")?>"/>
		</form>
		<form action="index.php?controller=friends&action=acceptRequest&id=<?=$solicitud->getUsername()?>" method="POST">
		<input type="submit" id="accept" name="accept" value="<?=i18n("Aceptar")?>"/>
		</form>
<?php endforeach; ?>
<?php endif; ?>
</div>
<div id="amigos">
	<h1><?=i18n("Amigos")?></h1>

<?php 
if($friends == NULL): ?>
	<h3><?=i18n("No tienes amigos")?></h3>
<?php else : ?>
<?php 
			foreach ($friends as $friend): ?>
			<div id="usuarios">
			<h2><a href="index.php?controller=posts&action=indexAuthor&id=<?=$friend->getUsername()?>"><img src="css/Usuario-Icono.jpg"  alt="Usuario" height="50" width="50" id="usuario"> <?=$friend->getUsername()?></a></h2>
			<form action="index.php?controller=friends&action=deleteFriend&id=<?=$friend->getUsername()?>" method="POST">
		<input type="submit" id="delete" name="delete" value="<?=i18n("Eliminar")?>"/>
		</form>
			</div>
			
<?php endforeach; ?>
<?php endif; ?>
</div>	