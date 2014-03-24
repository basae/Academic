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

$("#msgbox").dialog({
	autoOpen:false,
	modal:true,
	width:350,
	height:'auto',
	show:{
		effect:"clip",
		duration:500	
	}
});

$("#confirmation").dialog({
	autoOpen:false,
	modal:true,
	width:350,
	height:'auto',
	show:{
		effect:"clip",
		duration:500	
	},
	buttons:{
		"Si":function(){
			
		},
		"No":function(){
			
		}
	}
});

function msgbox(mensaje){
	$("#msgbox").html(mensaje)
	$("#msgbox").dialog("open");
};

function refreshTable(){
Control.getService(urlApi+"subscribers/"+subscriberId+"/groups/",token);
window.setTimeout(function(){
	$("#general_container > div > div.col-lg-8 > table > tbody").html("");
	$.each(temp,function(index,topic){
		$("#general_container > div > div.col-lg-8 > table > tbody").append("<tr><td class='col-sm-8'><p class='text-left'>"+topic.topic+"</p></td><td class='col-sm-4'><p class='text-center'><button class='btn btn-success btn-sm' ='edit' id='"+topic.id+"'>Editar</button>&nbsp;<button class='btn btn-danger btn-sm' id='delete-"+topic.id+"'>Eliminar</button></p></td></tr>");		
	});
},300);
window.setTimeout(function(){
$("#general_container > div > div.col-lg-8 > table > tbody > tr > td.col-sm-4 > p > button:first-child").on("click",function(){
	$("#div-form-edit-topic").dialog("open");
	$("#id").val($(this).attr("id"));
	$("#topic").val($(this).parent().parent().parent().children("td:eq(0)").text());		
	});
},400);
};
refreshTable();

$("#edit-topic-form").on("submit",function(event){
event.preventDefault();
var test="";
test=Control.CreatJsonFromForm("edit-topic-form");
		$.ajax({
			type:"POST",
			data:test,
			headers: {"Authorization":"Token "+token},
			url:urlApi+"subscribers/"+subscriberId+"/groups/",
			crossDomain:true,
			success:function(response){
				refreshTable();
				$("#div-form-edit-topic").dialog("close");				
			},
			error:function(err){
				alert("error "+err.status+" "+err.exception);
			}
		});
});