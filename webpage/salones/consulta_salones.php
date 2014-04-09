<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="es">   
  <head>      
    <meta charset="utf-8" />      
    <meta name="viewport" content="width-device-width">      
    <link  href="style_consulta.css" type="text/css" rel="stylesheet" >
    <link href="css/jquery-ui.css" type="text/css" rel="stylesheet" >
    <link  href="css/datatables.css" type="text/css" rel="stylesheet" >
    
    <script type="text/javascript" src="js/jquery.js"></script> 
    <script type="text/javascript" src="js/datatables.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script> 
    <script type="text/javascript" src="js/functions.js"></script>             
    <title>Sistema Salones
    </title>   
  </head>   
  <body>          
    <header>                  
      <!-- <h1>Sistema Salones</h1> <h1></h1> -->       
    </header>           
    <nav>
      <ul>    
        <li>
        <a title="Opcion 1">Reservar</a>       
        <ul>       
          <li>
          <a title="Opcion 1" href="buscar_fecha.php">Fecha</a>
          </li>       
          <li>
          <a title="Opcion 1" href="buscar_rangofecha.php">Rango Fecha</a>
          </li>       
        </ul>    
        </li>  
        <li>
        <a title="Opcion 1" href="#">Consulta</a>
        </li>
      </ul>
      <img src="logo2_chico.png">
    </nav>      
    <section> 
 <div id="formulario">        
 <form id="fbuscarfecha" method="post" action="" > 
