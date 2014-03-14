<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="avisos.css" type="text/css" />
<link rel="stylesheet" href="images/CoolWater.css" type="text/css" />

<title>Soc. Coop.</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<?php session_start() ?>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<?php
include("conexion.php");
$con=conex();
if(isset($_GET['busqueda'])){
	$sentencia=stripcslashes($_GET['busqueda']);
}
else{$sentencia="";}
if(isset($_GET['var'])){$vari=$_GET['var'];}else{$vari="";}
if(isset($_GET['sele'])){$sele=$_GET['sele'];}else{$sele="";}
if(isset($_GET['id'])){
$val=$_GET['id'];
$consulta=mysql_query("select id_poliza,unidad,forma_pago,cobertura,date_format(fecha_inicio,'%d/%m/%Y')as f1,date_format(poliza.fecha_vigencia,'%d/%m/%Y') as f2,deducible,foto from poliza where id_poliza='".$val."'",$con)or die(mysql_error());
if($dato=mysql_fetch_array($consulta)){
$poliza=$dato['id_poliza'];
$unidad=$dato['unidad'];
$pago=$dato['forma_pago'];
$cobertura=$dato['cobertura'];
$fecha_inicio=$dato['f1'];
$vigencia=$dato['f2'];
$deducible=$dato['deducible'];
$nombre=$dato['foto'];
$retorno="crearpoliza.php?poliza=$poliza&unidad=$unidad&pago=$pago&cobertura=$cobertura&inicio=$fecha_inicio&vigencia=$vigencia&deducible=$deducible&archivo=$nombre";	
echo "<script>location.href='".$retorno."';</script>";
}
}
?>
<script language="javascript">
	var sentencia="";
</script>
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
			<li id="current"><a href="index.php">Inicio</a></li>
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
        <h2 align="center">Polizas Registradas</h2>
        <p>
    Busqueda:
    <input name="cadena" type="text" id="cadena"  value="<?php echo $vari ?>"/>
    <select name="variable" id="variable">
    	<option value="1">x Unidad</option>
        <option value="2">x No de Poliza</option>
        <option value="3">x Propietario</option>
    </select>
    <input class="button" name="buscar1" type="button" value="Buscar" onclick="redir()" /></p>
    <br />
<table>
<?php
if(isset($_GET['eliminar'])){
	$consulta=mysql_query("select foto from poliza where id_poliza=".$_GET['eliminar']."",$con);
	if($dato=mysql_fetch_array($consulta)){
	unlink("polizas/".$dato[0])or die(mysql_error());
	}
	mysql_query("delete from poliza where id_poliza=".$_GET['eliminar']);
	echo "<script>alert('El registro ha sido Eliminado');location.href='verpolizas.php';</script>";	
}
$consulta=mysql_query("select poliza.id_poliza,unidad.unidad,poliza.cobertura,poliza.forma_pago,poliza.fecha_vigencia,poliza.deducible,poliza.foto,socio.nombre,socio.ap,socio.am from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on socio.id_socio=unidad.id_socio ".$sentencia." order by fecha_vigencia",$con)or die(mysql_error());
if((isset($_SESSION['user']))&&($_SESSION['user']=="user") ){ ?>
<tr>
	<th></th>
    <th>No. Poliza</th>
    <th>Uni.</th>
    <th>Propietari.</th>
    <th>Vigencia</th>
	<th>Dedu.</th>
    <th>Imagen</th>
</tr>
<?php
while($dato=mysql_fetch_array($consulta)){?>
<tr class="normal">
	<td><a href="verdetalles.php?id=<?php echo $dato[0] ?>">Ver Detalles</a></td>
    <td><?php echo $dato[0] ?></td>
    <td><?php echo $dato[1] ?></td>
    <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
        <?php
$fech=explode("-",$dato[4]);
$fecha1=gregoriantojd ($fech[1],$fech[2],$fech[0]); 
$fecha2=gregoriantojd (date("n"), date("j"), date("Y")); 
$resultado_en_dias=$fecha1-$fecha2; 

if(($resultado_en_dias>0)&&($resultado_en_dias>60)){
	echo '<td>'.$dato[4].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias>30)&&($resultado_en_dias<61)){
	echo '<td class="fase2">'.$dato[4].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias<31)){
	echo '<td class="fase3">'.$dato[4].'</td>';
}
if($resultado_en_dias<=0){
	echo '<td class="fase4">'.$dato[4].'</td>';
}
	?>
    <td><?php echo $dato[5]." %" ?></td>
    <td><a href="polizas/<?php echo $dato[6] ?>" target="_new">Ver..</a></td>
