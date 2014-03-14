<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Edrei Javier Bastar Sarao - basae_01@hotmail.com" />
<meta name="Robots" content="index,follow" />
<title></title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<?php session_start() ?>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="general.css" />
</head>

<body>

	<?php 
	include("conexion.php");
	$con=conex();
	$consulta=mysql_query("select unidad.unidad,unidad.id,unidad.marca,unidad.modelo,unidad.no_serie,unidad.no_motor,unidad.uso,unidad.placas_federales,unidad.placas_estatales,socio.id_socio,socio.nombre,socio.ap,socio.am from unidad inner join socio on unidad.id_socio=socio.id_socio",$con); ?>
	<table class="aplicar">
    <caption>Unidades Registradas</caption>
    	<tr><th ></th><th>Unidad</th><th>Marca</th><th>Modelo</th><th>Nombre</th><th>Uso</th><th>Placas Est.</th><th>Placas Fed.</th></tr>
        <?php while($dato=mysql_fetch_array($consulta)){ ?>
        <tr class="normal">
        	<td nowrap="nowrap"><a href="agreunidad.php?id=<?php echo $dato['id'] ?>">Editar</a>|<a href="agreunidad.php?eliminar=<?php echo $dato['id'] ?>" onclick="return confirm('¿Estas Seguro de Eliminar el Registro?')">Eliminar</a></td>
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
</body>
</html>
