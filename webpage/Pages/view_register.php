<?php
$content='
<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="row">
<div class="col-lg-2"></div>
<div class="col-lg-8">
	<p>Llena los campos correspondientes para tu registro, y de esta manera poder empezar a utilizar academic</p>
</div>
<div class="col-lg-2"></div>
</div>
<form id="newRegister_form" class="form-horizontal">
<fieldset>
		<div class="form-group">
			<label for="username" class="col-sm-4 control-label">Nombre de Usuario:</label>
			<div class="col-xs-5">
			<input name="username" id="username" type="text" class="form-control" required placeholder="usuario" />
			</div>
		</div>
		
		<div class="form-group">
			<label for="password" class="col-sm-4 control-label">Contraseña:</label>
			<div class="col-xs-5">
			<input name="password" id="password" type="password" class="form-control" required placeholder="contraseña" />
			</div>
		</div>
		
		<div class="form-group">
			<label for="confirm" class="col-sm-4 control-label">Repetir contraseña:</label>
			<div class="col-xs-5">
			<input name="confirm" id="confirm" type="password" class="form-control" required placeholder="repetir contraseña" />
			</div>
		</div>
</fieldset>

<fieldset>
		<div class="form-group">
			<label for="firstname" class="col-sm-4 control-label">Nombre:</label>
			<div class="col-xs-5">
			<input name="firstname" id="firstname" type="text" class="form-control" required placeholder="nombre" />
			</div>
		</div>
		
		<div class="form-group">
			<label for="lastname" class="col-sm-4 control-label">Apellidos:</label>
			<div class="col-xs-5">
			<input name="lastname" id="lastname" type="text" class="form-control" required placeholder="apellidos" />
			</div>
		</div>
		
		<div class="form-group">
			<label for="email" class="col-sm-4 control-label">Correo:</label>
			<div class="col-xs-5">
			<input name="email" id="email" type="email" class="form-control" required placeholder="correo electronico" />
			</div>
		</div>
</fieldset>
<fieldset>
	<input type="submit" name="register_save" id="register_save" value="Confirmar" class="btn btn-default" />
	<input type="reset" name="register_clean" id="register_clean" value="Limpiar" class="btn btn-default" />
</fieldset>

	</form>
</div>
<div class="col-lg-2"></div>
</div>
';
echo $content;

?>