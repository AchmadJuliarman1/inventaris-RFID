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

	function tambahUser($data){
		$username = $data['username'];
		$pass = $data['pass'];
		$role = $data['role'];
		$nama = $data['nama'];
		$sql = "INSERT INTO user (id, nama, role, username, password)
		VALUES('', '$nama', '$role', '$username', '$pass')";
		if (mysqli_query($this->db->conn, $sql)) {
	        if (mysqli_affected_rows($this->db->conn) > 0) {
	            return 1;
	        } else {
	            return 0;
	        }
	    } else {
	        return "Error: " . mysqli_error($this->db->conn);
	    }
	}

	function ubahUser($data){
	    $id_user = $data["id"];       
	    $username = $data["username"];
	    $nama = $data["nama"];
	    $role = $data["role"];
	    $waktu = $data["pass"];

	    $sql = "UPDATE user 
	            SET username = '$username', 
	                password = '$pass',
	                nama = '$nama', 
	                role = '$role'
	            WHERE id = '$id_user'";

	    if (mysqli_query($this->db->conn, $sql)) {
	        if (mysqli_affected_rows($this->db->conn) > 0) {
	            return 1;
	        } else {
	            return 0;
	        }
	    } else {
	        return "Error: " . mysqli_error($$this->db->conn);
	    }
	}

	function hapusUser($id) {
	    $id = $id;

	    $sql = "DELETE FROM user WHERE id = $id";

	    if (mysqli_query($this->db->conn, $sql)) {
	        if (mysqli_affected_rows($this->db->conn) > 0) {
	            return 1;
	        } else {
	            return 0;
	        }
	    } else {
	        return "Error: " . mysqli_error($$this->db->conn);
	    }
	}

}