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
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
include("conexion.php");
$con=conex();
if(isset($_GET['correos'])){
	$emails=explode(",",$_GET['correos']);
	for($i=0;$i<(count($emails)-1);$i++){
		aviso($emails[$i],$con);
	}
}
$consulta=mysql_query("select poliza.id_poliza,unidad.unidad,poliza.cobertura,poliza.forma_pago,date_format(poliza.fecha_vigencia,'%d/%b/%Y'),poliza.deducible,poliza.foto,socio.nombre,socio.ap,socio.am from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on socio.id_socio=unidad.id_socio where datediff(fecha_vigencia,'".date("Y/m/d")."')<=15 ",$con);
 ?>
<table>
<tr>
    <th>No. Poliza</th>
    <th>Uni.</th>
    <th>Propietario</th>
    <th>F. de Pago</th>
    <th>Vigencia</th>
	<th>Dedu.</th>
    <th>Imagen</th>
</tr>
<?php 
$todo="";
while($dato=mysql_fetch_array($consulta)){?>
<tr class="normal">
	<?php $todo.=$dato[0]."," ?>
    <td><?php echo $dato[0] ?></td>
    <td><?php echo $dato[1] ?></td>
    <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
    <td><?php echo verpago($dato[3]) ?></td>
    <td><?php echo $dato[4] ?></td>
    <td><?php echo $dato[5]." %" ?></td>
    <td><a href="polizas/<?php echo $dato[6] ?>" target="_new">Ver..</a></td>
</tr>
<?php }

}?>
<tr>
	<td colspan="8"><input class="button" name="enviar" type="button" value="Enviar email de Notificaci&oacute;n" onclick="accion()" /></td>
</tr>
</table>
<script language="javascript">
	function accion(){
		location.href="porcaducar.php?correos="+"<?php echo $todo ?>";	
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
function aviso($id,$con){
	$consulta=mysql_query("select socio.email,poliza.id_poliza,unidad.unidad,date_format(poliza.fecha_vigencia,'%d/%b/%Y')as f1,unidad.marca,unidad.modelo,unidad.placas_estatales,unidad.placas_federales,unidad.no_motor,unidad.no_serie,unidad.uso from poliza inner join unidad on unidad.id=poliza.unidad inner join socio on socio.id_socio=unidad.id_socio where poliza.id_poliza='$id'",$con);
	if($dato=mysql_fetch_array($consulta)){
		echo "Email Enviado a ".$dato['email']."</br>";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
$headers .= "From: Soc. Cop Aviso de Vencimiento de Poliza <soccoop_sistemabea@hotmail.com>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: soccoop_sistemabea@hotmail.com\r\n"; 
$texto='
<html>
<head>
<style>
	caption{font-family:"Courier New", Courier, monospace;
				font-variant:small-caps;
				font-weight:bold;
				font-size:25px;
				background-color:yellow;
	}
	th{text-align:left;border:1px solid black; background-color:#09C;color:white;}
	td{border:1px solid black;padding-left:10px;padding-right:10px;}
	table{padding:10px;font-size:16px;}
</style>
</head>
<body>
<p>
	Sociedad cooperativa de autotransporte de coatzacoalcos le informa del vencimiento de poliza.
</p>
<table>
	<caption>Su poliza Esta por Vencer</caption>
	<tr>
		<th>No. Poliza:</th><td>'.$dato["id_poliza"].'</td>
	</tr>
	<tr>
		<th nowrap="nowrap">Fecha de Vencimiento:</th><td bgcolor="red">'.$dato["f1"].'</td>
	</tr>
	<tr>
		<th>Unidad:</th><td>'.$dato["unidad"].'</td>
	</tr>
		<tr>
		<th>Marca:</th><td>'.$dato["marca"].'</td>
	</tr>
		<tr>
		<th>Modelo:</th><td>'.$dato["modelo"].'</td>
	</tr>
		<tr>
		<th>Placas Estatales:</th><td>'.$dato["placas_estatales"].'</td>
	</tr>
		<tr>
		<th>Placas Federales:</th><td>'.$dato["placas_federales"].'</td>
	</tr>
		<tr>
		<th>No. Motor:</th><td>'.$dato["no_motor"].'</td><th>No. Serie:</th><td>'.$dato['no_serie'].'</td>
	</tr>
		<tr>
		<th>Uso:</th><td>'.$dato["uso"].'</td>
	</tr>
	
</table>
<p>
SOCIEDAD COOPERATIVA DE AUTOTRANSPORTE DEL MPIO CD Y PTO DE COATZACOALCOS, VER, S.C.L.<br />
AV. PRINCIPAL No. 100 COL. TRANSPORTISTAS   TEL. 921 21 83162
</p>
</body>
</html>'
;
mail($dato['email'],"Aviso de Vencimiento de Poliza",$texto,$headers);	
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
