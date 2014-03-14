<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registro</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="general.css" media="screen" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
session_start();
include("conexion.php");
$con=conex();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){ 
if(isset($_GET['nick'])){$nick=$_GET['nick'];}else{$nick="";}
if((isset($_GET['nombre']))&&($_GET['nombre']!="")){$nombre=$_GET['nombre'];
$consulta=mysql_query("select email from socio where id_socio=$nombre",$con);
if($dato=mysql_fetch_array($consulta)){
	$email=$dato[0];
}
else{
	$email="";	
}
}else{$nombre="";$email="";}
?>
<div id="centro">
  <form id="form1" name="form1" method="post" action="guardaregistro.php">
  <table>
  <caption>Ingreso de Usuarios para Login</caption>
  <tr>
    <th nowrap="nowrap">*Nombre Completo:</th>
    <td><span id="spryselect1">
      <select name="nombre" id="nombre" onchange="accion(this.value)">
      	<option value=""></option>
        <?php 
		$conexion=mysql_query("select *from socio",$con);
		while($dato=mysql_fetch_array($conexion)){ ?>
        	<option value="<?php echo $dato['id_socio'] ?>"><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am']; ?></option>
        <?php } ?>
      </select>
      <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
  </tr>
  <tr>
    <th nowrap="nowrap">*Correo Electronico:</th>
    <td><span id="sprytextfield3">
    <input name="email" type="text" id="email" value="<?php echo $email ?>" readonly="readonly" />
    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
  </tr>
  <tr>
    <th width="27%" nowrap="nowrap">*Nickname:</th>
    <td width="73%"><span id="sprytextfield1">
      <input type="text" name="nick" id="nick" value="<?php echo $nick ?>" /><span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
      </td>
  </tr>
  <tr>
    <th nowrap="nowrap">*Password:</th>
    <td><span id="sprypassword1">
      <input name="pass" type="password" id="pass" maxlength="10" />
      <span class="passwordRequiredMsg">Se necesita un valor.</span></span></td>
  </tr>
  <tr>
    <th nowrap="nowrap">*Repetir Password:</th>
    <td><span id="spryconfirm1">
      <input name="validapass" type="password" id="validapass" maxlength="10" />
      <span class="confirmRequiredMsg">Se necesita un valor.</span><span class="confirmInvalidMsg">Los valores no coinciden.</span></span></td>
  </tr>
  <tr>
  	<td width="27%" nowrap="nowrap">&nbsp;</td>
  	<td><input name="enviar" type="submit" value="Enviar"  />
    <input name="limpiar" type="reset" value="Limpiar" onclick="location.href='registrarse.php'" /></td>
  </tr>
</table>

  </form>
	
</div>
<div class="error">
	<?php if(isset($_GET['error'])){
		echo "Error<br/>*".$_GET['error'];	
	}
	?>
</div>
<script type="text/javascript">
function accion(id){
	var nickname=document.getElementById("nick").value;
location.href="registrarse.php?nombre="+id+"&nick="+nickname;
}
cargaCombos("<?php echo $nombre ?>","nombre");
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

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur"]});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "email", {validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "pass", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
<?php } ?>
</body>
</html>
