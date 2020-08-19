<?php 

header('Content-type: application/json');


try{
	$pdo = new PDO('mysql:host=localhost;port=8889;dbname=mail_api;', 'root','azerty');
	return_json(true,"Connexion à la base de donnée réussie");
}catch(Exception $e){
	return_json(false,"Connexion à la base de donnée impossible");
}

function return_json($success,$msg,$result=NULL)
{
	$retour["success"] = $success;
	$retour["message"] = $msg;
	$retour["results"] = $result;

	echo json_encode($retour);
}


 ?>