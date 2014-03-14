<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
$nick=$_POST['nick'];
$pass=$_POST['pass'];
$nombre=$_POST['nombre'];
$email=$_POST['email'];
include("conexion.php");
$con=conex();
mysql_query("insert into usuario values('$nick','$pass','$nombre','$email','user')",$con)or die(header("location:registrarse.php?nick=$nick&nombre=$nombre&email=$email&error=".mysql_error()));

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
$headers .= "From: El Sentinela <coatza@prepcoatza.webatu.com>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: coatza@prepcoatza.webatu.com\r\n"; 
$texto="Bienvenido al Sentinela gracias por suscribirte <br/>Usuario: ".$nick." <br/>Password:" .$pass." <br/>Ingresa en <a href='www.prepcoatza.webatu.com/login.html'>El Sentinela</a>";
echo "se envio un email a ".$email." con tu usuario y contraseña verifica en la bandeja de 'correo no deseado'";

mail($email,"Bienvenido",$texto,$headers);

?>
</body>
</html>