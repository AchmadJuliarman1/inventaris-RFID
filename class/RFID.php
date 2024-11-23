<?php 

class RFID{
	public $db;

	function __construct($db){
		$this->db = $db;
	}
	
	function inputRFID($rfid){
		$sql = "UPDATE rfid SET no_aset = '$rfid'";
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