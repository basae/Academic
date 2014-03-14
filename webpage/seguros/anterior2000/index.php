<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="images/CoolWater.css" type="text/css" />
<?php session_start(); ?>
<title>Soc. Coop.</title>
	
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
	<!--header -->
	<div id="header">
    <h1 id="logo-text"> <a href="index.php">Sociedad Cooperativa de Autotransporte<br /> del Mpio Cd Y Pto de Coatzacoalcos, Ver, S.C.L.</a>
    </h1>
  <p id="slogan"> Av. Principal No. 100 Col. Transportistas<br/>Tel. 921 21 83162<br/>Correos: soccoop_sistemabea@hotmail.com,&nbsp;    soccoop_accidentes@hotmail.com </p>
	</div>
		
	<!-- navigation -->	
	<div  id="menu">
     <?php  
	  if( (isset($_SESSION['user']))&&($_SESSION['user']=='master')){
	  ?>
	  <ul>
			<li id="current"><a href="index.php">Inicio</a></li>
            <li><a href="sociosm.php">Clientes</a></li>
            <li><a href="unidadesm.php">Unidades</a></li>
            <li><a href="polizasm.php">Polizas</a></li>
		</ul>
        <?php } 
        if( (isset($_SESSION['user']))&&($_SESSION['user']=='user')){
	  ?>
       <ul>
			<li id="current"><a href="index.php">Inicio</a></li>
            <li><a href="polizasm.php">Polizas</a></li>
		</ul>
      
      <?php } ?>
	</div>					
			
	<!-- content-wrap starts here -->
  <div id="content-wrap">
		
		<div id="main">
        <?php 
		if(!isset($_SESSION['user'])){ ?>		
        	<h3>Importante!!</h3>			
			<blockquote><p>Para tener acceso a las polizas por favor ingresa con el usuario que te fue asignado por el administrador</p></blockquote>
			<a name="TemplateInfo"></a>
			<h3>Ingreso de Usuarios</h3>
            <form name="login" action="login.php" method="post">
            <p>
  <label>Usuario:</label>
  <span id="sprytextfield1">
      <input type="text" name="usuario" id="usuario" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <label>Contraseña:</label>
    <span id="sprypassword1">
      <input name="pass" type="password" id="pass" />
      <span class="passwordRequiredMsg">Se necesita un valor.</span></span><br/><br />
 
    <input class="button" type="submit" name="login2" id="login2" value="Iniciar Sesi&oacute;n" />&nbsp;&nbsp;
      <input class="button" type="reset" name="limpiar" id="limpiar" value="Limpiar" /></p>
  </form>				
<?php } 
else {
?>
<blockquote><p>Gracias por Ingresar en la parte superior aparecerán los menús que tienes disponibles</p></blockquote>
<p>
<iframe name="contenedor" src="gale/index.html" width="86.4%" height="299px" frameborder="0"></iframe>
</p>
<?php } ?>											
		
		</div>
		
	
	<div id="sidebar">
    <?php
	if(isset($_SESSION['user'])){ ?>
    	<ul class="sidemenu">
        	<li><a href="logout.php">Cerrar Sesi&oacute;n</a>
        </ul>
		<?php } ?>
  
    </div>
	<!-- content-wrap ends here -->	
	</div>
					
	<!--footer starts here-->
	<div id="footer">
			
		<p>
	  &copy; 2012 <strong>Dise&ntilde;o y Creación de Sistemas informáticos y páginas WEB   contacto soccoop_sistemabea@hotmail.com </p>
</div>	

<!-- wrap ends here -->
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1");
</script>
</body>
</html>
