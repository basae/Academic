<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap/css/bootstrap.css" media="screen" />
<link rel="stylesheet" type="text/css" href="general.css" />
<script src="../jquery-ui/jquery 1.11.js"></script>
<title>Alta de Unidad</title>
</head>

<body>
<?php
session_start();
include("conexion.php");
$con=conex();
if((isset($_SESSION['user']))&&($_SESSION['user']=="master") ){
	$ide="";
	if(isset($_GET['unidad'])){$unidad=$_GET['unidad'];}else{$unidad="";}
	if(isset($_GET['origen'])){$origen=$_GET['origen'];}else{$origen="";}
	if(isset($_GET['marca'])){$marca=$_GET['marca'];}else{$marca="";}
	if(isset($_GET['modelo'])){$modelo=$_GET['modelo'];}else{$modelo="";}
	if(isset($_GET['placas_es'])){$placas_es=$_GET['placas_es'];}else{$placas_es="";}
	if(isset($_GET['placas_fe'])){$placas_fe=$_GET['placas_fe'];}else{$placas_fe="";}
	if(isset($_GET['motor'])){$motor=$_GET['motor'];}else{$motor="";}
	if(isset($_GET['serie'])){$serie=$_GET['serie'];}else{$serie="";}
	if(isset($_GET['uso'])){$uso=$_GET['uso'];}else{$uso="";}
	if(isset($_GET['servicio'])){$servicio=$_GET['servicio'];}else{$servicio="";}
	if(isset($_GET['color'])){$color=$_GET['color'];}else{$color="";}
	if(isset($_GET['puertas'])){$puertas=$_GET['puertas'];}else{$puertas="";}
	if(isset($_GET['ocupantes'])){$ocupantes=$_GET['ocupantes'];}else{$ocupantes="";}
	if(isset($_GET['reg_federal'])){$reg_federal=$_GET['reg_federal'];}else{$reg_federal="";}
	if(isset($_GET['reg_publico'])){$reg_publico=$_GET['reg_publico'];}else{$reg_publico="";}
	if(isset($_GET['descripcion'])){$descr=$_GET['descripcion'];}else{$descr="";}
	if(isset($_GET['socio'])){$socio=$_GET['socio'];}else{$socio="";}
	if(isset($_GET['id'])){
		$consulta=mysql_query("select *from unidad where id=".$_GET['id']."",$con);
		if($dato=mysql_fetch_array($consulta)){
			$ide=$dato['id'];
			$unidad=$dato['unidad'];
			$marca=$dato['marca'];
			$descr=$dato['descripcion'];
			$modelo=$dato['modelo'];
			$placas_es=$dato['placas_estatales'];
			$placas_fe=$dato['placas_federales'];
			$motor=$dato['no_motor'];
			$serie=$dato['no_serie'];
			$uso=$dato['uso'];
			$socio=$dato['id_socio'];
			$origen=$dato['origen'];
			$color=$dato['color'];
			$puertas=$dato['no_puertas'];
			$ocupantes=$dato['no_ocupantes'];
			$reg_federal=$dato['registro_federal'];
			$reg_publico=$dato['registro_publico'];
			$servicio=$dato['servicio'];
		}
	}
	if(isset($_GET['eliminar'])){
		$consulta=mysql_query("delete from unidad where id=".$_GET['eliminar']."",$con);
		header("location:verunidades.php");
	}
	if($ide==""){
	$consulta=mysql_query("select max(id) from unidad");
	if($dato=mysql_fetch_array($consulta)){
	$ide=$dato[0]+1;
	}
	}
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
<div id="ajustar" style="width:80%">
	<h3 align="center">Ingreso de Unidades</h3>
	<form name="alta" method="post" action="guardaunidad.php" class="form-horizontal">
    <fieldset>
    <table>
            <input type="hidden" name="ide" value="<?php echo $ide ?>" readonly="readonly"/>
            <tr>
            	<td><label>No. Eco.</label></td>
          </tr>
          <tr>
              <td><input type="text" name="unidad" id="unidad" value="<?php echo $unidad ?>" size="25" onblur="tranforma(this.id)" /></td>
          </tr>
          <tr>
          	<td><label>Cliente</label></td>
          </tr>
          <tr>
          	<td>
                <select name="socio" id="socio">
                <?php
                  $consulta=mysql_query("select id_socio,nombre,ap,am from socio",$con); ?>
                  <option value=""></option>
              <?php while($dato=mysql_fetch_array($consulta)){  ?>
                <option value="<?php echo $dato[0] ?>"><?php echo $dato[1]." ".$dato[2]." ".$dato[3] ?></option>
                <?php } ?>
                </select>
            </td>
         </tr>
         <tr>
         	<td>
            	<table>
                	<tr>
                    	<td><label>Servicio</label></td>
                        <td><LABEL>Uso</LABEL></td>
                    </tr>
          			<tr>
                    	<td>
                          <select name="servicio" id="servicio">
                          <option value="">Selecciona un tipo de servicio</option>
                          <option value="PARTICULAR">PARTICULAR</option>
                          <option value="PÚBLICO">PÚBLICO</option>
                          <option value="PÚBLICO FEDERAL">PÚBLICO FEDERAL (CARGA)</option>
                  			</select>
              			</td>
          				<td>
                            <select name="uso" id="uso" >
                            <option value="">Selecciona el uso</option>
                            <option value="CARGA">CARGA</option>
                            <option value="LOCAL">LOCAL</option>
                            <option value="FORÁNEO">FORÁNEO</option>
                            <option value="TURISMO">TURISMO</option>
                            <option value="TRANSPORTE DE PERSONAL">TRANSPORTE DE PERSONAL</option>
                            <option value="TAXI">TAXI</option>
                            <option value="TAXI">PARTICULAR</option>
                            </select>
            			</td>
            	</tr>
            </table>
		</td>
	</tr>
	<tr>
    	<td><label>Origen de la unidad (Legalizado, Nacional, etc.)</label></td>
	</tr>
    <tr>
    	<td><input type="text" name="origen" id="origen" value="<?php echo $origen ?>" onblur="tranforma(this.id);" /></td>
	</tr>
    <tr>
    	<td>
        	<table>
            	<tr>
                	<td><label>Marca</label></td>
                    <td><label>Modelo</label></td>
                    <td><label>Color</label></td>
				</tr>
                <tr>
                	<td><input type="text" name="marca" id="marca" value="<?php echo $marca?>" onblur="tranforma(this.id)" /><td>
                    <td><input type="text" name="modelo" id="modelo" value="<?php echo $modelo ?>" onblur="tranforma(this.id)" /></td>
                    <td><input type="text" name="color" id="color" onblur="tranforma(this.id)" value="<?php echo $color ?>" /></td>
				</tr>
			</table>
		</td>
	</td>
    <tr>
    	<td>
        	<table>
            	<tr>
                	<td><label>No. de Puertas</label></td>
                    <td><label>No. de Ocupantes</label></td>
					<td><label>Placas Estatales</label></td>
				</tr>
                <tr>
                	<td><input type="text" name="puertas" id="puertas" onblur="tranforma(this.id)" value="<?php echo $puertas ?>" /></td>
                    <td><input type="text" name="ocupantes" id="ocupantes" onblur="tranforma(this.id)" value="<?php echo $ocupantes ?>" /></td>
                    <td><input type="text" name="placas_es" id="placas" value="<?php echo $placas_es ?>" onblur="tranforma(this.id)" /></td>
				</tr>
			</table>
		</td>
	</tr>
    <tr>
    	<td>
        	<table>
            	<tr>
                	<td><label>Placas Federales</label></td>
                    <td><label>No. Motor</label></td>
                    <td><label>No. Serie</label></td>
				</tr>
                <tr>
                	<td><input type="text" name="placas_fe" id="placas_fe" value="<?php echo $placas_fe ?>" onblur="tranforma(this.id)" /></td>
                    <td><input type="text" name="motor" id="motor" value="<?php echo $motor ?>" onblur="tranforma(this.id)"/></td>
                    <td><input type="text" name="serie" id="serie" value="<?php echo $serie ?>" onblur="tranforma(this.id)" /></td>
				</tr>
                <tr>
                	<td><label>No. Registro Federal Vehículos (hasta modelos 1990)</label></td>
				</tr>
                <tr>
                	<td><input type="text" name="reg_federal" id="reg_federal" onblur="tranforma(this.id);" value="<?php echo $reg_federal ?>" /></td>        
				</tr>
                <tr>
                	<td><label>Reg. Publico Vehicular (obligatorio)</label></td>
				</tr>
                <tr>
                	<td><input type="text" name="reg_publico" id="reg_publico" onblur="tranforma(this.id)" value="<?php echo $reg_publico ?>" /></td>             
				</tr>
                <tr>
                	<td><label>Descripción (aire acondicionado, quemacocos, equipo especial)</label></td>
				</tr>
                <tr>
                	<td><textarea name="descripcion" id="descripcion" cols="57" rows="5" onblur="tranforma(this.id)"><?php echo $descr ?></textarea></td>
				</tr>
                <tr>
                	<td><input name="enviar" type="submit" value="Guardar" class="boton" /><input name="limpiar" class="boton" type="reset" value="Limpiar" onclick="accion()" /></td>
				</tr>
      </table>
</fieldset>
  </form>

</div>
<script type="text/javascript">
	var valor="<?php echo $uso ?>";
	var valor2="<?php echo $socio ?>";
	var valor3="<?php echo $servicio ?>";
	if(valor!=""){
	var maxi=document.getElementById('socio');
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor2){
				maxi[i].selected=true;	
			}
	}
	}
	if(valor2!=""){
	var maxi=document.getElementById('uso');
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor){
				maxi[i].selected=true;	
			}
	}
	}
	
	if(valor3!=""){
	var maxi=document.getElementById("servicio");
	for(var i=0;i<maxi.length;i++){
			if( maxi[i].value==valor3){
				maxi[i].selected=true;	
			}
	}
	}
	function accion(){
		location.href="agreunidad.php";	
	}
	function tranforma(valor){
		document.getElementById(valor).value=document.getElementById(valor).value.toUpperCase();
	}
</script>
<?php }
else{
	echo "no tienes permisos suficientes para ingresar en esta sección";
}
?>
</body>
</html>