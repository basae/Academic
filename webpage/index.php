<?php 	session_start(); ?>
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
<script type="text/javascript" src="Javascripts/customScript.js"></script>
<script type="text/javascript" src="Javascripts/jquery-ui-1.10.4.custom.js"></script>

<title>Edutronic</title>
</head>
<div class="container-fluid">
	<div class="row">
   	<div class="col-md-1"></div>
    <div class="col-md-9">
        <header>
        	
        </header>
        
        <nav>
        	<div class="row">
            	<div class="col-lg-9">
                    <ul class="nav nav-tabs">
                    <li><a id="menu1">¿Quienes somos?</a></li>
                    <li><a id ="menu2">¿Que es Academic?</a></li>
                    <li><a id ="menu3">Contribuir</a></li>
                    <li>
                        <li class="dropdown" id="menu4">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Miembros<span class="caret"></span>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:Control.showLogin()">inicio de Sessión</a></li>
                            </ul>
                        </li>
                    </li>
                    <?php
					if(!isset($_SESSION['login_user'])){ ?>
                    <li><a id="menu5">Registrarme!!</a></li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="col-lg-3">
                <?php 
				if(isset($_SESSION["login_user"]))
				{ ?>
                    <p><strong>Bienvenido</strong>,<?php echo $_SESSION["login_user"]["name"] ?></p>
                    <p><a href="Controls/close_session.php">Cerrar Sessión</a>&nbsp;&nbsp;&nbsp;<a id="user_edit">Editar perfil</a></p>
                <?php } ?>
                </div>
            </div>
        </nav>
        <article id="general_container">
        
        </article>
        
        <footer>
        </footer>
        </div>
   	<div class="col-md-2"></div>
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
    </form>
</div>

<body>
</body>
</html>
