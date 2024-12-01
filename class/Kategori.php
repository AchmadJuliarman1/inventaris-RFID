<?php 
include_once CLASS_PATH."Database.php";

class Kategori{
	public $db;

	function __construct($db){
		$this->db = $db;
	}

	function tampilDataKategori(){
		$sql = "SELECT * FROM kategori";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $aset = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $aset;
	}

	function cariDataKategori($keyword){
		$sql = "SELECT * FROM kategori 
		WHERE id_kategori LIKE '$keyword%' OR
		nama_kategori LIKE '%$keyword%'";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $aset = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $aset;
	}

	function tambahKategori($data){
		$nama_kategori = $data['nama'];
		$waktu = date("Y/m/d H:i:s");
		$sql = "INSERT INTO kategori (id_kategori, nama_kategori, created_at)
		VALUES('', '$nama_kategori', '$waktu')";
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

	function ubahKategori($data){
	    $id_kategori = $data["id"];       
	    $nama_kategori = $data["nama"];
	    $waktu = date("Y/m/d H:i:s");

	    $sql = "UPDATE kategori 
	            SET nama_kategori = '$nama_kategori', 
	                updated_at = '$waktu'
	            WHERE id_kategori = '$id_kategori'";

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

	function hapusKategori($id_kategori) {
	    $sql = "DELETE FROM kategori WHERE id_kategori = $id_kategori";

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

	function cariKategori($keyword){
		$sql = "SELECT * FROM kategori 
		WHERE id_kategori LIKE '%$keyword%' OR 
		nama_kategori LIKE '%$keyword%' OR
		created_at LIKE '%$keyword%' OR
		updated_at LIKE '%$keyword%'";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $aset = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $aset;
	}

	function cariKategoriByID($id){
		$sql = "SELECT * FROM kategori 
		WHERE id_kategori = '$id'";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $kategori = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $kategori;
	}
}