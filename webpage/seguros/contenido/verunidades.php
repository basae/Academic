<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<?php session_start() ?>
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
	include("conexion.php");
	$con=conex();
	$consulta=mysql_query("select unidad.unidad,unidad.id,unidad.marca,unidad.modelo,unidad.no_serie,unidad.no_motor,unidad.uso,unidad.placas_federales,unidad.placas_estatales,socio.id_socio,socio.nombre,socio.ap,socio.am,unidad.imagen from unidad inner join socio on unidad.id_socio=socio.id_socio",$con); ?>
    <div class="row-fluid">
    <div class="span12">
	<table class="table table-condensed table-hover table-striped table-bordered">
    <caption>Unidades Registradas</caption>
    	<tr><th ></th><th>Unidad</th><th>Marca</th><th>Modelo</th><th>Nombre</th><th>Uso</th><th>Placas Est.</th><th>Placas Fed.</th></tr>
        <?php while($dato=mysql_fetch_array($consulta)){ ?>
        <tr>
        	<td><a href="agreunidad.php?id=<?php echo $dato['id'] ?>">Editar</a>|<a href="agreunidad.php?eliminar=<?php echo $dato['id'] ?>" onclick="return confirm('¿Estas Seguro de Eliminar el Registro?')">Eliminar</a><br/><a target="_new" href="unidades/<?php echo $dato['imagen'] ?>">Ver..</a></td>
     	<td><?php echo $dato['unidad'] ?></td>
        <td><?php echo $dato['marca'] ?></td>
        <td><?php echo $dato['modelo'] ?></td>
        <td><?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'] ?></td>
        <td><?php echo $dato['uso'] ?></td>
        <td><?php echo $dato['placas_estatales'] ?></td>
        <td><?php echo $dato['placas_federales'] ?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
       </div>
</body>
</html>
