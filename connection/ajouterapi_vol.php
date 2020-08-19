<?php 

	include("header.php");

		if(isset($_POST['ville_depart']) && isset($_POST['ville_destination']) && isset($_POST['date_depart']) 
			&& isset($_POST['nb_heure_vol']) && isset($_POST['prix'])){

			if(intval($_POST['prix']) > 0)
			{
				$requete = $pdo->prepare("INSERT INTO `vols` (`id`, `ville_depart`, `ville_destination`, `date_depart`, `nb_heure_vol`, `prix`) VALUES (NULL, ':ville1', ':ville2', ':date_vol', ':nb', ':prix');");
				$requete->bindParam(':ville1', $_POST['ville_depart']);
				$requete->bindParam(':ville2', $_POST['ville_destination']);
				$requete->bindParam(':date_vol', $_POST['date_depart']);
				$requete->bindParam(':nb', $_POST['nb_heure_vol']);
				$requete->bindParam(':prix', $_POST['prix']);
				$requete->execute();

				return_json(true,"Le vol a été ajouté");
				

			}else{
				return_json(false,"Le prix n'est pas correct");
			}

			
			
		}

		else{
			
			return_json(false,"Il manque des infos");
		}
		
		

 ?>