<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="general.css" />
<style>
	body > div {
	margin-top:8px;
	}
	table{
		background-color:#FFF;	
	}
</style>

</head>

<body>
	<?php
		session_start();
		if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
		include("conexion.php");
		$con=conex();
		$consulta=mysql_query("select id_socio,nombre,ap,am,direccion,email from socio");?>
        <div class="row-fluid">
        <div class="span1"></div>
        <div class="span10">
        <table class="table table-condensed table-hover table-striped table-bordered">
        <caption align="top">Socios Registrados</caption>
        <tr><th></th><th>Nombre</th><th>Dirección</th><th>Correo Electronico</th></tr>
		<?php while($dato=mysql_fetch_array($consulta)){ ?>
		  <tr>
     			 <td><a href="agregarsocio.php?id=<?php echo $dato['id_socio']; ?>">Editar</a>&nbsp;|&nbsp;<a href="agregarsocio.php?eliminar=<?php echo $dato['id_socio']; ?>" onClick="return confirm('¿Estas seguro de Eliminar el Registro?');">Eliminar</a></td> 
              <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am']; ?></td>
              <td><?php echo $dato['direccion']; ?></td>					
				<td><?php echo $dato['email']; ?></td>

          </tr>
		<?php }	
		}?>
        </table>
        </div>
        <div class="span1"></div>
        </div>

</body>
</html>