</tr>
<?php }} ?>

<?php
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){ ?>
<tr>
	<th></th>
    <th>No. Poliza</th>
    <th>Uni.</th>
    <th>Propietario</th>
    <th>Vigencia</th>
	<th>Dedu.</th>
    <th>Imagen</th>
</tr>
<?php 
while($dato=mysql_fetch_array($consulta)){?>
<tr class="normal">
	<td>
    	<a href="verpolizas.php?id=<?php echo $dato[0] ?>">Editar</a>|
<a href="verpolizas.php?eliminar=<?php echo $dato[0] ?>" onclick="return confirm('¿Estas Seguro de Eliminar el Registro?');">Eliminar</a>
    </td>
    <td><?php echo $dato[0] ?></td>
    <td><?php echo $dato[1] ?></td>
    <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
    <?php
$fech=explode("-",$dato[4]);
$fecha1=gregoriantojd ($fech[1],$fech[2],$fech[0]); 
$fecha2=gregoriantojd (date("n"), date("j"), date("Y")); 
$resultado_en_dias=$fecha1-$fecha2; 

if(($resultado_en_dias>0)&&($resultado_en_dias>60)){
	echo '<td>'.$dato[4].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias>30)&&($resultado_en_dias<61)){
	echo '<td class="fase2">'.$dato[4].'</td>';
}
if(($resultado_en_dias>0)&&($resultado_en_dias<31)){
	echo '<td class="fase3">'.$dato[4].'</td>';
}
if($resultado_en_dias<=0){
	echo '<td class="fase4">'.$dato[4].'</td>';
}
	?>
    
    <td><?php echo $dato[5]." %" ?></td>
    <td><a href="polizas/<?php echo $dato[6] ?>" target="_new">Ver..</a></td>
</tr>
<?php }} ?>
</table>
<script language="javascript">
var sentencia="";
function redir(){
	switch(document.getElementById("variable").value){
	case "1":
	sentencia="where unidad.unidad like '";
	break;
	case "2":
	sentencia="where poliza.id_poliza like '";
	break;
	case "3":
	sentencia="where socio.nombre like '"+document.getElementById("cadena").value+"%' or socio.ap like '"+document.getElementById("cadena").value+"%' or socio.am like '";
	break;
}
	location.href="verpolizas.php?busqueda="+sentencia+document.getElementById("cadena").value+"%'&var="+document.getElementById("cadena").value+"&sele="+document.getElementById("variable").value;
}
cargaCombos("<?php echo $sele ?>","variable");

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
</script>
<?php
function verpago($val){
	switch($val){
		case 12:return "Anual";
		case 6:return "Semestral";
		case 4:return "Cuatrimestral";
		case 3:return "trimestral";	
	}
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
      <?php } ?>
      <?php
       if( (isset($_SESSION['user']))&&($_SESSION['user']=='user')){
	  ?>
      <h2>Session</h2>
    <ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
        </ul>
      <h2>Polizas</h2>
    	<ul class="sidemenu">
            <li><a href="verpolizas.php">Ver Polizas</a></li>           
        </ul>
      
      <?php } ?>
      <h2 align="center">Tabla de Caducidades</h2>
       <table>
		<tr>
        	<th>Color</th><th>Descripción</th>
        </tr>
    	<tr>
        	<td></td><td>Más de 60 Días para caducar </td>
         </tr>
    	<tr>
        	<td class="fase2"></td><td>Más de 30 Días para caducar</td>
         </tr>
         <tr>
        	<td class="fase3"></td><td>Menos de 31 Días para Caducar</td>
         </tr>
         <tr>
        	<td class="fase4"></td><td>Caducado</td>
         </tr>
    </table>
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
