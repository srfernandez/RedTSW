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
	<?php
      include(__DIR__."/language_select_element.php");
      ?>
    </div>
    <main>
      <!-- flash message -->
      <div id="flash">
			<?= $view->popFlash() ?>
      </div>
      <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
    </main>
	</div>
  </body>
</html>