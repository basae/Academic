<?php
	$response="";
	if(isset($_POST["user"])){
	session_start();
	$_SESSION['login_user']=json_decode($_POST["user"],true);
	$response="done";
	}
	else
	{
	$response="bad";
	}
	$jsonOutput=$response;
	echo $jsonOutput;
?>
