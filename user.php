<?php 


	class User
	{

		protected $database;

		public function __construct(Database $database)
		{
			$this->database = $database;
		}

		public function login($username,$pass)
		{
			 $this->database->connect();
		}

		public function register($name,$username,$pass,$email)
		{
			$this->database->connect();
		}

		public function logout()
		{
			$this->database->disconnet();
		}

	}



 ?>