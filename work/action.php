<?php 

	if (isset($_POST['action'])) {
		if ($_POST['action'] == 'insert') {
			$form_data = [
				"firstname" => $_POST['first_name'],
				"lastname" => $_POST['last_name']
			];

			$api_curl = "http://openflex.dependancei/CrudApiPhp/test_api.php?action=insert";
			$client = curl_init($api_curl);
			curl_setopt($client, CURLOPT_POST, true);
			curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
			curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($client);
			curl_close($client);
			$result = json_decode($response,true);

			foreach ($result as $key => $value) {
				if($result[$key]['success'] == 1){
					echo "insert";
				}else{
					echo "erreur";
				}
			}
			
		}
	}




	//CURLOPT_POST = TRUE pour que PHP fasse un HTTP POST. 
					//Un POST est un encodage normal 
	                //application/x-www-from-urlencoded, utilisé couramment par les formulaires HTML.

	//CURLOPT_POSTFIELDS = Toutes les données à passer lors d'une opération de HTTP POST. Pour envoyer un fichier, préfixez le nom du fichier avec un @ et utilisez le chemin complet. Le type de fichier peut être explicitement spécifié en faisant suivre le nom du fichier par le type au format ';type=mimetype'. Ce paramètre peut être passé sous la forme d'une chaîne encodée URL, comme 'para1=val1&para2=val2&...' ou sous la forme d'un tableau dont le nom du champ est la clé, et les données du champ la valeur. Si le paramètre value est un tableau, l'en-tête Content-Type sera définie à multipart/form-data. Depuis PHP 5.2.0, value doit être un tableau si les fichiers sont passés à cette option avec le préfixe @. Depuis PHP 5.5.0, le préfixe @ est obsolète et les fichiers peuvent être envoyés en utilisant CURLFile.

	//CURLOPT_RETURNTRANSFER = TRUE retourne directement le transfert sous forme de chaîne de la valeur retournée par curl_exec() au lieu de l'afficher directement.

 ?>

