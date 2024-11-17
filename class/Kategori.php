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