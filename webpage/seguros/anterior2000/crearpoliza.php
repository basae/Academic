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
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){ 
include("conexion.php");
$con=conex();
if(isset($_GET['archivo'])){$archivo=$_GET['archivo'];}else{$archivo="";}
if(isset($_GET['poliza'])){$poliza=$_GET['poliza'];}else{$poliza="";}
if((isset($_GET['unidad']))&&($_GET['unidad']!="")){$unidad=$_GET['unidad'];
$consulta=mysql_query("select socio.nombre,socio.ap,socio.am,unidad.uso from unidad inner join socio on socio.id_socio=unidad.id_socio where unidad.id=$unidad",$con)or die (mysql_error());
if($dato=mysql_fetch_array($consulta)){
	$socio=$dato['nombre']." ".$dato['ap'].$dato['am'];
	$uso=$dato['uso'];
}
else{
	$socio="";
	$uso="";	
}
;}else{$unidad="";$socio="";$uso="";}
if(isset($_GET['pago'])){$pago=$_GET['pago'];}else{$pago="";}
if(isset($_GET['cobertura'])){$cobertura=$_GET['cobertura'];}else{$cobertura="";}
if(isset($_GET['inicio'])){$inicio=$_GET['inicio'];}else{$inicio="dd/mm/aaaa";}
if(isset($_GET['vigencia'])){$vigencia=$_GET['vigencia'];}else{$vigencia="";}
if(isset($_GET['deducible'])){$deducible=$_GET['deducible'];}else{$deducible="";}
?>
	<h2 align="center">Ingreso de Poliza</h2>
	<form name="f1" method="post" action="guardapoliza.php" enctype="multipart/form-data">
        
        <p>
       	  <label>No. de Poliza:</label>
            <span id="sprytextfield1">
              <input type="text" name="poliza" id="poliza" value="<?php echo $poliza ?>"/>
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
              <label>Unidad:</label>
                <span id="spryselect1">
                  <select name="unidad" id="unidad" onchange="accion(this.value)">
                  	<option value="">Selecciona una Unidad</option>
                    <?php
						$consulta=mysql_query("select *from unidad");
						while($dato=mysql_fetch_array($consulta)){ ?>
                        <option value="<?php echo $dato['id'] ?>"><?php echo $dato['unidad'] ?></option>
                        <?php } ?>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span>
              	<label>Socio:</label>
                <input name="socio" type="text" id="socio" value="<?php echo $socio ?>" size="33" readonly/>

              	<label>Uso:</label>
                <span id="spryselect2">
                  <select name="uso" id="uso" disabled="disabled">
                  	  <option value=""></option>
                      <option value="Local">Local</option>
                      <option value="Foraneo">Foraneo</option>
                      <option value="Particular">Particular</option>
                      <option value="Publico">Publico</option>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span>

              	<label>Forma de Pago:</label>
                <span id="spryselect3">
                  <select name="pago" id="pago" onchange="desblo(this.id)">
                  	<option value=""></option>
                    <option value="12" >Anual</option>
                    <option value="6" >Semestral</option>
                    <option value="4" >Cuatrimestral</option>
                    <option value="3">Trimestral</option>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span>
                      	<label>Tipo de Cobertura</label>
                <span id="spryselect4">
                  <select name="cobertura" id="cobertura">
                  	<option value=""></option>
                    <option value="Amplia">Amplia</option>
                    <option value="Daños a Terceros">Daños a Terceros</option>
                    <option value="Responsabilidad Civil">Responsabilidad Civil</option>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span>
<label>Fecha de Inicio:</label>
                    <span id="sprytextfield2">
                    <input name="fecha_inicio" type="text" readonly="readonly" id="fecha_inicio" onblur="calculo(this.value)" value="<?php echo $inicio ?>" />
                    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
                    <label>Fecha de Vigencia:</label>
                    <input name="vige" type="text" id="vige" readonly value="<?php echo $vigencia ?>" />
                <label>Deducible:</label>
                    <span id="sprytextfield3">
                    <input type="text" name="deducible" id="deducible" value="<?php echo $deducible ?>" size="5" />
                    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span>
                    <label>Imagen:</label>
                    <input name="imagen" type="file" />
                   <input name="anterior" id="anterior" type="hidden" value="<?php echo $archivo ?>" />
               <br /><br />
                  <input name="guardar" class="button" type="submit" value="Guardar Poliza" onclick="borra()" /><input class="button" name="limpiar" type="reset" value="Limpiar Campos" onclick="location.href='crearpoliza.php'" />
               </p>   
    </form>

<div class="error">
	<?php if(isset($_GET['error'])){
		echo "Error<br/>*".$_GET['error'];	
	}
	?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");

function accion(id){
	var poliza=document.getElementById("poliza").value;
	var pago=document.getElementById("pago").value;
	var cobertura=document.getElementById("cobertura").value;
	var inicio=document.getElementById("fecha_inicio").value;
	var dedu=document.getElementById("deducible").value;
	var vigencia=document.getElementById("vige").value;
	var archi=document.getElementById("anterior").value;
location.href="crearpoliza.php?unidad="+id+"&poliza="+poliza+"&pago="+pago+"&cobertura="+cobertura+"&inicio="+inicio+"&vigencia="+vigencia+"&deducible="+dedu+"&archivo="+archi;
}
cargaCombos("<?php echo $unidad; ?>","unidad");
cargaCombos("<?php echo $uso; ?>","uso");
cargaCombos("<?php echo $cobertura; ?>","cobertura");
cargaCombos("<?php echo $pago; ?>","pago");
if(document.getElementById("fecha_inicio").value!="dd/mm/aaaa"){
	document.getElementById("fecha_inicio").readOnly=false;	
}
function cargaCombos(val,campo){
var valor2=val;
if(valor2!=""){
	var maxi=document.getElementById(campo);
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor2){
				maxi[i].selected=true;	
			}
	}
	}
}
function calculo(actual){
		var formato=actual.split("/");
		actual=formato[1]+"/"+formato[0]+"/"+formato[2];
		if(formato.length==3){
		var fecha=new Date(actual);
		fecha.setMonth(parseInt(fecha.getMonth())+ parseInt(document.getElementById("pago").value));
		var dia=(fecha.getUTCDate()<10)?"0"+fecha.getUTCDate():fecha.getUTCDate();
		var mes=((fecha.getUTCMonth()+1)<10)?"0"+(fecha.getUTCMonth()+1):(fecha.getUTCMonth()+1);
		var ano=fecha.getUTCFullYear();
		document.getElementById("vige").value=dia+"/"+mes+"/"+ano;
		}
}
function desblo(val){
	var valor=document.getElementById(val).value;
	if(valor!=""){
	document.getElementById("fecha_inicio").readOnly=false;
	if(document.getElementById("fecha_inicio").value!="dd/mm/aaaa"){
	calculo(document.getElementById("fecha_inicio").value);
	}
	}
	else{
		document.getElementById("fecha_inicio").readOnly=true;
		document.getElementById("fecha_inicio").value="dd/mm/aaaa";
		document.getElementById("vige").value="";
	}
}
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", hint:"dd/mm/aaaa", validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {maxChars:2});
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
    
     <h2>Polizas</h2>
    	<ul class="sidemenu">
        	<li><a href="crearpoliza.php">Ingresar Poliza</a></li>
            <li><a href="verpolizas.php">Ver Polizas</a></li>
            <li><a href="porcaducar.php">Polizas por Caducar</a></li>
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