<!-- 
 <table>
 <thead>
 <tr>
    <th>folio</th>
    <th>Salon</th>
    <th>Fecha</th>
    <th>Hora Inicio</th>
    <th>Hora Fin</th>
    <th>Asunto</th>
    <th>Crn</th>
    </tr>
    </thead>
    </table> --->                                    
        <div id="labels">               
        </div>                            
        <div id="lfecha">                        
          <label for="date" id="fecha">Fecha
          </label>                                   
          <input type="date" id="fecha" name="fecha" placeholder="Ingresa la fecha"  title="Ingresa Fecha" value="<?php if (isset($_POST['fecha'])) echo $_POST['fecha']; ?>">           
        </div>                       
        <div id="lsalon">                  
          <label for="salon" id="salon">Sal&oacuten
          </label>                  
 <SELECT name="salon" id="salon">

            <OPTION VALUE="<?php echo $_POST['salon']; ?>" >
            <?php if($_POST['salon']==1302){ echo '1302'; }
            else if($_POST['salon']==1303){ echo '1303';}  
            else if($_POST['salon']==1304){ echo '1304';}
            else if($_POST['salon']==1305){ echo '1305';}
            else if($_POST['salon']==1306){ echo '1306';}
            else if($_POST['salon']==1307){ echo '1307';}
            else if($_POST['salon']==1308){ echo '1308';}
            else if($_POST['salon']==2201){ echo '2201';}
            else if($_POST['salon']==2202){ echo '2202';}
            else if($_POST['salon']==2203){ echo '2203';}
            else if($_POST['salon']==2204){ echo '2204';}
            else if($_POST['salon']==2205){ echo '2205';}
            else if($_POST['salon']==2206){ echo '2206';} 
            else if($_POST['salon']==2207){ echo '2207';}
            else if($_POST['salon']==2208){ echo '2208';}
            else if($_POST['salon']==2209){ echo '2209';}
            else if($_POST['salon']==2210){ echo '2210';}
            else if($_POST['salon']==2301){ echo '2301';}
            else if($_POST['salon']==2302){ echo '2302';} 
            else if($_POST['salon']==2303){ echo '2303';}
            else if($_POST['salon']==2304){ echo '2304';}
            else if($_POST['salon']==2305){ echo '2305';} 
            else if($_POST['salon']==2306){ echo '2306';}
            else if($_POST['salon']==2307){ echo '2307';}
            else if($_POST['salon']==2308){ echo '2308';} 
            else if($_POST['salon']==2309){ echo '2309';}
            else if($_POST['salon']==2310){ echo '2310';}
            else if($_POST['salon']==2403){ echo '2403';} 
            else if($_POST['salon']==2404){ echo '2404';}
            else if($_POST['salon']==2405){ echo '2405';}
            else if($_POST['salon']==2406){ echo '2406';}
            else if($_POST['salon']==2407){ echo '2407';}
            else if($_POST['salon']==2408){ echo '2408';}
            else if($_POST['salon']==2409){ echo '2409';} 
            else if($_POST['salon']==3102){ echo '3102';}
            else if($_POST['salon']==3103){ echo '3103';}
            else if($_POST['salon']==3104){ echo '3104';}
            else if($_POST['salon']==3105){ echo '3105';}
            else if($_POST['salon']==3106){ echo '3106';}
            else if($_POST['salon']==3201){ echo '3201';} 
            else if($_POST['salon']==3202){ echo '3202';}
            else if($_POST['salon']==3203){ echo '3203';}
            else if($_POST['salon']==3204){ echo '3204';} 
            else if($_POST['salon']==3205){ echo '3205';}
            else if($_POST['salon']==3206){ echo '3206';}
            else if($_POST['salon']==3207){ echo '3207';} 
            else if($_POST['salon']==3301){ echo '3301';}
            else if($_POST['salon']==3302){ echo '3302';}
            else if($_POST['salon']==3303){ echo '3303';}
            else if($_POST['salon']==3304){ echo '3304';}
            else if($_POST['salon']==3305){ echo '3305';}
            else if($_POST['salon']==3306){ echo '3306';}          
            else if($_POST['salon']==3307){ echo '3307';}
            else if($_POST['salon']==3308){ echo '3308';}
            else if($_POST['salon']==3309){ echo '3309';}
            else if($_POST['salon']==3401){ echo '3401';}
            else if($_POST['salon']==3402){ echo '3402';}
            else if($_POST['salon']==3403){ echo '3403';}  
            else if($_POST['salon']==3404){ echo '3404';}
            else if($_POST['salon']==3405){ echo '3405';}
            else if($_POST['salon']==3406){ echo '3406';}
            else if($_POST['salon']==3407){ echo '3407';}
            else if($_POST['salon']==3408){ echo '3408';}
            else if($_POST['salon']==3409){ echo '3409';}          
            else if($_POST['salon']==3410){ echo '3410';}      
            else if($_POST['salon']==4202){ echo '4202';}
            else if($_POST['salon']==4205){ echo '4205';}
            else if($_POST['salon']==4206){ echo '4206';}
            else if($_POST['salon']==4301){ echo '4301';}
            else if($_POST['salon']==4302){ echo '4302';}      
            else if($_POST['salon']==4303){ echo '4303';}
            else if($_POST['salon']==4304){ echo '4304';}
            else if($_POST['salon']==4306){ echo '4306';}
            else if($_POST['salon']==4307){ echo '4307';}     
            else if($_POST['salon']==4401){ echo '4401';}
            else if($_POST['salon']==4402){ echo '4402';}
            else if($_POST['salon']==4403){ echo '4403';}
            else if($_POST['salon']==4404){ echo '4404';}         
            else if($_POST['salon']==4405){ echo '4405';}
            else if($_POST['salon']==4406){ echo '4406';}
            else if($_POST['salon']==4407){ echo '4407';}
            else if($_POST['salon']==""){ echo '';}                                                                                                                                                                                                                                                    
            ?>
            </OPTION>
            <OPTION value="">
            </OPTION>    
            <OPTION VALUE="1302">1302
            </OPTION>   
            <OPTION VALUE="1303">1303
            </OPTION>   
            <OPTION VALUE="1304">1304
            </OPTION>   
            <OPTION VALUE="1305">1305
            </OPTION>   
            <OPTION VALUE="1306">1306
            </OPTION>               
            <OPTION VALUE="1307">1307
            </OPTION>
            <OPTION VALUE="1308">1308
            </OPTION>                
            <OPTION VALUE="2201">2201
            </OPTION>   
            <OPTION VALUE="2202">2202
            </OPTION>   
            <OPTION VALUE="2203">2203
            </OPTION>   
            <OPTION VALUE="2204">2204
            </OPTION>   
            <OPTION VALUE="2205">2205
            </OPTION>   
            <OPTION VALUE="2206">2206
            </OPTION>   
            <OPTION VALUE="2207">2207
            </OPTION>   
            <OPTION VALUE="2208">2208
            </OPTION>   
            <OPTION VALUE="2209">2209
            </OPTION>   
            <OPTION VALUE="2210">2210
            </OPTION>   
            <OPTION VALUE="2301">2301
            </OPTION>   
            <OPTION VALUE="2302">2302
            </OPTION>   
            <OPTION VALUE="2303">2303
            </OPTION>   
            <OPTION VALUE="2304">2304
            </OPTION>   
            <OPTION VALUE="2305">2305
            </OPTION>   
            <OPTION VALUE="2306">2306
            </OPTION>   
            <OPTION VALUE="2307">2307
            </OPTION>   
            <OPTION VALUE="2308">2308
            </OPTION>   
            <OPTION VALUE="2309">2309
            </OPTION>   
            <OPTION VALUE="2310">2310
            </OPTION>   
            <OPTION VALUE="2403">2403
            </OPTION>   
            <OPTION VALUE="2404">2404
            </OPTION>   
            <OPTION VALUE="2405">2405
            </OPTION>   
            <OPTION VALUE="2406">2406
            </OPTION>   
            <OPTION VALUE="2407">2407
            </OPTION>   
            <OPTION VALUE="2408">2408
            </OPTION>   
            <OPTION VALUE="2409">2409
            </OPTION> 
            
            <OPTION VALUE="3102">3102
            </OPTION>
            <OPTION VALUE="3103">3103
            </OPTION> 
            <OPTION VALUE="3104">3104
            </OPTION> 
            <OPTION VALUE="3105">3105
            </OPTION> 
            <OPTION VALUE="3106">3106
            </OPTION> 
            <OPTION VALUE="3201">3201
            </OPTION> 
            <OPTION VALUE="3202">3202
            </OPTION> 
            <OPTION VALUE="3203">3203
            </OPTION> 
            <OPTION VALUE="3204">3204
            </OPTION> 
            <OPTION VALUE="3205">3205
            </OPTION> 
            <OPTION VALUE="3206">3206
            </OPTION>
            <OPTION VALUE="3207">3207
            </OPTION> 
            <OPTION VALUE="3301">3301
            </OPTION> 
            <OPTION VALUE="3302">3302
            </OPTION> 
            <OPTION VALUE="3303">3303
            </OPTION> 
            <OPTION VALUE="3304">3304
            </OPTION> 
            <OPTION VALUE="3305">3305
            </OPTION> 
            <OPTION VALUE="3306">3306
            </OPTION>
            <OPTION VALUE="3307">3307
            </OPTION>
            <OPTION VALUE="3308">3308
            </OPTION>  
            <OPTION VALUE="3309">3309
            </OPTION>  
            <OPTION VALUE="3401">3401
            </OPTION>  
            <OPTION VALUE="3402">3402
            </OPTION>
            <OPTION VALUE="3403">3403
            </OPTION>  
            <OPTION VALUE="3404">3404
            </OPTION>  
            <OPTION VALUE="3405">3405
            </OPTION>  
            <OPTION VALUE="3406">3406
            </OPTION>  
            <OPTION VALUE="3407">3407
            </OPTION>  
            <OPTION VALUE="3408">3408
            </OPTION>  
            <OPTION VALUE="3409">3409
            </OPTION>  
            <OPTION VALUE="3410">3410
            </OPTION>  
            <OPTION VALUE="4204">4204
            </OPTION>  
            <OPTION VALUE="4205">4205
            </OPTION>  
            <OPTION VALUE="4206">4206
            </OPTION>  
            <OPTION VALUE="4301">4301
            </OPTION>  
            <OPTION VALUE="4302">4302
            </OPTION>  
            <OPTION VALUE="4303">4303
            </OPTION>  
            <OPTION VALUE="4304">4304
            </OPTION>  
            <OPTION VALUE="4305">4305
            </OPTION>
            <OPTION VALUE="4306">4306
            </OPTION>
            <OPTION VALUE="4307">4307
            </OPTION>
            <OPTION VALUE="4401">4401
            </OPTION>
            <OPTION VALUE="4402">4402
            </OPTION>
            <OPTION VALUE="4403">4403
            </OPTION>
            <OPTION VALUE="4404">4404
            </OPTION>
            <OPTION VALUE="4405">4405
            </OPTION>
            <OPTION VALUE="4406">4406
            </OPTION>
            <OPTION VALUE="4407">4407
            </OPTION>                                                       
          </SELECT>  
        </div>              

        
        <div id="lasunto">   
          <label for="asunto" id="asunto">Asunto
          </label>   
                  <input type="text" value="" id="asunto" name="asunto" value="<?php if (isset($_POST['asunto'])){ $asunto=$_POST['asunto']; echo "$asunto";}?>"> 
        </div>
        
        <div id="lcrn">   
          <label for="crn" id="crn">CRN
          </label>   
                  <input type="text" value="" id="crn" name="crn" > 
        </div>
        
        <div id="lfolio">   
          <label for="folio" id="folio">Folio
          </label>   
                  <input type="text" value="" id="folio" name="folio" > 
        </div>                   
                        
        <input type="submit" value="Buscar" id="Buscar" name="Buscar"> 
                  
      </form>
       </div>
      <div id="resultado">
      <center>
      <?php 
      error_reporting(0);
      if($_POST['Buscar']){
$link = @mysql_connect("localhost", "root","") or die ("Error al conectar a la base de datos.");
@mysql_select_db("salones", $link) or die ("Error al conectar a la base de datos.");
echo "</br>";

 
 //$folio=$_POST['folio'];
 $folio=$_POST['folio'];
 $salon=$_POST['salon'];
 $fecha=$_POST['fecha'];
 $crn=$_POST['crn'];
 $asunto=$_POST['asunto'];



if ( (!empty($fecha)) && (!empty($salon)) && (!empty($asunto)) && (!empty($crn))){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where idSalon='$salon' and  fecha='$fecha' and asunto LIKE  '%$asunto%' and crn='$crn'";
  
    $result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();
  
  
  
} 

else if ( (!empty($fecha)) && (empty($salon)) && (empty($asunto)) && (empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where fecha='$fecha' ";

$result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}

else if ( (empty($fecha)) && (!empty($salon)) && (empty($asunto)) && (empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where idSalon='$salon' ";


     $result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();



}

else if ( (empty($fecha)) && (empty($salon)) && (!empty($asunto)) && (empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where  asunto LIKE  '%$asunto%' ";


     $result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();



}


else if ( (empty($fecha)) && (empty($salon)) && (empty($asunto)) && (!empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where crn='$crn' ";

$result = mysql_query($query);
echo "<center><table border=1>
<br>  
</tr>
<th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();


}

 else if ( (!empty($fecha)) && (!empty($salon)) && (empty($asunto)) && (empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where fecha='$fecha' and idSalon='$salon' ";

$result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}

 else if ( (!empty($fecha)) && (empty($salon)) && (!empty($asunto)) && (empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where fecha='$fecha' and asunto LIKE  '%$asunto%' ";

$result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}


 else if ( (!empty($fecha)) && (empty($salon)) && (empty($asunto)) && (!empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where fecha='$fecha' and crn='$crn' ";

$result = mysql_query($query);
echo "<center><table border=1>
 

 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){ ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>
   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}

 else if ( (empty($fecha)) && (!empty($salon)) && (!empty($asunto)) && (empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where idSalon='$salon' and asunto LIKE  '%$asunto%' ";

$result = mysql_query($query);
echo "<center><table border=1>


 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>

<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}


 else if ( (empty($fecha)) && (!empty($salon)) && (empty($asunto)) && (!empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where idSalon='$salon' and crn='$crn' ";

$result = mysql_query($query);
echo "<center><table border=1>

 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)) {?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>
   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
  }
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}


 else if ( (empty($fecha)) && (empty($salon)) && (!empty($asunto)) && (!empty($crn))   ){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where crn='$crn' and asunto LIKE  '%$asunto%' ";

$result = mysql_query($query);
echo "<center><table border=1>
 

 <br>
 <tr>
 <th align=center><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)) { ?>
<tr>
<td>
<a href="borrar_unico.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false; location.refresh();" ><img src="error.png"></a>
</td>
 
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}


 else if (!empty($folio)){
$query = "SELECT folio, idSalon, fecha, horaini, horafin,asunto,crn, tipo  FROM apartados where folio='$folio'";

$result = mysql_query($query);
echo "<center><table border=1>
 

 <br>
 <tr>
 <th align=center><b></b></td><th><b></b></td><th><b>Folio</b></td><th><b>Salon</b></td><th><b>Fecha</b></td><th><b>Hora Inicio</b></td><th><b>Hora Final</b></td><th><b>Asunto</b></td><th><b>Crn</b></td><th><b>Tipo</b></td>
</tr>";
while($row = mysql_fetch_array($result)){   ?>
<tr>
<td>
<a href="borrar_todos.php?folio=<?php echo $row[0];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=170,scrollbars=No'); return false; location.refresh();">All</a>
</td>
<td>
<a href="borrar.php?folio=<?php echo $row[0];?>&fecha=<?php echo $row[2];?>&salon=<?php echo $row[1];?>&horaini=<?php echo $row[3];?>&horafin=<?php echo $row[4];?>" target="popup" onClick="window.open(this.href, this.target, 'width=320,height=195,scrollbars=No'); return false;" ><img src="error.png"></a>
</td>
   
<td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[5]; ?></td><td><?php echo $row[6];?> </td><td><?php echo $row[7]; ?> </td>
 
  </tr>
  <?php
}
 echo" </table></center>
  </td></tr></table></center><br><br><br><br><br><br><br><br>";

  exit();

}

      } 
      ?>
      </center>
      </div>

               
      <!-- <article id="historia">

               </article>-->       
    </section>      
    <footer>          Creado Por Tecnologico Monterrey    &copy;Copyright - All Rights Reserved       
    </footer>   
  </body>
</html>