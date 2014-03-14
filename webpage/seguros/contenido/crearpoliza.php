<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Polizas</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="general.css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
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
<div id="ajustar" style="width:70%">
<h3 align="center">Ingreso de Poliza</h3>
	<form name="f1" method="post" action="guardapoliza.php" enctype="multipart/form-data">
    <table>
    	<tr>
        	<td><label>No. de Poliza</label></td>
        </tr>
        <tr>
        	<td>
      <span id="sprytextfield1">
              <input type="text" name="poliza" id="poliza" value="<?php echo $poliza ?>"/>
              <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
          </td>
       </tr>
       <tr><td>
       		<table><tr>
            <td><label>Unidad</label></td>
            <td><label>Cliente</label></td>
            </tr>
            <td><span id="spryselect1">
                  <select name="unidad" id="unidad" onchange="accion(this.value)">
                  	<option value="">Selecciona una Unidad</option>
                    <?php
						$consulta=mysql_query("select *from unidad");
						while($dato=mysql_fetch_array($consulta)){ ?>
                        <option value="<?php echo $dato['id'] ?>"><?php echo $dato['unidad'] ?></option>
                        <?php } ?>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
                <td><input name="socio" type="text" id="socio" value="<?php echo $socio ?>" size="33" readonly/></td>
            </table>
      </td>
      </tr>
      <tr><td>
      <table><tr>
      <td><label>Uso</label></td>
      <td><label>Servicio</label></td>
      </tr>
      <tr><td>
      <span id="spryselect2">
                  <select name="uso" id="uso" disabled="disabled" style="width:213px;">
                  	  <option value="">Selecciona el uso</option>
      <option value="CARGA">CARGA</option>
      <option value="LOCAL">LOCAL</option>
      <option value="FORÁNEO">FORÁNEO</option>
      <option value="TURISMO">TURISMO</option>
      <option value="TRANSPORTE DE PERSONAL">TRANSPORTE DE PERSONAL</option>
      <option value="TAXI">TAXI</option>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
                <td>
                <span id="spryselect3">
        <select name="servicio" id="servicio" disabled="disabled" style="width:185px;">
        <option value="">Selecciona un tipo de servicio</option>
        <option value="PARTICULAR">PARTICULAR</option>
        <option value="PÚBLICO">PÚBLICO</option>
        <option value="PÚBLICO FEDERAL">PÚBLICO FEDERAL (CARGA)</option>
        </select>
        <span class="selectRequiredMsg">Please select an item.</span></span>
                </td>
          </tr>
        </table>
                </td>
      </tr>
