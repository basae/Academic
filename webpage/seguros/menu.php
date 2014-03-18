<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		<li class="normal"><a href="contenido/agregarsocio.php" target="contenido" " >Crear Cliente Nuevo</a></li>
		<li class="normal"><a href="contenido/versocios.php" "  target="contenido">Ver Registro de Clientes</a></li><br />
		<li class="normal"><a href="contenido/logout.php" " >Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Unidades": ?>
<h2 align="center"><?php echo $sele ?></h2>	
		<ul>
		<li class="normal"><a href="contenido/agreunidad.php" target="contenido" " >Agregar Nueva Unidad</a></li>
		<li class="normal"><a href="contenido/verunidades.php" "  target="contenido">Ver Unidades Registradas</a></li>
        <br />
		<li class="normal"><a href="contenido/logout.php" " >Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Polizas": ?>
		<h2 align="center"><?php echo $sele ?></h2>
        <ul>
		<li class="normal"><a href="contenido/crearpoliza.php" target="contenido" " >Ingresar Poliza</a></li>
		<li class="normal"><a href="contenido/verpolizas.php" target="contenido" " >Ver Polizas Ingresadas</a></li>
        <li class="normal"><a href="contenido/porcaducar.php" target="contenido" " >Ver Polizas por Caducar</a></li>
        <br />
		<li class="normal"><a href="contenido/logout.php" " >Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Inicio": ?>
		<p>
        	Gracias por Iniciar session, se han habilitado los recursos segun tus privilegios de usuario.
        </p>
        <ul>
        	<li class="normal"><a href="contenido/logout.php" " >Cerrar Sesión</a></li>
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
		<li class="normal"><a href="contenido/verpolizas.php" target="contenido" " >Ver Polizas Ingresadas</a></li>
        
        <br />
		<li class="normal"><a href="contenido/logout.php" " >Cerrar Sesión</a></li>
        </ul>
<?php break; ?>

<?php case "Inicio": ?>
		<p>
        	Gracias por Iniciar session, se han habilitado los recursos segun tus privilegios de usuario.
        </p>
        <ul>
        	<li class="normal"><a href="contenido/logout.php" " >Cerrar Sesión</a></li>
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
<li class="normal"><a href="contenido/login1.html" target="contenido" " >Iniciar Sesión</a></li>
</ul>

<?php }
}?>

</div>
</body>
</html>