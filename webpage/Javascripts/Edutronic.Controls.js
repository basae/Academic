var urlApi;
var temp;
var html5_audiotypes={ //define list of audio file extensions and their associated audio types. Add to it if your specified audio file isn't on this list:
	"mp3": "audio/mpeg",
	"mp4": "audio/mp4",
	"ogg": "audio/ogg",
	"wav": "audio/wav"
}

var WebControl=function(){


var init=function(){
	$.getJSON("http://jsonip.com?callback=?", function (data) {
		var url
		if(data.ip=="187.172.225.253")
			url="../configuration2.xml";
		else
			url="../configuration.xml"
		$.ajax({
			type: "GET",
			url: url,
			dataType:"xml",            
			success: function (response) {
				$(response).find("apiUrl").each(function() {
				   urlApi=$(this).find("url").text();
				});
			},
			error:function(err){
				alert(err.description);
			}
		});
	
	});
}

var openFormLogin=function(){
	$("#form-login").dialog("open");
};

//change class attribute where menu is selected
var selectedMenu=function(menu){
	$("header + nav > div > div:first-child > ul > li").removeClass("active");
	$("#"+menu).parent().parent().parent().addClass("active");
	openViews(menu);	
}


//send request to api for login user
var GotoLogin=function(usernamex,passwordx){
	
	var parseJson={
		username:usernamex,
		password:passwordx
		};
	
	$.ajax({
		type:"POST",
		data:parseJson,
		dataType:"json",
		crossDomain:true,
		url:urlApi+"tokens/",
		success:function(done){
			createPhpSession(done);
		},
		beforeSend:function(){
		},
		error:function(e){
			alert(e.status);
		}
	});
};

function createPhpSession(user){
	$.ajax({
		type:"POST",
		url:"../Controls/create_session.php",
		data:"user="+JSON.stringify(user),
		success:function(done){
			if(done=="done"){
				location.href="../members/index.php";
			}
		},
		error:function(){
			alert("error");	
		}
	});
};

function openViews(menu){
switch(menu){
	
case "whoare":
			$.ajax({
				type:"POST",
				url:"../Pages/whoare.php",
				data:"",
				success: function(response){
				$("#general_container").html(response);
				},
				error: function(){
					alert("ha ocurrido un error, intentalo de nuevo");	
				}
			});
	break
	
case "contactUs":
	$.ajax({
				type:"POST",
				url:"../Pages/contactUs.php",
				data:"",
				success: function(response){
				$("#general_container").html(response);
				},
				error: function(){
					alert("ha ocurrido un error, intentalo de nuevo");	
				}
			});
break;
	
case "aboutus":
			$.ajax({
				type:"POST",
				url:"../Pages/aboutus.php",
				data:"",
				success: function(response){
				$("#general_container").html(response);
				},
				error: function(){
					alert("ha ocurrido un error, intentalo de nuevo");	
				}
			});
	break;
	
case "menu5":
			$.ajax({
				type:"POST",
				url:"../Pages/view_register.php",
				data:"",
				success: function(response){
				$("#general_container").html(response);
				},
				error: function(){
					alert("ha ocurrido un error, intentalo de nuevo");	
				}
			});
	break;
	
case "NewTopic":
	$.ajax({
				type:"POST",
				url:"../members/views/NewTopic.php",
				data:"",
				success: function(response){
				$("#general_container").html(response);
				},
				error: function(){
					alert("ha ocurrido un error, intentalo de nuevo");	
				}
			});
	
default:
	if(typeof menu === 'undefined'){
		
		$("#general_container").html("");
	}
	else
	{
		$.ajax({
			type:"POST",
			url:"../members/views/"+menu+".php",
			data:"",
			success: function(response){
			$("#general_container").html(response);
			},
			error: function(){
				alert("ha ocurrido un error, intentalo de nuevo");	
			}
			});	
	}
break;
}
};

var PostService=function(data,url){
	var result;
	$.ajax({
		type:"POST",
		url:url,
		data:data,
		crossDomain:true,
		success: function(response){
				result=response;
		},
		error: function(err){
			result=err.status+" "+err.description;	
		}
	});
	return result;
};

function getService(url,token){
		$.ajax({
		type:"GET",
		async:false,
		headers: {"Authorization":"Token "+token},
		crossDomain:true,
		url:url,
		dataType:"json",
		success: function(response){
			temp=response;		
		},
		error: function(err){
		alert(err.status+" "+err.description);
		}
	});
};

var getPHPService=function(url1,url2,param){
	$.ajax({
		type:"GET",
		async:true,
		url:url1,
		dataType:"json",
		success: function(response){
			getService(url2+response.id,response.accessToken);
		},
		error: function(err){
		alert(err.status+" "+err.description);
		}
	});
};

var CreatJsonFromForm=function(form){
	result='{';

	$.each($("#"+form+" input[type='text'],input[type='numeric'],input[type='hidden'],select"),function(index,input){
		
			//result+="\""+ input.name +"\" :"+ ((input.type=="text")?("\""+input.value+"\""):(input.value))+",";
			result+="\""+ input.name +"\" :\""+ input.value+"\",";
			
		});
		return $.parseJSON(result.substr(0,result.length-1)+"}");
};


//control of game

var initGame=function(){
	$("#msgbox").dialog({
			autoOpen:false,
			modal:true,
			resizable:false,
			show:{
				effect:"clip",
				duration:500	
			},
			buttons:{
				Enter:function(){
					$(this).dialog("close");
				}
			},
			close:function(){
				rondas--;
					if(rondas==0){
						marcador="<table id='tablero-f' class='table table-bordered table-condensed'><thead><tr></tr></thead><tbody><tr></tr><tbody></table>"
						var temporal=-1;
						var ganadores=[];
						for(i=0;i<teams.length;i++){
						    if ((teams[i].puntos > temporal) && (teams[i].puntos != 0))
						    {
							    ganadores=[];
								ganadores.push(i);
								temporal=teams[i].puntos;
							}
							else
								if(teams[i].puntos==temporal)
									ganadores.push(i);
								
						}

						if(ganadores.length>1){
							var equipos;
							$.each(ganadores,function(index,team){
								equipos+=teams[team].team+",";
							});
								winners("<strong>Los Hubo un Empate entre los Equipos '"+equipos.substring(0,equipos.length-1)+"'</strong><br>"+marcador+"<br/><h5>Gracias por Jugar en Eductronic</h5><br/>");
						}
						else
							if(ganadores.length==1)
								winners("<strong>El Ganador es el equipo '"+teams[ganadores[0]].team+"'<br>"+marcador+"</strong><br/><h5>Gracias por Jugar en Eductronic</h5><br/>");
							else{
								winners("<strong>No Hubo Ganadores</stron><br>"+marcador+"<br/><h5>Gracias por Jugar en Eductronic</h5><br/>");	
							}
						marcadorFinal();
					}	
			}
		});
		
		$("#winners").dialog({
			autoOpen:false,
			modal:true,
			resizable:false,
			show:{
				effect:"drop",
				duration:1500	
			},
			buttons:{
				Enter:function(){
					$(this).dialog("close");	
									
				}
			},
			close:function(){
				openViews("newGame");
				$(this).dialog("close");	
			},
			minWidth:600,
			height:'auto'
		});
		
		$("#tablero_preguntas").dialog({
			autoOpen:false,
			modal:true,
			resizable:false,
			show:{
				effect:"clip",
				duration:500	
			},
			buttons:{
				Enter:function(){
					
					if(turno>=teams.length)
						turno=0;					
					if($("#respuesta").val()==resp_correct){
						teams[turno].puntos=parseInt(teams[turno].puntos)+parseInt(temp_points);
						msgbox("Excelente!!! <br/>se han sumado "+temp_points+" punto(s) al equipo '"+teams[turno].team+"'");
						resp_correct="";
					}
					else
					{
						if((resp_correct.toUpperCase()!="SI") && (resp_correct.toUpperCase()!="NO"))
							msgbox("La Respuesta correcta es:<br />'"+resp_correct+"' !!<br/>Suerte para la Proxima");
					}
					actualizarTablero();					
					turno++;
					
					if(turno>=teams.length){
						setTurno(0);
					}
					else
					{				
						setTurno(turno);
					}
					$(this).dialog("close");
				}
			},
		});
	
	
	
		window.setTimeout(function(){
			$.each(temp,function(index,tema){
				$("#tema").append("<option value='"+tema.id+"' >"+tema.topic+"</option>");
			});
		},300);
	$("#no_team").on("keyup",function(event){
		if(!isNaN($("#no_team").val())){
			$("#nameTeam").html("");
			for(i=0;i<parseInt($(this).val());i++)
			{
				$("#nameTeam").append("<div class='form-group'><label for='team"+i+"' class='col-sm-4 control-label'>Equipo #"+(i+1)+"</label><div class='col-xs-5'><input type='text' name='team"+i+"' id='team-"+i+"' class='form-control' required></div></div>");
			}
			$("#config > div:nth-child(2) > table > tbody > tr > td:nth-child(1)").text($("#no_team").val());
			team=$("#no_team").val();
		}
	});
	
	
	$("#cargar").on("click",function(){
		Control.getService(urlApi+"groups/"+$("#tema").val()+"/answers/",token);
		window.setTimeout(function(){
			$("#config > div:nth-child(2) > table > tbody > tr > td:nth-child(2)").text(temp.length);
			answers=temp;
			rondas=temp.length;
			$("#config > div:nth-child(2) > table > tbody > tr > td:nth-child(3)").text($("#tema > option:selected").text());
		},300);
	});
	
	$("#beginGame").on("click",function(){
		if((answers.length % team)!=0){
			msgbox("<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>No se puede Iniciar el juego<br />Deben ser suficientes preguntas para repartir a los equipos de manera equitativa!!");
		}
		else
		{
			var result="[";
			var c=0;
			$.each($("input[id*='team-']"),function(index,input){
				result+="{\"team\":\""+input.value+"\",\"puntos\":\"0\"},";
				c++;
			});
			teams=$.parseJSON(result.substr(0,result.length-1)+"]");
			beginGame();
		}
		$("#config").hide({effect:"blind",duration:500});
		$('#tablero').show({effect:"clip",duration:500});
	});
	
	function msgbox(mensaje){
		$("#msgbox").html(mensaje);
		$("#msgbox").dialog("open");
	}
	
	function winners(mensaje){
		sound.playclip();
		$("#winners > div > div:nth-child(2)").html(mensaje);
		$("#winners").dialog("open");
		$("#winners > div > div:nth-child(1) > img ").removeClass("hidden");
		
	}
	
	$(function() {
    $( "#acordion" ).accordion();
  	});
};

function marcadorFinal(){
	$("#tablero-f > table > thead > tr").html("<th>Equipo</th>");	
	$("#tablero-f > table > tbody > tr").html("<th>Puntos</th>");
$.each(teams,function(index,team){
	$("#tablero-f > thead > tr").append("<th><p class='text-center'>"+team.team+"</p></th>");	
		$("#tablero-f > tbody > tr").append("<th><p class='text-center'>"+team.puntos+"</p></th>");	
	});
}

function actualizarTablero(){
	
	$("#tablero > div:first-child > table > thead > tr").html("<th>Equipo</th>");	
	$("#tablero > div:first-child > table > tbody > tr").html("<th>Puntos</th>");
$.each(teams,function(index,team){
	$("#tablero > div:first-child > table > thead > tr").append("<th id='"+team.team+"'><div class='row-fluid'></div><div class='col-lg-12'><p class='text-center'>"+team.team+"</p><div></th>");	
		$("#tablero > div:first-child > table > tbody > tr").append("<th id='"+team.team+"'><p class='text-center'>"+team.puntos+"</p></th>");	
	});	
};

var beginGame=function(){
	turno=0;	
	actualizarTablero();
	var c=1;
	var arrays=[];
	var semilla=answers.length;
	$("#tablero > div:first-child+ div > table > tbody").html("");
	var ramdon
	for(i=0;i<(Math.round(Math.sqrt(answers.length)));i++){
		$("#tablero > div:first-child+ div > table > tbody").append("<tr></tr>");
		for(j=0;j<(Math.round(Math.sqrt(answers.length)))+1;j++){	
			ramdon=Math.floor(Math.random() * (semilla))
			if($.inArray(ramdon,arrays)!=-1){
				for(k=0;k<semilla;k++)
				{
					if($.inArray(k,arrays)==-1){
						ramdon=k;
						break;
					}
					
				}
			}
			if(c<=answers.length){
			arrays.push(ramdon);
			if($("#style").val()!="Predefinido"){
				var imagenes="";
				if(c<10){
				$("#tablero > div:first-child+ div > table > tbody > tr:last-child").append("<td class='active'><button id='"+ramdon+"' class='btn btn-info btn-block'><img src='../content/numeros_colores/"+c+".gif' /></button></td>")	
				}
				else
				{
					for(ch=0;ch<c.toString().length;ch++)
					{
							imagenes+="<img src='../content/numeros_colores/"+c.toString().charAt(ch)+".gif' />";
					}
					$("#tablero > div:first-child+ div > table > tbody > tr:last-child").append("<td class='active'><button id='"+ramdon+"' class='btn btn-info btn-block'>"+imagenes+"</button></td>")	
					
				}
			}
			else
			{
			$("#tablero > div:first-child+ div > table > tbody > tr:last-child").append("<td class='active'><button id='"+ramdon+"' class='btn btn-info btn-block'>"+c+"</button></td>")
			}
			c++;
			}
			else{
				$("#tablero > div:first-child+ div > table > tbody > tr:last-child").append("<td class='active'><button class='btn btn-default btn-block' disabled='disabled'>X</button></td>");
			}
		}
	switch($("#style").val()){
		case "Niño":
			$("#tablero").removeAttr("class");
			$("#tablero").addClass("children");
		break;
		Default:
			$("#tablero").removeAttr("class");
		break;
	};
	}
	setTurno(turno);
	$("#tablero > div > table > tbody > tr > td > button").on("click",function(event,input){
		$(this).attr("disabled","disabled");
		$(this).removeClass("btn-info");
		$(this).addClass("btn-default");
		$(this).text("X")
		//$(this).addClass("hidden");
		//$(this).parent().parent().removeClass("success");
		//$(this).parent().parent().addClass("danger");
		//$(this).html("<p class='text-center'>Respondida</p>")
		CreatAnswer(answers[$(this).attr("id")]);
	});	
}

function CreatAnswer(answer){
	var output;
	var responses="<ol>";
	if(answer.r1!="")
		responses+="<li><p class='text-left'><a>"+answer.r1+"</a></p></li>";
	if(answer.r2!="")
		responses+="<li><p class='text-left'><a>"+answer.r2+"</a></p></li>";
	if(answer.r3!="")
		responses+="<li><p class='text-left'><a>"+answer.r3+"</a></p></li>";
	if(answer.r4!="")
		responses+="<li><p class='text-left'><a>"+answer.r4+"</a></p></li>";
	responses+="</ol>"
	output='<div class="row-fluid"><p class="text-center">'+answer.typeAnswer+'</p><p class="text-center">Valor:'+answer.points+'</p><p class="text-left">'+answer.answer+'</p></div><div class="row-fluid">'+responses+'</div><div class="row-fluid"><label for="respuesta">Respuesta</label><input type="text" id="respuesta" readonly /></div>';
	resp_correct=answer.correctAnswer;
	temp_points=answer.points;
	responseMsgbox(output);
};

function responseMsgbox(html){
		$("#tablero_preguntas").html(html);
		$("#tablero_preguntas > div:nth-child(2) > ol > li > p > a").on("click",function(){
		$("#respuesta").val($(this).text());
	});
		$("#tablero_preguntas").dialog("open");
}

function setTurno(turno){

	
	$("th[id='"+teams[turno].team+"'],td[id='"+teams[turno].team+"']").removeClass("active");
	$("th[id='"+teams[turno].team+"'],td[id='"+teams[turno].team+"']").addClass("active");
}

//new answer controllers

var showAnswerinTable=function(){
	getService(urlApi+"groups/"+$("#groupId").val()+"/answers/",token)
	window.setTimeout(function(){
		$("#general_container > div > div.col-lg-4 > table > tbody").html("");
		var c=1;
		$.each(temp,function(index,pregunta){
			$("#general_container > div > div.col-lg-4 > table > tbody").append("<tr><td>"+c+"</td><td><p class='text-left'>"+pregunta.answer+"</p></td><td>"+pregunta.points+"</td></tr>");
			c++;
		});
	},500);
};

//Initialize two sound clips with 1 fallback file each:

return {
	showLogin:openFormLogin,
	changeMenu:selectedMenu,
	login:GotoLogin,
	postService:PostService,
	getService:getService,
	getPHPService:getPHPService,
	init:init,
	CreatJsonFromForm:CreatJsonFromForm,
	initGame:initGame,
	showAnswerinTable:showAnswerinTable
	};
};


function createsoundbite(sound){
	var html5audio=document.createElement('audio')
	if (html5audio.canPlayType){ //check support for HTML5 audio
		for (var i=0; i<arguments.length; i++){
			var sourceel=document.createElement('source')
			sourceel.setAttribute('src', arguments[i])
			if (arguments[i].match(/\.(\w+)$/i))
				sourceel.setAttribute('type', html5_audiotypes[RegExp.$1])
			html5audio.appendChild(sourceel)
		}
		html5audio.load()
		html5audio.playclip=function(){
			html5audio.pause()
			html5audio.currentTime=0
			html5audio.play()
		}
		return html5audio
	}
	else{
		return {playclip:function(){throw new Error("Your browser doesn't support HTML5 audio unfortunately")}}
	}
}

var sound=createsoundbite("../Content/winnerSound.wav","../Content/winnerSound.wav");