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
            <li id="current"><a href="sociosm.php">Clientes</a></li>
            <li><a href="unidadesm.php">Unidades</a></li>
            <li><a href="polizasm.php">Polizas</a></li>
		</ul>
        <?php } 
        if( (isset($_SESSION['user']))&&($_SESSION['user']=='user')){
	  ?>
       <ul>
			<li id="current"><a href="index.php">
            <li><a href="polizasm.php">Polizas</li></a>
		</ul>
      
      <?php } ?>
	</div>					
			
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		

		<div id="main">				
				<?php
include("conexion.php");
$con=conex();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
	if(isset($_GET['nombre'])){$nombre=$_GET['nombre'];}else{$nombre="";};
	if(isset($_GET['ap'])){$ap=$_GET['ap'];}else{$ap="";};
	if(isset($_GET['am'])){$am=$_GET['am'];}else{$am="";};
	if(isset($_GET['direccion'])){$dir=$_GET['direccion'];}else{$dir="";};
	if(isset($_GET['telefono'])){$telefono=$_GET['telefono'];}else{$telefono="";};
	if(isset($_GET['email'])){$email=$_GET['email'];}else{$email="";};
	$consulta=mysql_query("select max(id_socio) from socio");
	if($dato=mysql_fetch_array($consulta)){
	$ide=$dato[0]+1;
	}
	if(isset($_GET['eliminar'])){
		$consulta=mysql_query("delete from socio where id_socio=".$_GET['eliminar']."",$con)or die(header("location:versocios.php?error=no se puede borrar este registro por que tiene una poliza asignada"));
		header("location:versocios.php");
				
	}
	if(isset($_GET['id'])){
		$consulta=mysql_query("select *from socio where id_socio=".$_GET['id']."",$con)or die(mysql_error());	
		if($dato=mysql_fetch_array($consulta)){
			$ide=$dato['id_socio'];
			$nombre=$dato['nombre'];
			$ap=$dato['ap'];
			$am=$dato['am'];
			$dir=$dato['direccion'];
			$telefono=$dato['telefono'];
			$email=$dato['email'];
			
		}
	}
?>
<?php if(isset($_GET['error'])){ ?>
		<blockquote>
		<?php echo "<p>Error<br/>*".$_GET['error']."</p>";?>
        </blockquote>
	<?php }	?>
<h2 align="center">Agregar Nuevo Cliente</h2>
<form action="guardasocio.php" method="post" name="alta_socio">
<p>
<input type="hidden" name="ide" value="<?php echo $ide ?>" readonly="readonly"/>

    <label>Nombre:</label>
	<span id="sprytextfield1">
      <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" onblur="tranforma(this.id)"/>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
    <label>Apellido Paterno:</label>
    <span id="sprytextfield2">
      <input type="text" name="ap" id="ap" value="<?php echo $ap ?>" onblur="tranforma(this.id)"/>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    <label>Apellido Materno:</label>
    <span id="sprytextfield3">
      <input type="text" name="am" id="am" value="<?php echo $am ?>" onblur="tranforma(this.id)"/>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>    <label>Dirección:</label>
    <span id="sprytextarea1">
      <textarea name="direccion" id="direccion" cols="20" rows="5" onblur="onblur="tranforma(this.id)""><?php echo $dir ?></textarea><span class="textareaRequiredMsg">Se necesita un valor.</span></span></td>
	<label>Telefono:</label>
    <span id="sprytextfield4">
    <input name="telefono" type="text" id="telefono" value="<?php echo $telefono ?>" maxlength="10"/>
    <span class="textfieldInvalidFormatMsg">Formato no válido.</span><span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    <label>Email:</label>
    <span id="sprytextfield5">
      <input type="text" name="email" id="email" value="<?php echo $email ?>"/>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
 <br /><br />
    <input class="button" type="submit" name="enviar" id="enviar" value="Guardar" /><input name="limpiar" class="button" type="reset" value="Limpiar" onclick="accion()"/>
</p>
</form>


	
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {validateOn:["blur"]});
function accion(){
	location.href="agregasocio.php";
}
function tranforma(valor){
		document.getElementById(valor).value=document.getElementById(valor).value.toUpperCase();
	}
</script>
<?php } ?>

		</div>
		
			
		<div id="sidebar">
			
						
			<div id="sidebar">
    <?php
	if( (isset($_SESSION['user']))&&($_SESSION['user']=='master')){ ?>
    <ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
    <h2>Clientes</h2>
    	<ul class="sidemenu">
        	<li id="current"><a href="agregasocio.php">Agregar Nuevo Cliente</a></li>
            <li><a href="versocios.php">Ver Clientes Registrados</a></li
        ></ul>
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
