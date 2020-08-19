<?php 
	
	include("header.php");

	
	if(isset($_POST['ville_depart'])){

		$requete = $pdo->prepare("SELECT * FROM vols WHERE ville_depart LIKE :v");
		$requete->bindParam(':v', $_POST['ville_depart']);
		$requete->execute();
		
	}
	else{
		$requete = $pdo->prepare("SELECT * FROM vols");
		$requete->execute();
		
	}
	
	$resultat = $requete->fetchAll();
	
	$results['nb'] = count($resultat);
	$results['vols'] = $resultat;
	
	return_json(true,"Voici les vols",$results);


 ?>