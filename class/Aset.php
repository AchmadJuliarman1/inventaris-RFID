<?php  

class Aset{
	public $db;
	public $new_file_name;
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

	function tambahAset($data, $file){
		$kode_aset = $data["kode-aset"];
		$nama_aset = $data["nama-aset"];
		$stok = $data["stok"];
		$id_kategori = $data["id-kategori"];
		$waktu = date("Y/m/d H:i:s");
		$this->uploadGambar($file);
		$file_name = $this->new_file_name;
		$sql = "INSERT INTO aset (id, gambar, kode_aset, nama_aset, stok, id_kategori, created_at, updated_at)
		VALUES ('', '$file_name', '$kode_aset', '$nama_aset', '$stok', '$id_kategori', '$waktu', '')";

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
	
	function uploadGambar($file){
		$target_dir = GAMBAR_PATH;
		$waktu = date("Ymd_His");
		$file_extension = pathinfo($file["gambar"]["name"], PATHINFO_EXTENSION);
		$new_file_name = "gambar_" . $waktu . "." . $file_extension; // Contoh: gambar_1638240845.jpg
		$target_file = $target_dir . $new_file_name;

		$this->new_file_name = $new_file_name;
		// Memindahkan file ke lokasi tujuan dengan nama yang sudah diubah
		if(move_uploaded_file($file["gambar"]["tmp_name"], $target_file)){
			return true;
		}else{
			return false;
		}
	}

}