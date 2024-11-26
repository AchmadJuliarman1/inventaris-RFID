<?php 

class RFID{
	public $db;

	function __construct($db){
		$this->db = $db;
	}

	function inputRFID($rfid){
		$sql = "UPDATE rfid SET no_aset = '$rfid'";
		if (mysqli_query($this->db->conn, $sql)) {
	        if (mysqli_affected_rows($this->db->conn) > 0) {
	            return "Data berhasil ditambahkan.";
	        } else {
	            return "Gagal menambahkan data.";
	        }
	    } else {
	        return "Error: " . mysqli_error($this->conn);
	    }
	}

	function getRFID(){
		$sql = "SELECT * FROM rfid";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $rfid = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $rfid;
	}
}