<?php 

	
	class Connection
	{
		private $db_name;
		private $db_password;
		private $db_username;


		public function __construct($db_name,$db_password,$db_username)
		{
			$this->db_name = $db_name;
			$this->db_password = $db_password;
			$this->db_username = $db_username;
		}
	}


	class Model
	{
		private $connection;

		public function __construct(Connection $connection)
		{
			$this->connection = $connection;
		}
	}



	$connection = new Connection('db_name','root','root');
	$model = new Model($connection);

	var_dump($model);die;


 ?>