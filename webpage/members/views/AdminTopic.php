<?php 
session_start();
if(isset($_SESSION['login_user'])){ ?>
<script>
$("#div-form-edit-topic").dialog({
	autoOpen:false,
	modal:true,
	width:350,
	height:'auto',
	show:{
		effect:"clip",
		duration:500	
	}
});
var subscriberId="<?php echo $_SESSION['login_user']['id'] ?>"
var token="<?php echo $_SESSION['login_user']['accessToken'] ?>"
Control.getService(urlApi+"subscribers/"+subscriberId+"/groups/",token);
window.setTimeout(function(){
	$("#general_container > div > div.col-lg-8 > table > tbody").html("");
	$.each(temp,function(index,topic){
		$("#general_container > div > div.col-lg-8 > table > tbody").append("<tr><td><p class='text-left'>"+topic.topic+"</p></td><td class='col-sm-2'><p class='text-center'><button class='btn btn-success btn-sm' ='edit' id='"+topic.id+"'>Editar</button>&nbsp;<button class='btn btn-danger btn-sm' id='delete-"+topic.id+"'>Eliminar</button></p></td></tr>");		
	});
	$("#general_container > div > div.col-lg-8 > table > tbody > tr > td.col-sm-2 > p > button:first-child").on("click",function(){
		$("#div-form-edit-topic").dialog("open");
		$("#id").val($(this).attr("id"));
		$("#topic").val($(this).parent().parent().parent().children("td:eq(0)").text());		
	});
},300);
$("#edit-topic").on("submit",function(){
var test=Control.CreatJsonFromForm("edit-topic");
		event.preventDefault();
		$.ajax({
			type:"POST",
			data:test,
			headers: {"Authorization":"Token "+token},
			url:urlApi+"subscribers/"+subscriberId+"/groups/",
			crossDomain:true,
			success:function(response){
				if(response > 0){
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
}
</script>
<div class="row-fluid">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
    	<table class="table table-bordered table-hover table-condensed">
        	<thead>
            	<tr>
                	<th>Nombre</th><th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-lg-2"></div>
</div>

<div title="Editar" id="div-form-edit-topic">
	<form role="form" name="edit-topic" id="edit-topic">
    	<input type="hidden" name="id" id="id" value="0" />
        <div class="form-group">
        	<label for="topic">Nombre</label>
            <input type="text" name="topic" id="topic" placeholder="Nombre del tema" required class="form-control" />
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>

    </form>
</div>
<?php } ?>