<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Style area -->
<link rel="stylesheet" href="Content/css/bootstrap.css" media="screen" />
<link rel="stylesheet" href="Content/css/customCss.css" media="screen" />
<link rel="stylesheet" href="Content/css/jquery-ui-1.10.4.custom.css" media="screen" />

<!-- Script area -->
<script type="text/javascript" src="Javascripts/jquery 1.11.js"></script>
<script type="text/javascript" src="Javascripts/bootstrap.js"></script>
<script type="text/javascript" src="Javascripts/Edutronic.Controls.js"></script>
<script type="text/javascript" src="Javascripts/customScript.js"></script>

<script type="text/javascript" src="Javascripts/jquery-ui-1.10.4.custom.js"></script>

<title>Eductronic</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
   	<div class="col-md-1"></div>
    <div class="col-md-10">
        <header>
        	<div class="row" >
            	<div class="col-md-6">
	        	<img src="Content/images/1.2.png"/>
                </div>
                <div class="col-md-2">
                <p class="text-center">
                <a href="javascript:Control.changeMenu('menu5')">Registrarme</a>
                </p>
                </div>
                <div class="col-md-4">
                	
                </div>
            </div>
        </header>
        
        <nav>
        	<div class="row-fluid">
            	<div class="col-md-12">
                    <ul class="nav nav-tabs">
                    <li><a id="aboutus">¿Quienes somos?</a></li>
                    <li><a id ="whoare">¿Que es Eductronic?</a></li>
                    <li><a id ="menu3">Contribuir</a></li>
                    <li><a href="javascript:Control.showLogin()">Iniciar Sessión</a></li>
                    <li><a id="contactUs">Contacto</a></li>
                    </ul>
                </div>
                
            </div>
        </nav>
        <article id="general_container">
        	<img src="Content/images/inicio.jpg" usemap="#inicio" />
            <div id="click_registro"><a href="javascript:Control.changeMenu('menu5')"></a></div>
            <div id="facebook_click"><a href="https://www.facebook.com/Eductronic"></a></div>
        </article>
        
        <footer>
        </footer>
        </div>
   	<div class="col-md-1"></div>
    </div>
</div>

<div id="form-login" title="Inicio de Sessión">
	<form id="login" rol="form" class="form-horizontal">
		<div class="form-group">
        	<label for="txt-username" class="col-sm-4 control-label">Usuario</label>
            <div class="col-sm-7">
            <input type="text" id="txt-username" placeholder="usuario.." required class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label for="txt-password" class="col-sm-4 control-label">Contraseña</label>
            <div class="col-sm-7">
            <input type="password" id="txt-password" placeholder="contraseña" required class="form-control" />
            </div>
        </div>
        <button type="submit" id="enviar" class="btn btn-primary">OK</button>
        <button type="reset" id="limpiar" class="btn btn-default">Cancelar</button>
    </form>
</div>
</body>
</html>
