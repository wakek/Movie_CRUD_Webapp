<?php
    include_once("settings.php");

    class DatabaseAccessHelper{
		protected $connection=null;
		// private $data=null;
		
		function __construct(){
			$this->connect();
		}

		function __destruct(){
			if($this->connection){
				$this->connection->close();
			}
		}
	
		function connect(){
			$this->connection = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
			
			if($this->connection->connect_errno){
				echo $this->connection->connect_errno;
				return false;
			}
				
			return true;
		}

		function recently_generated_id(){
			return mysqli_insert_id($this->connection);
		}
	}

?>