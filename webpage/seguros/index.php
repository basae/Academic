<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap/css/bootstrap.css" media="screen" />
<title>Tramite y Solucíon S.C.</title>
<?php session_start() ?>
<script src="jquery-ui/jquery 1.11.js"></script>
<script language="javascript" src="sonidos.js" type="text/javascript"></script>
<script language="javascript" src="Contenido/Javascript/CustomScript.js" type="text/javascript"></script>
</head>

<body>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
            <div id="menu">
              <table>
                <tr>
                    <th><a href="index.php" onMouseOver="mouseoversound.playclip()" onClick="clicksound.playclip()">Inicio</a></th>
                    <?php if((isset($_SESSION['user']))&&($_SESSION['user']=="master")){  ?>
                    <th><a href="menu.php?id=Clientes" target="contmenu" onMouseOver="mouseoversound.playclip()" onClick="clicksound.playclip()">Clientes</a></th>
        
                    <th><a href="menu.php?id=Unidades" target="contmenu" onMouseOver="mouseoversound.playclip()" onClick="clicksound.playclip()">Unidades</a></th>
                    <?php } ?>
                     <?php if((isset($_SESSION['user']))&&(($_SESSION['user']=="master")||($_SESSION['user']=="user"))){  ?>
                    <th><a href="menu.php?id=Polizas" target="contmenu" onMouseOver="mouseoversound.playclip()" onClick="clicksound.playclip()">Polizas</a></th>
                    <?php } ?>
                </tr>
              </table>
            </div>
        </div>
        <div class="span2"></div>
    </div>
    
    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
            <div class="row-fluid">
                <div class="span12">
                    <div id="header-panel">
                            <img src="ENCABEZADO2.png" width="100%" height="100%" />
                            <div id="imagenLogo">
                                <object classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000" codebase=			"http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=10,1,1,0" width="180" height="160" align="middle">
                                <param name="src" value="Galeria_Escena1.swf" />
                                <param name="quality" value="high" />
                                <param name="wmode" value="transparent" />
                                <embed src="Galeria_Escena1.swf" width="180" height="160" pluginspage="http://www.adobe.com/shockwave/download/" align="middle" wmode="transparent"></embed>
                                </object>
                            </div>            
                   </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span3">
                    <div id="submenu">
                        <iframe name="contmenu" src="menu.php?id=Inicio" width="100%" height="100%" frameborder="0"></iframe>
                   </div>
                </div>
                <div class="span9">
                    <div id="contenido">
                        <iframe name="contenido" src="inicio.php" width="100%" height="100%" frameborder="0"></iframe>
                    </div>
        
                </div>    	
            </div>
        </div>
        <div class="span2"></div>
    </div>
</div>
</body>
</html>