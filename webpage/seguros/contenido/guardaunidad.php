<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
session_start();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
$id=$_POST['ide'];
$unidad=$_POST['unidad'];
$marca=$_POST['marca'];
$descr=$_POST['descripcion'];
$modelo=$_POST['modelo'];
$placas_es=$_POST['placas_es'];
$placas_fe=$_POST['placas_fe'];
$motor=$_POST['motor'];
$serie=$_POST['serie'];
$socio=$_POST['socio'];
$origen=$_POST['origen'];
$color=$_POST['color'];
$puertas=$_POST['puertas'];
$ocupantes=$_POST['ocupantes'];
$reg_federal=$_POST['reg_federal'];
$reg_publico=$_POST['reg_publico'];
$uso=$_POST['uso'];
$servicio=$_POST['servicio'];

$nombre=$_FILES['imagen_auto']['name'];
$temporal=$_FILES['imagen_auto']['tmp_name'];
$ext=pathinfo($nombre);
$tamaño=($_FILES['imagen_auto']['size'])/1024;
$alea=rand(100,1000);


include("conexion.php");
$con=conex();
$consulta=mysql_query("select *from unidad where id=$id",$con);
if(mysql_num_rows($consulta)==0)
{
	if($tamaño<40000)
	{
		if(is_uploaded_file($temporal))
		{
			if(($ext["extension"]=="jpg")||($ext["extension"]=="png")||($ext["extension"]=="gif"))
			{
				copy($temporal,"unidades/".$alea."_".$nombre);
				mysql_query("insert into unidad values($id,'$unidad','$marca','$modelo','$placas_es','$placas_fe','$motor','$serie',$socio,'$uso','$descr','$origen','$color',$puertas,$ocupantes,'$reg_federal','$reg_publico','$servicio','".$alea."_".$nombre."')",$con) or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=".mysql_error()));
				echo "<script>alert('La unidad ha sido guardada');location.href='verunidades.php';</script>";
			}
			else{
							header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=Extension Invalida");	
			}
		}
		else{
					header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=falta seleccionar la foto");
		}
	}
	else{
		header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=Excede el Tamaño Permitido");
	}
}
else
{
	if($tamaño<40000)
	{
		if(is_uploaded_file($temporal))
		{
				if($_POST['anterior']!=""){unlink("unidades/".$_POST['anterior']);}
				if(($ext["extension"]=="jpg")||($ext["extension"]=="png")||($ext["extension"]=="gif"))
				{
					
							mysql_query("update unidad set unidad='$unidad',marca='$marca',modelo='$modelo',placas_estatales='$placas_es',placas_federales='$placas_fe',no_motor='$motor',no_serie='$serie',id_socio=$socio,uso='$uso',descripcion='$descr',origen='$origen',color='$color',no_puertas=$puertas,no_ocupantes=$ocupantes,registro_federal='$reg_federal',registro_publico='$reg_publico',servicio='$servicio',imagen='".$alea."_".$nombre."' where id=$id")or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=".mysql_error()));
						echo "<script>alert('La unidad ha sido Actualizada');location.href='verunidades.php';</script>";
				}
				else
				{			header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=Extension Invalida");
				}
		}
		else
		{
			mysql_query("update unidad set  unidad='$unidad',marca='$marca',modelo='$modelo',placas_estatales='$placas_es',placas_federales='$placas_fe',no_motor='$motor',no_serie='$serie',id_socio=$socio,uso='$uso',descripcion='$descr',origen='$origen',color='$color',no_puertas=$puertas,no_ocupantes=$ocupantes,registro_federal='$reg_federal',registro_publico='$reg_publico',servicio='$servicio',imagen='".$_POST['anterior']."' where id=$id")or die(header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=".mysql_error()));
			echo "<script>alert('se ha actualizado la unidad de manera correcta');location.href='verunidades.php'</script>";
		}
	}
	else
	{
	//error de tamaño
	header("location:agreunidad.php?unidad=$unidad&marca=$marca&modelo=$modelo&placas_es=$placas_es&placas_fe=$placas_fe&motor=$motor&serie=$serie&socio=$socio&uso=$uso&descripcion=$descr&origen=$origen&color=$color&puertas=$puertas&ocupantes=$ocupantes&reg_federal=$reg_federal&reg_publico=$reg_publico&servicio=$servicio&error=Excede el Tamaño Permitido");
	}
}
}
	
?>
</body>
</html>