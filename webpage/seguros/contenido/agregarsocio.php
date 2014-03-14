<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<script src="../jquery-ui/jquery 1.11.js"></script>
<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="general.css" />
</head>

<body>
<?php
session_start();
include("conexion.php");
$con=conex();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
	if(isset($_GET['nombre'])){$nombre=$_GET['nombre'];}else{$nombre="";};
	if(isset($_GET['repre_legal'])){$repre_legal=$_GET['repre_legal'];}else{$repre_legal="";};
	if(isset($_GET['rfc'])){$rfc=$_GET['rfc'];}else{$rfc="";};
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
		$consulta=mysql_query("delete from socio where id_socio=".$_GET['eliminar']."",$con)or die(mysql_error());
		header("location:versocios.php");
				
	}
	if(isset($_GET['id'])){
		$consulta=mysql_query("select *from socio where id_socio=".$_GET['id']."",$con)or die(mysql_error());	
		if($dato=mysql_fetch_array($consulta)){
			$ide=$dato['id_socio'];
			$rfc=$dato['rfc'];
			$nombre=$dato['nombre'];
			$repre_legal=$dato["tipo_person"];
			$ap=$dato['ap'];
			$am=$dato['am'];
			$dir=$dato['direccion'];
			$telefono=$dato['telefono'];
			$email=$dato['email'];
			
		}
	}
?>
	<?php if(isset($_GET['error'])){ ?>
    <div id="error">
	<div id="image-error">
    	<img src="imagenesdiseño/error.png"  width="100%"/>
    </div>
    <div id="des-error">
    <p>
    <?php echo "Error<br/>*".$_GET['error']; ?>
     </p>
    </div>
</div>
	<?php } ?>
<div class="row-fluid">
	<div class="span2"></div>
    <div class="span8">
<h3 align="center">Ingreso de Cliente</h3>
<form action="guardasocio.php" method="post" name="alta_socio">
<input type="hidden" name="ide" value="<?php echo $ide ?>" readonly/>
	<label>RFC</label>
    <input type="text" name="rfc" id="rfc" value="<?php echo $rfc ?>" size="25" onblur="tranforma(this.id)" required/>
	<div>
    <div><input type="radio" value="Fisica" id="fisica" onSelect="alert('lol')" name="tipo_person" checked/>Persona Fisica</div>
    <div><input type="radio" value="Moral" id="moral" name="tipo_person" />Persona Moral</div>
    <div id="div_legal">
    <label>Representante Legal</label>
    <input type="text" name="repre_legal" id="repre_legal" value="<?php echo $repre_legal ?>" onblur="tranforma(this.id)" size="25" required/>
    </div>
    </div>
    <label>Nombre</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>" onblur="tranforma(this.id)" size="25" required/>
    <label>Apellido Paterno</label>
      <input type="text" name="ap" id="ap" value="<?php echo $ap ?>" onblur="tranforma(this.id)" size="25" required/>
    <label>Apellido Materno</label>
      <input type="text" name="am" id="am" value="<?php echo $am ?>" onblur="tranforma(this.id)" size="25" required/>
    <label>Dirección</label>
      <textarea name="direccion" id="direccion" cols="20" rows="5" onblur="tranforma(this.id)" required><?php echo $dir ?></textarea>
    <label>Teléfono</label>

    <input name="telefono" type="text" id="telefono" value="<?php echo $telefono ?>" maxlength="10" size="10" required/>
    <label>Email</label>
      <input type="email" name="email" id="email" value="<?php echo $email ?>" size="25"/>
    <br/><br />
    <input class="boton" type="submit" name="button" id="button"value="Guardar" /><input name="limpiar" class="boton" type="reset" value="Limpiar" onclick="accion()">

</form>
</div>
<div class="span2"></div>
 </div>
<script type="text/javascript">
function accion(){
	location.href="agregarsocio.php";
}
function tranforma(valor){
		document.getElementById(valor).value=document.getElementById(valor).value.toUpperCase();
	}
</script>
<?php } ?>
<script type="text/javascript">
$(function(){
	$("#div_legal").attr("style","visibility:hidden;");
	
	$("#fisica").on("click",function(event){
		$("#div_legal").attr("style","visibility:hidden;");
		$("#repre_legal").removeAttr("required");
		$("#repre_legal").attr("value","");
		
	});
	
	$("#moral").on("click",function(event){
		$("#div_legal").attr("style","visibility:visible;");
		$("#repre_legal").attr("required");
		$("#repre_legal").attr("value","");
	});
	<?php
	if($repre_legal!=""){ ?>
		$("#div_legal").attr("style","visibility:visible;");
		$("#moral").attr("checked",true);
	<?php }	?>

});
</script>
</body>
</html>