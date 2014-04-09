<?php 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">   
  <head>      
    <meta charset="utf-8" />      
    <meta name="viewport" content="width-device-width">      
    <link rel="stylesheet" href="style_borrar.css">
    <link rel="stylesheet" href="jquery/jquery.alerts.css">

      
    <title>Borrar Registro
    </title>
<script language="javascript" type="text/javascript">     
function objetoAjax(){ 
  var xmlhttp=false; 

  try { 
          xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (e) { 
      try { 
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
      } catch (E) { 
          xmlhttp = false; 
      } 

  } 

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
      xmlhttp = new XMLHttpRequest(); 
  } 
  return xmlhttp; 
} 

function paginas(url, div){ 

ajax=objetoAjax(); 
  ajax.open("GET", url); 
  ajax.onreadystatechange=function() { 
      if (ajax.readyState==4) { 
          document.getElementById(div).innerHTML = ajax.responseText; 
      } 
  } 
  ajax.send(null) 
} 
</script>     
    
       
  </head>   
  <body>          
    <!--<header>                  
     
    </header>           
    <nav>
    </nav> -->     
    <section> 
    <?php
    $folio=$_GET['folio'];
    $fecha=$_GET['fecha'];
    $salon=$_GET['salon'];
    $horaini=$_GET['horaini'];
    $horafin=$_GET['horafin'];            
    ?>
          
      <form id="fborrar" method="post" action="" >             

        <div id="registro">   
        <label>Esta seguro de Borrar el registro:<br></label> <br>
        
        <label id="lfecha">Fecha: </label>
        <label><?php echo "$fecha";?></label>   <br>
        
        <label id="lsalon">Sal&oacute;n: </label>
        <label><?php echo "$salon"; ?></label> <br>
        
        <label id="lhorario">Horario: </label>
        <label><?php echo "$horaini"."-"."$horafin"; ?></label>  <br>              
        </div>
         
           
        <div id="bottoms">   
        <input type="submit" value="Borrar" id="Borrar" name="Borrar">
        <input type="submit" value="Cancelar" id="Cancelar" onClick="window.close();"   name="Cancelar">
        </div>
        
                   
      </form> 
        
      <!-- <article id="historia">
  
               
               </article>-->       
    </section>      
    <footer>           
    </footer>   
  </body>
</html>


<?php

if($_POST['Borrar']){

             $link = @mysql_connect("localhost", "root","") or die ("Error al conectar a la base de datos.");
             @mysql_select_db("salones", $link) or die ("Error al conectar a la base de datos.");

$query2="DELETE from apartados where fecha='$fecha' and folio='$folio'"; 
$result2 = mysql_query($query2);
echo $result2;
   echo"<script type=\"text/javascript\">alert('Eliminaci\u00f3n  exitosa!!')</script>";
   //echo"<a href=\"javascript:window.opener.document.location.reload();self.close()\"> Cerrar </a> ";
  // $_POST['Buscar']=1; 
  //echo "<script type=\"text/javascript\">opener.document.location.href = 'consulta_salones.php';</script>";
   echo "<script type=\"text/javascript\">window.opener.location.paginas('consulta_salones.php','formulario');</script>";
    //onunload="opener.location.reload()" location.refresh();
   // echo"<script type=\"text/javascript\">opener.location.refresh();</script>";
   echo"<script type=\"text/javascript\">window.close();</script>";

}
?>
