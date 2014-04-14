<?php 
session_start();
if(isset($_SESSION['login_user'])){ ?>

<div class="row-fluid">
	<div class="col-lg-2"></div>
    
    <div class="col-lg-6">
    	<div><p class="text-left">Selecciona un tema creado para agregarle las actividades, preguntas o intrucciones que desees.</p></div>
        	<form id="addAnswer" method="post" role="form" >
            <fieldset>
                <input type="hidden" id="id" name="id" value="-1"/>
                
                <div class="form-group">
                <label for="groupId" class="text-justify">Tema</label>
                <select id="groupId" name="groupId" required>
                	<option value="">Selecciona el Tema</option>
                </select>
                </div>

                <div class="form-group">
                <label for="answer" class="text-justify">Pregunta</label>
                <input type="text" name="answer" id="answer" placeholder="Pregunta o Instrucción" class="form-control" required/>
                </div>
                
                <div>
                <p class="text-left">Puedes poner solo una respuesta correcta en caso de preguntas abiertas o poner opciones múltiples
                y también si es un reto poner si y no para verficar que se cumpla.</p>
                </div>
                
                <div class="form-group">
                <label for="r1" class="col-sm-4 control-label">Respuesta:</label>
                <div class="col-xs-8">
                <input type="text" name="r1" id="r-1" placeholder="Primera respuesta" class="form-control" required/>
                </div>
                </div>
                
                <div class="form-group">
                <label for="r2" class="col-sm-4 control-label">Respuesta:</label>
                <div class="col-xs-8">
                <input type="text" name="r2" id="r-2" placeholder="Segunda respuesta" class="form-control" />
                </div>
                </div>
                
                <div class="form-group">
                <label for="r3" class="col-sm-4 control-label">Respuesta:</label>
                <div class="col-xs-8">
                <input type="text" name="r3" id="r-3" placeholder="Tercera respuesta" class="form-control" />
                </div>
                </div>
                
                <div class="form-group">
                <label for="r4" class="col-sm-4 control-label">Respuesta:</label>
                <div class="col-xs-8">
                <input type="text" name="r4" id="r-4" placeholder="Cuarta respuesta" class="form-control" />
                </div>
                </div>
                <div>
                
                <p class="text-left">Respuesta correcta es la cual validará si dar los puntos ó no al equipo.</p>
                </div>
                <div class="form-group">
                <label for="correctAnswer">Respuesta Correcta</label>
                <select name="correctAnswer" id="correctAnswer" required>
                	<option value="">Selecciona la Respuesta</option>
                </select>
                </div>
                
                <div class="form-group">
                <label for="typeAnswer" class="col-sm-4 control-label">Tipo:</label>
                <div class="col-xs-8">
                	<select name="typeAnswer" id="typeAnswer" required class="form-control">
                    	<option value="">Selecciona que tipo de actividad es</option>
                        <option value="RETO">RETO</option>
                        <option value="PREGUNTA">PREGUNTA</option>
                        <option value="INSTRUCCION">INSTRUCCIÓN</option>
                    </select>
                </div>
                </div>
                <div class="form-group">
                <label for="points" class="col-sm-4 control-label">Valor:</label>
                <div class="col-xs-8">
                <input type="numeric" name="points" id="points" placeholder="Puntos" class="form-control" />
                </div>
                </div>
               </fieldset>
               <fieldset>
                <button type="submit" class="btn btn-default" >Guardar</button>
                <button type="reset" class="btn btn-default" >Limpiar</button>
				</fieldset>
                
            </form>
    </div>
    <div class="col-lg-4">
    	<table class="table table-bordered table-hover">
        	<thead>
            	<tr>
                	<th>#</th>
                    <th>Pregunta</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div id="msgbox" title="Eductronic"></div>
<script>
var subscriberId="<?php echo $_SESSION['login_user']['id'] ?>"
var token="<?php echo $_SESSION['login_user']['accessToken'] ?>"
Control.getService(urlApi+"subscribers/"+subscriberId+"/groups/",token);	
		$("#msgbox").dialog({
			autoOpen:false,
			modal:true,
			resizable:false,
			show:{
				effect:"clip",
				duration:500	
			},
			buttons:{
				"OK":function(){
					$(this).dialog("close");
				}
			}
		});
		
		window.setTimeout(function(){
			$.each(temp,function(index,tema){
				$("#groupId").append("<option value='"+tema.id+"' >"+tema.topic+"</option>");
			});
		},500);

		$("#correctAnswer").on("focusin",function(){
			$("#correctAnswer").html("<option value=''>Selecciona la Respuesta</option>");
			$.each($("[id*='r-']"),function(index,resp){
				if(resp.value!=""){
				$("#correctAnswer").append("<option value='"+resp.value+"'>"+resp.value+"</option>");
				}			
			});
		});
		
		$("#addAnswer").on("submit",function(event){
			event.preventDefault();
			var data=Control.CreatJsonFromForm("addAnswer");
			$.ajax({
				type:"POST",
				data:data,
				headers: {"Authorization":"Token "+token},
				url:urlApi+"groups/"+$("#groupId").val()+"/answers/",
				crossDomain:true,
				success:function(response){
					if(response > 0){
					msgbox("La pregunta fue añadida");	
					limpiar();
					}
					else
					{
						if(response==-2)				
							msgbox("Pregunta Repetida");
					}
				},
				error:function(err){
					msgbox("error "+err.status+" "+err.description);
				}
			});
		});
	
	function limpiar(){
		$("#addAnswer input[type='text'],select,input[type='numeric']").val("");	
	}
	
	function msgbox(mensaje){
		$("#msgbox").html(mensaje);
		$("#msgbox").dialog("open");
	}
	
	$("#groupId").on("change",function(){
		Control.showAnswerinTable();
	});
</script>

<?php } ?>

