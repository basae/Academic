<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="images/CoolWater.css" type="text/css" />

<title>Soc. Coop.</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<?php session_start() ?>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
	
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
	<div id="header">			
				
		<<h1 id="logo-text"> <a href="index.php">Sociedad Cooperativa de Autotransporte<br /> del Mpio Cd Y Pto de Coatzacoalcos, Ver, S.C.L.</a>
    </h1>
		<p id="slogan"> Av. Principal No. 100 Col. Transportistas<br/>Tel. 921 21 83162<br/>Correos: soccoop_sistemabea@hotmail.com,&nbsp;    soccoop_accidentes@hotmail.com </p>		
			
		<div id="header-links">
	
	  </div>		
						
	</div>
		
	<!-- navigation -->	
	<div  id="menu">
		  <?php 
	  if( (isset($_SESSION['user']))&&($_SESSION['user']=='master')){
	  ?>
	  <ul>
			<li ><a href="index.php">Inicio</a></li>
            <li><a href="sociosm.php">Socios</a></li>
            <li id="current"><a href="unidadesm.php">Unidades</a></li>
            <li><a href="polizasm.php">Polizas</a></li>
		</ul>
        <?php } 
        if( (isset($_SESSION['user']))&&($_SESSION['user']=='user')){
	  ?>
       <ul>
			<li id="current"><a href="index.php">
            <li><a href="polizasm.php">Polizas</a></li>
		</ul>
      
      <?php } ?>
	</div>					
			
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		

		<div id="main">
	<?php 
	include("conexion.php");
	$con=conex();
	$consulta=mysql_query("select unidad.unidad,unidad.id,unidad.marca,unidad.modelo,unidad.no_serie,unidad.no_motor,unidad.placas_federales,unidad.placas_estatales,socio.id_socio,socio.nombre,socio.ap,socio.am from unidad inner join socio on unidad.id_socio=socio.id_socio",$con); ?>
      <h2 align="center">Unidades Registradas</h2>
	<table>
    	<tr><th ></th><th>Unidad</th><th>Marca</th><th>Modelo</th><th>Nombre</th></tr>
        <?php while($dato=mysql_fetch_array($consulta)){ ?>
        <tr class="normal">
        	<td nowrap="nowrap"><a href="agreunidad.php?id=<?php echo $dato['id'] ?>">Editar</a>&nbsp;|&nbsp;<a href="agreunidad.php?eliminar=<?php echo $dato['id'] ?>" onclick="return confirm('¿Estas Seguro de Eliminar el Registro?')">Eliminar</a></td>
     	<td><?php echo $dato['unidad'] ?></td>
        <td><?php echo $dato['marca'] ?></td>
        <td><?php echo $dato['modelo'] ?></td>

        <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
        </tr>
        <?php } ?>
    </table>

		</div>
		
			
		<div id="sidebar">
			
						
			<div id="sidebar">
    <?php
	if( (isset($_SESSION['user']))&&($_SESSION['user']=='master')){ ?>
    <ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
    
    <h2>Unidades</h2>
    	<ul class="sidemenu">
        	<li><a href="agreunidad.php">Agregar Nueva Unidad</a></li>
            <li><a href="verunidades.php">Ver Unidades Registradas</a></li>
        </ul>
    
      <?php } ?>
      <?php
       if( (isset($_SESSION['user']))&&($_SESSION['user']=='user')){
	  ?>
    <ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
      <h2>Polizas</h2>
    	<ul class="sidemenu">
            <li><a href="verpolizas.php">Ver Polizas</a></li>           
        </ul>
      
      <?php } ?>
 				</div>
					
		</div>
				
	<!-- content-wrap ends here -->	
	</div>
					
	<!--footer starts here-->
	<div id="footer">
			
		<p>
		&copy; 2012 <strong>Dise&ntilde;o y Creación de Sistemas informáticos y páginas web contacto soccoop_sistemabea@hotmail.com
   	</p>
			
	</div>	

<!-- wrap ends here -->
</div>

</body>
</html>
