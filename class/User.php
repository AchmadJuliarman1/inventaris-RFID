<?php 
include_once CLASS_PATH."Database.php";

class User{
	public $db;
	public $id;
	public $username;

	function __construct($db){
		$this->db = $db;
	}

	function login($username, $pass){
		$sql = "SELECT username FROM user WHERE username = '$username'";
		mysqli_query($this->db->conn, $sql);
		$result = mysqli_affected_rows($this->db->conn);
		if($result < 1){
			$_SESSION['username'] = 0;
			return 0;
		}else{
			$sql = "SELECT * FROM user WHERE password = '$pass' ";
			mysqli_query($this->db->conn, $sql);
			$result = mysqli_affected_rows($this->db->conn);
			if($result < 1){
				$_SESSION['pass'] = 0;
				return 0;
			}
			$user = mysqli_fetch_all(mysqli_query($this->db->conn, $sql), MYSQLI_ASSOC);
			$_SESSION['username'] = $user[0]["username"];
			$_SESSION['nama'] = $user[0]["nama"];
			$_SESSION['id'] = $user[0]["id"];
			$_SESSION['login'] = true;
		}
		return 1;
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
