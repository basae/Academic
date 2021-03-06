// JavaScript Document
var actionService;
$(function(){
	//inicializo los controles scripts
	Control=WebControl();
	Control.init();
	//inicializa el form de login
	$("#form-login").dialog({
		autoOpen:false,
		resizable:false,
		show:{
			effect:"clip",
			duration:800
			},
		width:'auto',
		height:'auto',
		modal:true
	});
	
	$("#login").on("submit",function(event){
		event.preventDefault();
		Control.login($("#txt-username").val(),$("#txt-password").val())
		return false;
	});
	
	$("#limpiar").on("click",function(event){
		$("#form-login").dialog("close");
	});
	
	//inicio la funcionalidad de el menu
	$("nav > div > div:first-child > ul > li > ul > li > a").on("click",function(){
		Control.changeMenu($(this).attr("id"));
	});
	
	$("nav > div > div:first-child > ul > li > a").on("click",function(){
		Control.changeMenu($(this).attr("id"));
	});
	
	//funcionalidad cuando de click en editar perfil
	$("#user_edit").on("click",function(){
		Control.getPHPService("../Controls/getToken.php",urlApi+"subscriberx/");		
	});
	
});
//show form login
