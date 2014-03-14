$(function(){

	
	$("body > div > div.span8 > form > div > div > optgroup").on("click",function(){
		switch($(this).val())
		{
			case "Moral":
				$("#repre_legal").attr("visibility","visible");
			break;
			
			case "Fisica":
				$("#repre_legal").attr("visibility","hidden");
			break;
		}
	});
	
});

function getService(menu){
	$.ajax({
		type:"POST",
		url:"contenido/"+menu+".php",
		success: function(response){
			$("#contenido").html(response);	
		},
		error:function(error){
			alert(error.status);
		}
	});
}
