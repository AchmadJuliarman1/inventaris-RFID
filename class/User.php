<?php 
include_once CLASS_PATH."Database.php";

class User{
	public $db;

	function __construct($db){
		$this->db = $db;
	}

	function login(){

	}

	function logout(){

	}

	function tampilDataUser(){
		$sql = "SELECT * FROM user";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $aset = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $aset;
	}
}