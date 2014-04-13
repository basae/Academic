<?php session_start(); 
if(isset($_SESSION['login_user'])){
?>
<div class="row-fluid">
	<div class="col-lg-2"></div>
    
    <div class="col-lg-8">
    	<div><p class="text-justify">crea tu tema para poder añadirle los retos,preguntas o actividades que desees</p></div>
        <div>
        	<form id="newTopic" method="post" role="form" class="form-horizontal">
            <div class="form-group">
                <input type="hidden" id="id" name="id" value="-1"/>
                </div>
                <div class="form-group">
                <label for="topic" class="col-xs-4 control-label">Nombre del Tema:</label>
                <div class="col-xs-5">
                <input type="text" name="topic" id="topic" placeholder="Nombre del tema" class="form-control" required/>
                </div>
                </div>
                
                <div class="form-group">
                <label for="dificultyGrade" class="col-xs-4 control-label">Dificultad:</label>
                <div class="col-xs-5">
                <p class="text-left">
                <select name="dificultyGrade" id="dificultyGrade" class="form-control" required>
                	<option value="">Selecciona un Nivel</option>
                    <option value="BASICO">Nivel Basico</option>
                    <option value="MEDIO">Nivel Medio</option>
                    <option value="SUPERIOR">Nivel Superior</option>
                    
                </select>
                </p>
                </div>
                </div>
                <div>
	                <p class="text-center">
                	<input type="submit" name="save" id="guardar" value="Guardar" class="btn">
                    </p>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>

<script>
var subscriberId="<?php echo $_SESSION['login_user']['id'] ?>";

var secureToken="<?php echo $_SESSION['login_user']['accessToken'] ?>";
$(function(){
	$("#newTopic").on("submit",function(event){
		
		var test=Control.CreatJsonFromForm("newTopic");
		event.preventDefault();
		$.ajax({
			type:"POST",
			data:test,
			headers: {"Authorization":"Token "+secureToken},
			url:urlApi+"subscribers/"+subscriberId+"/groups/",
			crossDomain:true,
			success:function(response){
				if(response > 0){
				alert("Grupo Creado");
				location.href="index.php";	
				}
				else
				{
					if(response==-2)				
						alert("email registrado");	
				}
			},
			error:function(err){
				alert("error "+err.status+" "+err.exception);
			}
		});

	});
});
</script>
<?php } ?>