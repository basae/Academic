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

      
    <title>Borrar Todos los registros
    </title>   
  </head>   
  <body>          
    <!--<header>                  
     
    </header>           
    <nav>
    </nav> -->     
    <section>
    <?php
    
    $fecha=$_GET['fecha'];
    $salon=$_GET['salon'];
    $horaini=$_GET['horaini'];
    $horafin=$_GET['horafin'];
    $folio=$_GET['folio'];            
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

$query2="DELETE from apartados where folio='$folio' and fecha='$fecha'"; 
$result2 = mysql_query($query2);
echo $result2;
   echo"<script type=\"text/javascript\">alert('Eliminaci\u00f3n  exitosa!!')</script>";
   echo"<script type=\"text/javascript\">window.close();</script>";

}
?>