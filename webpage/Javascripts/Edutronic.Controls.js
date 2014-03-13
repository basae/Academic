var WebControl=function(){

var openFormLogin=function(){
	$("#form-login").dialog("open");
};

//change class attribute where menu is selected
var selectedMenu=function(menu){
	$("header + nav > div > div:first-child > ul > li").removeClass("active");
	$("#"+menu).parent().addClass("active");
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
		url:"http://localhost/api/tokens/",
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
		url:"Controls/create_session.php",
		data:"user="+JSON.stringify(user),
		success:function(done){
			if(done=="done"){
				location.href="index.php";
			}
		},
		error:function(){
			alert("error");	
		}
	});
};

function openViews(menu){
switch(menu){
case "menu5":
			$.ajax({
				type:"POST",
				url:"Pages/view_register.php",
				data:"",
				success: function(response){
				$("#general_container").html(response);
				},
				error: function(){
					alert("ha ocurrido un error, intentalo de nuevo");	
				}
			});
	break;
	
default:
$("#general_container").html("");
break;
}
};

var PostService=function(data,url){
	var result;
	$.ajax({
		type:"POST",
		url:url,
		data:data,
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
		url:url,
		dataType:"json",
		success: function(response){
			alert(response.school);		
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

return {
	showLogin:openFormLogin,
	changeMenu:selectedMenu,
	login:GotoLogin,
	postService:PostService,
	getService:getService,
	getPHPService:getPHPService
	};
};