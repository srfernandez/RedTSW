<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css" ></link>
		<meta charset="utf-8">
	</head>
	
	<body>
	
		<div id="container">
		<div id="encabezado">
			<header>Logo</header>
			<ul id="settings">
			<li id="apagar">
				<a href="#"></a>
			</li>
				
			<li id="herramientas">
				<a href="#"></a>
			</li>
			</ol>
		</div>
		<main>
		
			<div id="right_column">
				<div id="perfil">
					<input type= "button" name="perfil" OnClick="#">
					<a href="#">Nombre Usuario</a>
				</div>
				<div id="buscador">
						<form action = "#" method = "get">					
						<input type="text" name= "buscador" value="Buscar amigos..."/>
						<input type = "submit" value="Buscar" onClick='#'/>
						</form>
				</div>
				<ul id="sidebar">
					<li id="enlaceMuro">
					<a href="#" class="selected">MURO</a>
					</li>
					<li id="enlacePublicaciones">
					<a href="#" >PUBLICACIONES</a>
					</li>
					<li id="enlaceFavoritos">
					<a href="#">FAVORITOS</a>
					</li>
					<li id="enlaceMensajes">
					<a href="#">MENSAJES</a>
					</li>
					<li id="enlaceAmigos">
					<a href="#">AMIGOS</a>
					</li>
				</ol>
			</div>
			
			
			<div id="left_column">
				<div id="nueva">
					<form action = "#" method="post">
					<p>Nueva Publicacion
					
					<input type="submit" value="Enviar"></p>
					<textarea rows="6" cols="200">
					</textarea>
					</form>
					
				</div>
				<ul id="publicaciones">
					<li id="post" class="template">
						<div id="header"> 
							<input type= "button" name="perfil" OnClick="#">
							<a href="#">Usuario</a> 
						</div>
						<div id="cuerpo"> <p>Post de Ejemplo</p></div>
						<ul id="footer">
							<li><span>Contador</span></li>
							<li><a href="#"></a> </li>
						</ol>
					</li>
					
					
					<li id="Mas">
						<input type="submit" value="Leer Mas">
					</li>
				</ol>
			</div>
		</main>
	</div>
	</body>
</html>