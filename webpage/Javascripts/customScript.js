// JavaScript Document
var actionService;
$(function(){
	Control=WebControl();
	Control.init();
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
	
	$("#user_edit").on("click",function(){
		Control.getPHPService("Controls/getToken.php");
		window.setTimeout(function(){
		var test=Control.getService("http://localhost:51981/api/subscriberx/"+actionService.id,actionService.accessToken);
		},1000);
		
	});
});
//show form login
var WebControl=function(){

var init=function (menu){
	$.fn.serializeObject = function(){

        var self = this,
            json = {},
            push_counters = {},
            patterns = {
                "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                "push":     /^$/,
                "fixed":    /^\d+$/,
                "named":    /^[a-zA-Z0-9_]+$/
            };


        this.build = function(base, key, value){
            base[key] = value;
            return base;
        };

        this.push_counter = function(key){
            if(push_counters[key] === undefined){
                push_counters[key] = 0;
            }
            return push_counters[key]++;
        };

        $.each($(this).serializeArray(), function(){

            // skip invalid keys
            if(!patterns.validate.test(this.name)){
                return;
            }

            var k,
                keys = this.name.match(patterns.key),
                merge = this.value,
                reverse_key = this.name;

            while((k = keys.pop()) !== undefined){

                // adjust reverse_key
                reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), "");

                // push
                if(k.match(patterns.push)){
                    merge = self.build([], self.push_counter(reverse_key), merge);
                }

                // fixed
                else if(k.match(patterns.fixed)){
                    merge = self.build([], k, merge);
                }

                // named
                else if(k.match(patterns.named)){
                    merge = self.build({}, k, merge);
                }
            }

            json = $.extend(true, json, merge);
        });

        return json;
    };

};

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

var getService=function(url,token){
	var result;
		$.ajax({
		type:"GET",
		url:url,
		dataType:"json",
		success: function(response){
		result=response;
		
		},
		error: function(err){
		result=err.status+" "+err.description;	
		}
	});
	return result;
};

var getPHPService=function(url){
	$.ajax({
		type:"GET",
		async:false,
		url:url,
		dataType:"json",
		success: function(response){
		actionService=response;	
		},
		error: function(err){
		actionService=err.status+" "+err.description;
		}
	});
};

return {
	showLogin:openFormLogin,
	changeMenu:selectedMenu,
	login:GotoLogin,
	init:init,
	postService:PostService,
	getService:getService,
	getPHPService:getPHPService
	};
}