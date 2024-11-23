<?php
class Database{

	public $conn;

	function __construct($host, $username, $pass, $dbname){
		$this->conn = mysqli_connect($host, $username, $pass, $dbname);
		if (!$this->conn) {
		  	die("Connection failed: " . mysqli_connect_error());
		}
	}

}


 ?>