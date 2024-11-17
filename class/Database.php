<?php
class Database{

	public $conn;

	function __construct($host, $username, $pass, $dbname){
		$this->conn = mysqli_connect($host, $username, $pass, $dbname);
		if (!$this->conn) {
		  	die("Connection failed: " . mysqli_connect_error());
		}
	}

	function inputRFID($rfid){
		$sql = "INSERT INTO rfid (no_aset) VALUES('$rfid')";
		if (mysqli_query($this->conn, $sql)) {
	        if (mysqli_affected_rows($this->conn) > 0) {
	            return "Data berhasil ditambahkan.";
	        } else {
	            return "Gagal menambahkan data.";
	        }
	    } else {
	        return "Error: " . mysqli_error($this->conn);
	    }
	}

}

$db = new Database("localhost", "root", "", "inventaris");

 ?>