<?php 


	include "database.php";
	include "user.php";

	//$test1 = include "connection/dic.php";


	$database = new Database();
	$user = new User($database);
 	
 	$user->logout("","");

 ?>