<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="images/CoolWater.css" type="text/css" />
<?php session_start(); ?>
<title>Soc. Coop.</title>
	
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
	<div id="header">
    <h1 id="logo-text"> <a href="index.php">Sociedad Cooperativa de Autotransporte<br /> del Mpio Cd Y Pto de Coatzacoalcos, Ver, S.C.L.</a>
    </h1>
  <p id="slogan"> Av. Principal No. 100 Col. Transportistas<br/>Tel. 921 21 83162<br/>Correos: soccoop_sistemabea@hotmail.com,&nbsp;    soccoop_accidentes@hotmail.com </p>		
			
		<div id="header-links">
		
		</div>		
						
	</div>
		
	<!-- navigation -->	
	<div  id="menu">
	  <ul>
			<li ><a href="index.php">Inicio</a></li>
            <li id="current"><a href="sociosm.php">Clientes</a></li>
            <li><a href="unidadesm.php">Unidades</a></li>
            <li><a href="polizasm.php">Polizas</a></li>
		</ul>
	</div>					
			
	<!-- content-wrap starts here -->
  <div id="content-wrap">
		
		<div id="main">				
			<h2>Clientes</h2>
            <p>
            <img src="imagenes/socios.jpg" width="100%" />
            </p>
											
		
		</div>
		
	
	<div id="sidebar">
    <?php
	if( (isset($_SESSION['user']))&&($_SESSION['user']=='master')){ ?>
     
    <ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
    <h2>Clientes</h2>
    	<ul class="sidemenu">
        	<li><a href="agregasocio.php">Agregar Nuevo Cliente</a></li>
            <li><a href="versocios.php">Ver Clientes Registrados</a></li>
        </ul>
   
      <?php } ?>
	 
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
