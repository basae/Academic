
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="general.css" />
<script src="../jquery-ui/jquery 1.11.js"></script>
<title>Polizas</title>
</head>

<body>
<?php
session_start();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){ 
include("conexion.php");
$con=conex();
if(isset($_GET['archivo'])){$archivo=$_GET['archivo'];}else{$archivo="";}
if(isset($_GET['poliza'])){$poliza=$_GET['poliza'];}else{$poliza="";}
if((isset($_GET['unidad']))&&($_GET['unidad']!="")){$unidad=$_GET['unidad'];
$consulta=mysql_query("select socio.nombre,socio.ap,socio.am,unidad.* from unidad inner join socio on socio.id_socio=unidad.id_socio where unidad.id=$unidad",$con)or die (mysql_error());
if($dato=mysql_fetch_array($consulta)){
	$socio=$dato['nombre']." ".$dato['ap']." ".$dato['am'];
	$uso=$dato['uso'];
	$servicio=$dato['servicio'];
	$des="Marca: ".$dato['marca']."\nModelo: ".$dato['modelo']."\nPlacas Estatales: ".$dato['placas_estatales'].
	"\nPlacas Federales: ".$dato['placas_federales'].
	"\nNo. de Motor: ".$dato['no_motor'].
	"\nNo. de Serie: ".$dato['no_serie'].
	"\nOrigen: ".$dato['origen'].
	"\nRegistro Público Vehicular: ".$dato['registro_publico'].
	"\nRegistro Federal de Vehículos: ".$dato['registro_federal'].
	"\nNo. Puertas: ".$dato['no_puertas'].
	"\nNo. Ocupantes: ".$dato['no_ocupantes'].
	"\nColor: ".$dato['color'].
	"\nDescripción: ".$dato['descripcion'];
}
else{
	$socio="";
	$uso="";
	$servicio="";
	$des="";	
}
;}else{$unidad="";$socio="";$uso="";$servicio="";$des="";}
if(isset($_GET['pago'])){$pago=$_GET['pago'];}else{$pago="";}
if(isset($_GET['cobertura'])){$cobertura=$_GET['cobertura'];}else{$cobertura="";}
if(isset($_GET['endoso'])){$endoso=$_GET['endoso'];}else{$endoso="";}
if(isset($_GET['compania'])){$compania=$_GET['compania'];}else{$compania="";}
if(isset($_GET['observaciones'])){$observaciones=$_GET['observaciones'];}else{$observaciones="";}
if(isset($_GET['inicio'])){$inicio=$_GET['inicio'];}else{$inicio="dd/mm/aaaa";}
if(isset($_GET['vigencia'])){$vigencia=$_GET['vigencia'];}else{$vigencia="";}
if(isset($_GET['deducible'])){$deducible=$_GET['deducible'];}else{$deducible="";}
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
    <div class="span1"></div>
    <div class="span10">
<h3 align="center">Ingreso de Poliza</h3>
	<form name="f1" id="f1" method="post" action="guardapoliza.php" enctype="multipart/form-data" class="form">
        <label>No. de Poliza</label>
        <input type="text" name="poliza" id="poliza" value="<?php echo $poliza ?>" required/>
        <label>Unidad</label>
        <select name="unidad" id="unidad" onChange="accion(this.value)" required>
                <option value="">Selecciona una Unidad</option>
                <?php
                    $consulta=mysql_query("select *from unidad");
                    while($dato=mysql_fetch_array($consulta)){ ?>
                    <option value="<?php echo $dato['id'] ?>"><?php echo $dato['unidad'] ?></option>
                    <?php } ?>
              </select>
            <label>Cliente</label>
            <input name="socio" type="text" id="socio" value="<?php echo $socio ?>" size="33" readonly/>     
          <label>Uso</label>
          <select name="uso" id="uso" disabled="disabled" required>
                  	  <option value="">Selecciona el uso</option>
                      <option value="CARGA">CARGA</option>
                      <option value="LOCAL">LOCAL</option>
                      <option value="FORÁNEO">FORÁNEO</option>
                      <option value="TURISMO">TURISMO</option>
                      <option value="TRANSPORTE DE PERSONAL">TRANSPORTE DE PERSONAL</option>
                      <option value="TAXI">TAXI</option>
          </select>
          <label>Servicio</label>
            <select name="servicio" id="servicio" disabled="disabled" required>
                <option value="">Selecciona un tipo de servicio</option>
                <option value="PARTICULAR">PARTICULAR</option>
                <option value="PÚBLICO">PÚBLICO</option>
                <option value="PÚBLICO FEDERAL">PÚBLICO FEDERAL (CARGA)</option>
            </select>                     
		<label>Descripción de la Unidad</label>
      	<textarea name="descrip" cols="48" rows="5" readonly><?php echo $des ?></textarea>
        <label>Endoso</label>
	    <input type="number" name="endoso" id="endoso" onBlur="tranforma(this.id)" value="<?php echo $endoso ?>" required />
        <label>Compañia</label>
        <input type="text" name="compania" id="compania" size="35" onBlur="tranforma(this.id)" value="<?php echo $compania ?>" required />
        <label>Forma de Pago</label>     
      <select name="pago" id="pago" onChange="calculo(f1.fecha_inicio.value)" required>
            <option value=""></option>
            <option value="12-m" >ANUAL</option>
            <option value="6-m" >SEMESTRAL</option>
            <option value="4-m" >CUATRIMESTRAL</option>
            <option value="3-m" >TRIMESTRAL</option>
            <option value="2-m" >BIMESTRAL</option>
            <option value="1-m">MENSUAL</option>
      </select>
      <label>Tipo de Cobertura</label>
      <select name="cobertura" id="cobertura" style="width:235px;" required>
        <option value=""></option>
        <option value="AMPLIA">AMPLIA</option>
        <option value="DAÑOS A TERCEROS">DAÑOS A TERCEROS</option>
        <option value="RESPONSABILIDAD CIVIL">RESPONSABILIDAD CIVIL</option>
        <option value="PROFESIONAL">PROFESIONAL</option>
        <option value="GMM">GMM</option>
        <option value="VIDA">VIDA</option>
        <option value="EQUIPO DE CONTRATISTA">EQUIPO DE CONTRATISTA</option>
        <option value="EMPRESARIAL">EMPRESARIAL</option>
        <option value="TRANSPORTE">TRANSPORTE</option>
      </select>
      <label>Fecha de Inicio</label>
      <input name="fecha_inicio" type="date" id="fecha_inicio" value="<?php echo $inicio ?>" required/>
      <label>Fecha de Vigencia</label>
      <input name="vige" type="date" id="vige" value="<?php echo $vigencia ?>" required />
      <label>Deducible</label>
      <input type="number" name="deducible" id="deducible" value="<?php echo $deducible ?>" size="5" required/>
      <label>Imagen</label>
      <input name="imagen" type="file" />
      <input name="anterior" id="anterior" type="hidden" value="<?php echo $archivo ?>" />
	<label>Observaciones</label>
	<textarea name="observaciones" id="observaciones" cols="48" rows="5" onBlur="tranforma(this.id)"><?php echo $observaciones ?></textarea>
	<input name="guardar" type="submit" value="Guardar Poliza" onClick="borra()" class="boton" /><input name="limpiar" type="reset" value="Limpiar Campos" onClick="location.href='crearpoliza.php'" class="boton" />
  </form>
  </div>
  <div class="span1"></div>
  </div>


<script type="text/javascript">
$(function(){
	$("#f1").one("submit",function(event){
		if(parseInt(Date.parse(	$("#fecha_inicio").val()	)) > parseInt(Date.parse(	$("#vige").val()	))){
			alert("La fecha de termino no puede ser menor que la fecha de inicio");
			return false;
		}
		else
		{
		return true;	
		}	
	});
	/*
	$("#fecha_inicio").on("blur",function(){
			var meses=$("#pago").val().split("-");
			var miliseconds=(30*parseInt(meses[0])*24*60*1000);
			
			$("#vige").val(new Date(Date.parse($("#fecha_inicio").val())+parseInt(miliseconds)));
			alert("lol");
		});
		*/
});

function accion(id){
	var poliza=document.getElementById("poliza").value;
	var pago=document.getElementById("pago").value;
	var cobertura=document.getElementById("cobertura").value;
	var inicio=document.getElementById("fecha_inicio").value;
	var dedu=document.getElementById("deducible").value;
	var vigencia=document.getElementById("vige").value;
	var archi=document.getElementById("anterior").value;
	var endo=document.getElementById("endoso").value;
	var compa=document.getElementById("compania").value;
	var obser=document.getElementById("observaciones").value;
location.href="crearpoliza.php?unidad="+id+"&poliza="+poliza+"&pago="+pago+"&cobertura="+cobertura+"&inicio="+inicio+"&vigencia="+vigencia+"&deducible="+dedu+"&archivo="+archi+"&endoso="+endo+"&compania="+compa+"&observaciones="+obser;
}
cargaCombos("<?php echo $unidad; ?>","unidad");
cargaCombos("<?php echo $uso; ?>","uso");
cargaCombos("<?php echo $cobertura; ?>","cobertura");
cargaCombos("<?php echo $pago; ?>","pago");
cargaCombos("<?php echo $servicio; ?>","servicio");

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
/*function calculo(actual){
		var formato=actual.split("-");
		actual=formato[1]+"/"+formato[0]+"/"+formato[2];
		if(formato.length==3){
		var fecha=new Date(actual);
		fecha.setMonth(parseInt(fecha.getMonth())+ parseInt(document.getElementById("pago").value));
		var dia=(fecha.getUTCDate()<10)?"0"+fecha.getUTCDate():fecha.getUTCDate();
		var mes=((fecha.getUTCMonth()+1)<10)?"0"+(fecha.getUTCMonth()+1):(fecha.getUTCMonth()+1);
		var ano=fecha.getUTCFullYear();
		document.getElementById("vige").value=dia+"/"+mes+"/"+ano;
		}
}*/
function tranforma(valor){
		document.getElementById(valor).value=document.getElementById(valor).value.toUpperCase();
	}
</script>
<?php } ?>

</body>
</html>