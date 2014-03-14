<!doctype html>
<html
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script language="javascript" src="sonidos.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="stylemenu.css" />
<?php session_start();
$sele=""; 
if(isset($_GET['id'])){
	$sele=$_GET['id'];
}

?>
</head>
<body>
<div id="menu">
<?php
if((isset($_SESSION['user']))&&($_SESSION['user']=="master")){ ?>

<?php
switch($sele){ ?>
<?php case "Clientes": ?>
    	<h2 align="center"><?php echo $sele ?></h2>
		<ul>	
		<li class="normal"><a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" id="agregarsocio">Crear Cliente Nuevo</a></li>
		<li class="normal"><a href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()"  id="versocios">Ver Registro de Clientes</a></li><br />
		<li class="normal"><a href="contenido/logout.php" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Unidades": ?>
<h2 align="center"><?php echo $sele ?></h2>	
		<ul>
		<li class="normal"><a id="agreunidad" href="#" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Agregar Nueva Unidad</a></li>
		<li class="normal"><a href="#" id="verunidades" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()" target="contenido">Ver Unidades Registradas</a></li>
        <br />
		<li class="normal"><a href="contenido/logout.php" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Polizas": ?>
		<h2 align="center"><?php echo $sele ?></h2>
        <ul>
		<li class="normal"><a href="#" id="crearpoliza" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Ingresar Poliza</a></li>
		<li class="normal"><a href="#" id="verpolizas" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Ver Polizas Ingresadas</a></li>
        <li class="normal"><a href="#" id="porcaducar" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Ver Polizas por Caducar</a></li>
        <br />
		<li class="normal"><a href="contenido/logout.php" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Inicio": ?>
		<p>
        	Gracias por Iniciar session, se han habilitado los recursos segun tus privilegios de usuario.
        </p>
        <ul>
        	<li class="normal"><a href="contenido/logout.php" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php } ?>

<?php 
}
else{ 
if(isset($_SESSION['user'])){ ?>
	<?php
switch($sele){ ?>
<?php case "Polizas": ?>
		<h2 align="center"><?php echo $sele ?></h2>
        <ul>
		<li class="normal"><a href="#" id="verpolizas" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Ver Polizas Ingresadas</a></li>
        
        <br />
		<li class="normal"><a href="contenido/logout.php" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Inicio": ?>
		<p>
        	Gracias por Iniciar session, se han habilitado los recursos segun tus privilegios de usuario.
        </p>
        <ul>
        	<li class="normal"><a href="contenido/logout.php" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php }
}
else{
?>
<p>
	Por favor inicie sesión.
</p>
<ul>
<li class="normal"><a href="contenido/login1.html" target="contenido" onmouseover="mouseoversound.playclip()" onclick="clicksound.playclip()">Iniciar Sesión</a></li>
</ul>

<?php }
}?>

</div>
</body>
</html>