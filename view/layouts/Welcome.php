<?php 
 // file: view/layouts/welcome.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 
?><!DOCTYPE html>
<html>
  <head>
    <title><?= $view->getVariable("title", "no title") ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
  </head>
  <body>
	<div id="container">
    <div id="encabezado">
	<a href="index.php?controller=language&amp;action=change&amp;lang=es"><?=i18n("Espanol")?></a>
			<a href="index.php?controller=language&amp;action=change&amp;lang=en"><?=i18n("Ingles")?></a>
    </div>
    <div id="formularios">
      <!-- flash message -->
      <div id="flash">
			<?= $view->popFlash() ?>
      </div>
      <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </div>
	</div>
  </body>
</html>