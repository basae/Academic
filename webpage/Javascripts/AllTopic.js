// JavaScript Document
var AllTopic=true;
$("[id$='filter']").on("click",function(){
	switch($(this).val()){
		case 'Todos':
		$("#topic").attr("disabled","disabled");
		$("#dificultyGrade").attr("disabled","disabled");
		AllTopic=true;
		break;
		
		default:
		$("#topic").removeAttr("disabled");
		$("#dificultyGrade").removeAttr("disabled");
		AllTopic=false;
		break;
	}
});

$("#search").on("submit",function(event){
	event.preventDefault();
	if(AllTopic)
		Control.getService(urlApi+"grouptopic/",token);
		var ToolTips=[];
		$(document).tooltip({
			items: "title",
			content:function(){
				var element=$(this);
				if(element.is("[title]")){
					return element.attr("title");	
				}
			}
			
		});
	window.setTimeout(function(){
		$("#search-table tbody").html("");
		$.each(temp,function(index,obj){
			var tootip="Preguntas\n"
			$.each(obj.myAnswer,function(index){
			tootip+=(index+1)+".-"+obj.myAnswer[index].answer+"\n";		
			});
			$("#search-table tbody").append("<tr><td><a title='"+tootip+"'>"+obj.topic+"</a></td><td>"+obj.dificultyGrade+"</td><td>"+obj.answerNumber+"</td><td>"+obj.subscriberName+"</td></tr>");
		});
	},500);
});