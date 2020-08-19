<?php 

	class API{

		private $connect = "";


		function __construct()
		{
			$this->database_connection();
		}


		function database_connection()
		{
		 	$this->connect = new PDO("mysql:host=localhost;dbname=mail_api", "root", "azerty");
		}


		function fetch_all()
		{
			$query = "SELECT * FROM api_php ORDER BY id";
			$statement = $this->connect->prepare($query);
			if($tatement->execute())
			{
				while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
					$data[] = $row;
				}
				return $data;
			}
		}


		function insert()
		{
			if (isset($_POST['first_name'])) {
				$form_data = [
					':firstname' => $_POST['first_name'],
					':lastname' => $_POST['last_name']
				];

				$query = "INSERT INTO api_php(firstname,lastname) VALUES (:firstname,lastname)";
				$statement = $this->connect->prepare($query);
				if ($statement->execute($form_data)) {
					$data[] = [
						'success' = '1'
					]
				}else{
					$data[] = [
						'success' = '0'
					]
				}
			}else{
				$data[] = [
					'success' = '0'
				]

			}
			return $data;
		}
	}



 ?>