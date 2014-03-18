<?php
function conex(){
	if($conecta=mysql_connect("localhost","root","")){
	}
	if(mysql_select_db("coopsegu",$conecta)){
	}
return $conecta;
}
?>