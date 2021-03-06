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
<form id="newRegister_form" class="form-horizontal" method="post">
<input name="id", id="id" type="hidden" value="-1" />
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
			<label for="confirm" class="col-sm-4 control-label">Contraseña:</label>
			<div class="col-xs-5">
			<input name="confirm" id="confirm" type="password" class="form-control" required placeholder="contraseña" />
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
		
		<div class="form-group">
			<label for="school" class="col-sm-4 control-label">Escuela:</label>
			<div class="col-xs-5">
			<input name="school" id="school" type="test" class="form-control" required placeholder="escuela" />
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
<div id="msgbox" title="Eductronic"></div>
<script>
$("#newRegister_form").submit(function(event){
		event.preventDefault();
	if($("#username").val().split(" ").length>1)
	{
		msgbox("Tu nombre de usuario no puede contener espacios en blanco");
		return false;
	}
	if($("#confirm").val()!=$("#password").val())
	{
		msgbox("La contraseña y la confirmación son diferentes!!!");
		return false;	
	}
		var dataForm={
		id:parseInt($("#id").val()),
		username:$("#username").val(),
		password:$("#password").val(),
		firstname:$("#firstname").val(),
		lastname:$("#lastname").val(),
		school:$("#school").val(),
		email:$("#email").val()
		};
		var parseData=JSON.stringify(dataForm);
		$.ajax({
			type:"POST",
			data:dataForm,
			url:urlApi+"subscriberx/",
			crossDomain:true,
			success:function(response){
				if(response > 0){
				msgbox("has sido registrado inicia sessión");
				location.href="index.php";	
				}
				else
				{
					if(response==-2)				
						msgbox("email registrado");	
				}
			},
			error:function(err){
				msgbox(err.status+" "+err.exception);
			}
		});
		return false;
	});
	
	function msgbox(mensaje){
		$("#msgbox").html(mensaje);
		$("#msgbox").dialog("open");
	}
	
	$("#msgbox").dialog({
			autoOpen:false,
			modal:true,
			resizable:false,
			show:{
				effect:"clip",
				duration:500	
			},
			buttons:{
				"Ok":function(){
					$(this).dialog("close");
				}
			}
		});
</script>
