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
	include("conexion.php");
	$con=conex();
	$unidad=$_POST['unidad'];
	$poliza=$_POST['poliza'];
	$pago=$_POST['pago'];
	$cobertura=$_POST['cobertura'];
	$fecha_inicio=$_POST['fecha_inicio'];
	$vigencia=$_POST["vige"];
	$endoso=$_POST["endoso"];
	$compania=$_POST["compania"];
	$observaciones=$_POST["observaciones"];
	
	$deducible=$_POST['deducible'];
				

	$nombre=$_FILES['imagen']['name'];
	$temporal=$_FILES['imagen']['tmp_name'];
	$ext=pathinfo($nombre);
	$tamaño=($_FILES['imagen']['size'])/1024;
	$alea=rand(100,1000);
		$retorno="crearpoliza.php?poliza=$poliza&unidad=$unidad&pago=$pago&cobertura=$cobertura&inicio=$fecha_inicio&vigencia=$vigencia&deducible=$deducible&archivo=$nombre&observaciones=$observaciones&endoso=$endoso&compania=$compania";
		$consulta=mysql_query("select *from poliza where id_poliza='$poliza'",$con)or die(header("location:".$retorno."&error=".mysql_error()));
if(!mysql_fetch_array($consulta)){
	if($tamaño<20000){
		if(is_uploaded_file($temporal)){
			if(($ext["extension"]=="jpg")||($ext["extension"]=="png")||($ext["extension"]=="gif")){
				copy($temporal,"polizas/".$alea."_".$nombre);
			
				mysql_query("insert into poliza values('$poliza',$unidad,'$cobertura','$pago',str_to_date('".$fecha_inicio."','%d/%m/%Y'),str_to_date('".$vigencia."','%d/%m/%Y'),$deducible,'".$alea."_".$nombre."','$endoso','$compania','$observaciones')",$con)or die(header("location:".$retorno."&error=".mysql_error()));
				echo "<script>alert('La Poliza Se ha Almacenado con Exito');location.href='verpolizas.php';</script>";
			}
			else{
				header("location:".$retorno."&error=Extension Invalida");	
			}
		}
		else{
			header("location:".$retorno."&error=falta seleccionar la foto");
			}
	}
	else{header("location:".$retorno."&error=Excede el Tamaño Permitido");}
}
else{
	if($tamaño<20000){
		if(is_uploaded_file($temporal)){
			if($_POST['anterior']!=""){unlink("polizas/".$_POST['anterior']);}
			if(($ext["extension"]=="jpg")||($ext["extension"]=="png")||($ext["extension"]=="gif")){
				mysql_query("update poliza set unidad=$unidad,cobertura='$cobertura',forma_pago='$pago',fecha_inicio=str_to_date('".$fecha_inicio."','%d/%m/%Y'),fecha_vigencia=str_to_date('".$vigencia."','%d/%m/%Y'),deducible=$deducible,foto='".$alea."_".$nombre."',endoso='$endoso',compania='$compania',observaciones='$observaciones' where id_poliza='$poliza'",$con)or die(header("location:".$retorno."&error=".mysql_error()));
				move_uploaded_file($temporal,"polizas/".$alea."_".$nombre);
				echo "<script>alert('La Poliza Se ha Actualizado con Exito');location.href='verpolizas.php';</script>";
			}
			else{
				header("location:".$retorno."&error=Extension Invalida");	
			}
		}
		else{
			mysql_query("update poliza set unidad=$unidad,cobertura='$cobertura',forma_pago='$pago',fecha_inicio=str_to_date('".$fecha_inicio."','%d/%m/%Y'),fecha_vigencia=str_to_date('".$vigencia."','%d/%m/%Y'),deducible=$deducible,foto='".$_POST['anterior']."',endoso='$endoso',compania='$compania',observaciones='$observaciones' where id_poliza='$poliza'",$con)or die(header("location:".$retorno."&error=".mysql_error()));
			echo "<script>alert('La Poliza Se ha Actualizado con Exito');location.href='verpolizas.php';</script>";
			}
	}
	else{header("location:".$retorno."&error=Excede el Tamaño Permitido");}	
	}
	
}

?>
</body>
</html>