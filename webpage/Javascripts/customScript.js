// JavaScript Document
$(function(){
	
});

function selectedMenu(menu){
	$(".nav > nav-tabs li").removeClass();
	$("#"+menu).parent().addClass("active");
	
}