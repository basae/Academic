<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="general.css" />
</head>

<body>
	<?php
		session_start();
		if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
		include("conexion.php");
		$con=conex();
		$consulta=mysql_query("select *from socio");?>
        <table class="aplicar"><caption align="top">Socios Registrados</caption>
        <tr><th></th><th>Nombre</th><th>Dirección</th><th>Correo Electronico</th></tr>
		<?php while($dato=mysql_fetch_array($consulta)){ ?>
		  <tr class="normal">
     			 <td><a href="agregarsocio.php?id=<?php echo $dato['id_socio']; ?>">Editar</a>&nbsp;|&nbsp;<a href="agregarsocio.php?eliminar=<?php echo $dato['id_socio']; ?>" onclick="return confirm('¿Estas seguro de Eliminar el Registro?');">Eliminar</a></td> 
              <td nowrap="nowrap"><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am']; ?></td>
              <td><?php echo $dato['direccion']; ?></td>					
				<td><?php echo $dato['email']; ?></td>

          </tr>
		<?php }	
		}?>
        </table>

</body>
</html>