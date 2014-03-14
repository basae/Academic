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
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
	
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
		  session_start();
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
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
	$ide="";
	if(isset($_GET['unidad'])){$unidad=$_GET['unidad'];}else{$unidad="";};
	if(isset($_GET['marca'])){$marca=$_GET['marca'];}else{$marca="";};
	if(isset($_GET['modelo'])){$modelo=$_GET['modelo'];}else{$modelo="";};
	if(isset($_GET['placas_es'])){$placas_es=$_GET['placas_es'];}else{$placas_es="";};
	
	if(isset($_GET['placas_fe'])){$placas_fe=$_GET['placas_fe'];}else{$placas_fe="";};
	if(isset($_GET['motor'])){$motor=$_GET['motor'];}else{$motor="";};
	if(isset($_GET['serie'])){$serie=$_GET['serie'];}else{$serie="";};
	if(isset($_GET['uso'])){$uso=$_GET['uso'];}else{$uso="";};
	if(isset($_GET['socio'])){$socio=$_GET['socio'];}else{$socio="";};
	if(isset($_GET['id'])){
		$consulta=mysql_query("select *from unidad where id=".$_GET['id']."",$con);
		if($dato=mysql_fetch_array($consulta)){
			$ide=$dato['id'];
			$unidad=$dato['unidad'];
			$marca=$dato['marca'];
			$modelo=$dato['modelo'];
			$placas_es=$dato['placas_estatales'];
			$placas_fe=$dato['placas_federales'];
			$motor=$dato['no_motor'];
			$serie=$dato['no_serie'];
			$uso=$dato['uso'];
			$socio=$dato['id_socio'];
		}
	}
	if(isset($_GET['eliminar'])){
		$consulta=mysql_query("delete from unidad where id=".$_GET['eliminar']."",$con);
		header("location:verunidades.php");
	}
	
	$consulta=mysql_query("select max(id) from unidad");
	if($dato=mysql_fetch_array($consulta)){
	$ide=$dato[0]+1;
	}
	?>
    <?php if(isset($_GET['error'])){ ?>
		<blockquote>
		<?php echo "<p>Error<br/>*".$_GET['error']."</p>";?>
        </blockquote>
	<?php }	?>
       <h2 align="center">Ingreso de Unidades</h2>
	<form name="alta" method="post" action="guardaunidad.php">
    <p>
  	  <input type="hidden" name="ide" value="<?php echo $ide ?>" readonly="readonly"/>

    <label>Unidad:</label>
    <span id="sprytextfield1">
    <input type="text" name="unidad" id="unidad" value="<?php echo $unidad ?>" size="5" />
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
    <label>Socio:</label>
    <span id="spryselect2">
      <select name="socio" id="socio">
      <?php
	  	$consulta=mysql_query("select id_socio,nombre,ap,am from socio",$con); ?>
        <option value=""></option>
	<?php while($dato=mysql_fetch_array($consulta)){  ?>
      <option value="<?php echo $dato[0] ?>"><?php echo $dato[1]." ".$dato[2]." ".$dato[3] ?></option>
      <?php } ?>
      </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span>
    <label>Uso:</label>
    <span id="spryselect1">
      <select name="uso" id="uso">
      <option value=""></option>
      <option value="Local">Local</option>
      <option value="Foraneo">Foraneo</option>
      <option value="Particular">Particular</option>
      <option value="Publico">Publico</option>
      </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span>								<label>Marca:</label>
	<span id="sprytextfield2">
      <input type="text" name="marca" id="marca" value="<?php echo $marca?>" onblur="tranforma(this.id)" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
    <label>Modelo:</label>
    <span id="sprytextfield3">
      <input type="text" name="modelo" id="modelo" value="<?php echo $modelo ?>" onblur="tranforma(this.id)" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>	<label>Placas Estatal:</label>
    <span id="sprytextfield4">
      <input type="text" name="placas_es" id="placas" value="<?php echo $placas_es ?>" onblur="tranforma(this.id)" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><label>Placas Federales:</label>
    <span id="sprytextfield5">
      <input type="text" name="placas_fe" id="placas_fe" value="<?php echo $placas_fe ?>" onblur="tranforma(this.id)" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><label>No. Motor:</label>
    <span id="sprytextfield6">
      <input type="text" name="motor" id="motor" value="<?php echo $motor ?>" onblur="tranforma(this.id)"/>
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span><label>No. Serie:</label>
    <span id="sprytextfield7">
      <input type="text" name="serie" id="serie" value="<?php echo $serie ?>" onblur="tranforma(this.id)" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
      <br /><br />
<input class="button" name="enviar" type="submit" value="Guardar" /><input class="button" name="limpiar" type="reset" value="Limpiar" onclick="accion()" />
</p>
      </form>



<script type="text/javascript">
	var valor="<?php echo $uso ?>";
	var valor2="<?php echo $socio ?>";
	if(valor!=""){
	var maxi=document.getElementById('socio');
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor2){
				maxi[i].selected=true;	
			}
	}
	}
	if(valor2!=""){
	var maxi=document.getElementById('uso');
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor){
				maxi[i].selected=true;	
			}
	}
	}
	function accion(){
		location.href="agreunidad.php";	
	}
	function tranforma(valor){
		document.getElementById(valor).value=document.getElementById(valor).value.toUpperCase();
	}
</script>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});

var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});


var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
</script>
<?php }
else{
	echo "no tienes permisos suficientes para ingresar en esta sección";
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