<tr><td><label>Descripción de la Unidad</label></td></tr>
      <tr>
      	<td><textarea name="descrip" cols="48" rows="5" readonly="readonly"><?php echo $des ?></textarea></td>
  <tr>
  <td>
  <table><tr>
  	<td><label>Endoso</label></td>
    <td><label>Compañia</label></td>
  </tr>
  <tr>
  	<td><span id="sprytextfield5">
  	  <input type="text" name="endoso" id="endoso" onblur="tranforma(this.id)" value="<?php echo $endoso ?>" />
  	  <span class="textfieldRequiredMsg">Se requiere un valor.</span></span></td>
      <td><span id="sprytextfield6">
        <input type="text" name="compania" id="compania" size="35" onblur="tranforma(this.id)" value="<?php echo $compania ?>" />
        <span class="textfieldRequiredMsg">Se requiere un valor.</span></span>
      </td>
  </tr>
  </table>
  </td>
  </tr>
      </tr>                
      <tr><td>
      <table><tr><td>
      <label>Forma de Pago</label></td>
      <td><label>Tipo de Cobertura</label></td>
      </tr>
      <tr><td>
      <span id="spryselect3">
                  <select name="pago" id="pago" onchange="calculo(f1.fecha_inicio.value)" style="width:163px;">
                  	<option value=""></option>
                    <option value="12-m" >ANUAL</option>
                    <option value="6-m" >SEMESTRAL</option>
                    <option value="3-m" >TRIMESTRAL</option>
                    <option value="1-m">MENSUAL</option>
                    <option value="15-d">QUINCENAL</option>
                    <option value="14-d">CATORCENAL</option>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td>
      <td>
      <span id="spryselect4">
                  <select name="cobertura" id="cobertura" style="width:235px;">
                  	<option value=""></option>
                    <option value="AMPLIA">AMPLIA</option>
                    <option value="DAÑOS A TERCEROS">DAÑOS A TERCEROS</option>
                    <option value="RESPONSABILIDAD CIVIL">RESPONSABILIDAD CIVIL</option>
                  </select>
                <span class="selectRequiredMsg">Seleccione un elemento.</span></span></td></tr>
          </table>
                </td>
      </tr>
                <tr><td>
                <table><tr><td>
                <label>Fecha de Inicio</label></td>
                <td><label>Fecha de Vigencia</label></td>
                </tr>
                <tr><td>
      <span id="sprytextfield2">
      <script language='javascript' src="popcalendar.js"></script>
      <input name="fecha_inicio" type="text" id="fecha_inicio" value="<?php echo $inicio ?>" readonly="readonly" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato invalido.</span></span>
      <input type="button" value="?" style="width:22px; height:25px; margin-left:-8px;" onclick="popUpCalendar(this, f1.fecha_inicio, 'dd/mm/yyyy');"/></td>
      <td>
   	  <span id="sprytextfield4">
      <input name="vige" type="text" id="vige" readonly value="<?php echo $vigencia ?>" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato invalido.</span></span></td></tr>
      </table>
      </td>
      </tr>
      <tr><td><label>Deducible</label></td></tr>
      <tr><td>
      <span id="sprytextfield3">
                    <input type="text" name="deducible" id="deducible" value="<?php echo $deducible ?>" size="5" />
                    <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></td></tr>
                    <tr><td><label>Imagen</label></td></tr>
                    <tr><td>
                    <input name="imagen" type="file" /></td></tr>
                    <input name="anterior" id="anterior" type="hidden" value="<?php echo $archivo ?>" />
<tr>
	<td><label>Observaciones</label></td>
</tr>
<tr>
	<td><span id="sprytextarea1">
	  <textarea name="observaciones" id="observaciones" cols="48" rows="5" onblur="tranforma(this.id)"><?php echo $observaciones ?></textarea>
</span>
    </td>
</tr>
<tr><td>
                  <input name="guardar" type="submit" value="Guardar Poliza" onclick="borra()" class="boton" /><input name="limpiar" type="reset" value="Limpiar Campos" onclick="location.href='crearpoliza.php'" class="boton" /></td></tr>
      </table>

  </form>
  </div>


<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");

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
if(document.getElementById("fecha_inicio").value!="dd/mm/aaaa"){
	document.getElementById("fecha_inicio").readOnly=false;	
}
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
function desblo(val){
	var valor=document.getElementById(val).value;
	if(valor!=""){
	document.getElementById("fecha_inicio").readOnly=false;
	if(document.getElementById("fecha_inicio").value!="dd/mm/aaaa"){
	calculo(document.getElementById("fecha_inicio").value);
	}
	}
	else{
		document.getElementById("fecha_inicio").readOnly=true;
		document.getElementById("fecha_inicio").value="dd/mm/aaaa";
		document.getElementById("vige").value="";
	}
}
function tranforma(valor){
		document.getElementById(valor).value=document.getElementById(valor).value.toUpperCase();
	}
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3");
var spryselect4 = new Spry.Widget.ValidationSelect("spryselect4");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {hint:"dd/mm/aaaa", validateOn:["blur", "change"], format:"dd/mm/yyyy"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {validateOn:["blur", "change"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "date", {format:"dd/mm/yyyy", validateOn:["blur", "change"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {isRequired:false});
</script>
<?php } ?>

</body>
</html>