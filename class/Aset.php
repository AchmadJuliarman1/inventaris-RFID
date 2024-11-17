<?php  

class Aset{
	public $db;

	function __construct($db){
		$this->db = $db;
	}

	function tampilDataAset(){
		$sql = "SELECT * FROM aset";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $aset = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $aset;
	}

	function cariDataAset($keyword){
		$sql = "SELECT * FROM aset 
		WHERE kode_aset LIKE '%$keyword%' OR 
		nama_aset LIKE '%$keyword%' OR
		stok LIKE '%$keyword%' OR 
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

	function tambahAset($data){
		$kode_aset = $data["kode-aset"];
		$nama_aset = $data["nama-aset"];
		$stok = $data["stok"];
		$id_kategori = $data["id-kategori"];
		$waktu = date("Y/m/d H:i:s");
		$sql = "INSERT INTO aset (id, kode_aset, nama_aset, stok, id_kategori, created_at, updated_at)
		VALUES ('', '$kode_aset', '$nama_aset', '$stok', '$id_kategori', '$waktu', '')";

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

	function ubahAset($data) {
	    $id_aset = $data["id-aset"];       
	    $kode_aset = $data["kode-aset"];
	    $nama_aset = $data["nama-aset"];
	    $stok = $data["stok"];
	    $id_kategori = $data["id-kategori"];
	    $waktu = date("Y/m/d H:i:s");

	    $sql = "UPDATE aset 
	            SET kode_aset = '$kode_aset', 
	                nama_aset = '$nama_aset', 
	                stok = '$stok', 
	                id_kategori = '$id_kategori', 
	                updated_at = '$waktu' 
	            WHERE id = '$id_aset'";

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

	function hapusAset($id_aset) {
	    $id_aset = $id_aset;

	    $sql = "DELETE FROM aset WHERE id = $id_aset";

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