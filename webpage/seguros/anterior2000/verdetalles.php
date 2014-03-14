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
				
		<h1 id="logo-text"> <a href="index.php">Sociedad Cooperativa de Autotransporte<br /> del Mpio Cd Y Pto de Coatzacoalcos, Ver, S.C.L.</a>
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
            <li><a href="unidadesm.php">Unidades</a></li>
            <li id="current"><a href="polizasm.php">Polizas</a></li>
		</ul>
        <?php } 
        if( (isset($_SESSION['user']))&&($_SESSION['user']=='user')){
	  ?>
       <ul>
			<li ><a href="index.php">Inicio</a></li>
            <li id="current"><a href="polizasm.php">Polizas</a></li>
		</ul>
      
      <?php } ?>
	</div>					
			
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		

		<div id="main">
	<?php
if((isset($_SESSION['user']))&&($_SESSION['user']=="user") ){
	$poliza="";
	$cobertura="";
	$forma_pago="";
	$fecha_inicio="";
	$fecha_vigencia="";
	$deducible=""; 
if(isset($_GET['id'])){
	include("conexion.php");
	$con=conex();
	$consulta=mysql_query("select poliza.id_poliza,poliza.cobertura,poliza.forma_pago,date_format(poliza.fecha_inicio,'%d/%m/%Y')as f1,date_format(poliza.fecha_vigencia,'%d/%m/%Y')as f2,poliza.deducible,poliza.foto,unidad.unidad,unidad.marca,unidad.modelo,unidad.placas_estatales,unidad.placas_federales,unidad.no_motor,unidad.no_serie,unidad.uso,socio.nombre,socio.ap,socio.am,socio.direccion,socio.telefono,socio.email from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on unidad.id_socio=socio.id_socio where poliza.id_poliza='".$_GET['id']."'",$con)or die(mysql_error());
	if($dato=mysql_fetch_array($consulta)){
		//campos de poliza
		$poliza=$dato['id_poliza'];
		$cobertura=$dato['cobertura'];
		$forma_pago=verpago($dato['forma_pago']);
		$fecha_inicio=$dato['f1'];
		$fecha_vigencia=$dato['f2'];
		$deducible=$dato['deducible'];
		$foto=$dato['foto'];
		
		//campos para unidad
		$unidad=$dato['unidad'];
		$marca=$dato['marca'];
		$modelo=$dato['modelo'];
		$placas_es=$dato['placas_estatales'];
		$placas_fe=$dato['placas_federales'];
		$no_motor=$dato['no_motor'];
		$no_serie=$dato['no_serie'];
		$uso=$dato['uso'];
		//campos de tabla socio
		$propietario=$dato['nombre']." ".$dato['ap']." ".$dato['am'];
		$direccion=$dato['direccion'];
		$telefono=$dato['telefono'];
		$email=$dato['email'];
?>

<h2 align="left">Datos de Poliza</h2>
<table>
<tr>
	<th width="23%">No. de Poliza</th><td><?php echo $poliza ?></td>
    <td rowspan="7" width="38%"><a href="polizas/<?php echo $foto ?>" target="_NEW"><img src="polizas/<?php echo $foto ?>" width="100%" align="left" /></a></td>
</tr>
<tr>
	<th>Cobertura:</th><td><?php echo $cobertura ?></td>
</tr>
<tr>
	<th>Forma de Pago:</th><td><?php echo $forma_pago ?></td>
</tr>
<tr>
	<th>Fecha de Inicio:</th><td><?php echo $fecha_inicio ?></td>
</tr>
<tr>
	<th>Fecha de Vigencia:</th><td><?php echo $fecha_vigencia ?></td>
</tr>
<tr>
	<th>Deducible:</th><td><?php echo $deducible ?></td>
</tr>
</table>
	<h2 align="left">Datos de la Unidad</h2>
<table style="float:left;">
    <tr>
    	<th nowrap="nowrap" width="25%">Unidad:</th><td nowrap="nowrap"><?php echo $unidad ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Marca:</th><td nowrap="nowrap"><?php echo $marca ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Modelo:</th><td nowrap="nowrap"><?php echo $modelo ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Placas Estatales:</th><td nowrap="nowrap"><?php echo $placas_es ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Placas Federales:</th><td nowrap="nowrap"><?php echo $placas_fe ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">No. Motor:</th><td nowrap="nowrap"><?php echo $no_motor ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">No. Serie:</th><td nowrap="nowrap"><?php echo $no_serie ?></td>
    </tr>
    <tr>
    	<th nowrap="nowrap">Uso:</th><td nowrap="nowrap"><?php echo $uso ?></td>
    </tr>
</table>
	<h2 align="left">Datos del Propietario.</h2>
<table>
	<tr><th nowrap="nowrap">Propietario:</th><td><?php echo $propietario ?></td></tr>
    <tr><th nowrap="nowrap">Dirección:</th><td><?php echo $direccion ?></td></tr>
    <tr><th nowrap="nowrap">Telefono:</th><td><?php echo $telefono ?></td></tr>
    <tr><th nowrap="nowrap">Email:</th><td><?php echo $email ?></td></tr>
</table>
<?php
}
}}
function verpago($val){
	switch($val){
		case 12:return "Anual";
		case 6:return "Semestral";
		case 4:return "Cuatrimestral";
		case 3:return "trimestral";		}
}
?>

		</div>
		
			
		<div id="sidebar">
			
						
			<div id="sidebar">
    <?php
	if( (isset($_SESSION['user']))&&($_SESSION['user']=='master')){ ?>
        <ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
    
    
     <h2>Polizas</h2>
    	<ul class="sidemenu">
        	<li><a href="crearpoliza.php">Ingresar Poliza</a></li>
            <li><a href="verpolizas.php">Ver Polizas</a></li>
            <li><a href="porcaducar.php">Polizas por Caducar</a></li>
        </ul>
      <?php } 
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
