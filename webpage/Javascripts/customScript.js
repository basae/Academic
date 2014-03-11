// JavaScript Document
$(function(){
	Control=WebControl();
	$("#form-login").dialog({
		autoOpen:false,
		resizable:false,
		show:{
			effect:"clip",
			duration:800
			},
		width:'auto',
		height:'auto',
		modal:true,
		buttons:{
			"Ok":function(){
				Control.login($("#txt-username").val(),$("#txt-password").val());
			},
			Cancel:function(){
				$(this).dialog("close");
			}
		}
	});
	$("nav > div > div:first-child > ul > li > a").on("click",function(){
		Control.changeMenu($(this).attr("id"));
	});
	
});
//show form login
var WebControl=function(menu){

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
		url:"http://localhost:51981/api/tokens/",
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

return {
	showLogin:openFormLogin,
	changeMenu:selectedMenu,
	login:GotoLogin
	};
}