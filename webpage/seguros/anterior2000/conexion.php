<?php
function conex(){
	if($conecta=mysql_connect("mysql14.000webhost.com","a8047641_coptran","edrei8989")){
	}
	if(mysql_select_db("a8047641_coptran",$conecta)){
	}
return $conecta;
}
?>