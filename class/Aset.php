<?php  
include_once CLASS_PATH.'Kategori.php';
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

	function getAsetByKode($rfid){
		$rfid = 'INV-'.$rfid;
		$sql = "SELECT * FROM aset 
		WHERE kode_aset = '$rfid'";
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
		INNER JOIN kategori ON aset.id_kategori=kategori.id_kategori
		WHERE kode_aset LIKE '%$keyword%' OR 
		nama_aset LIKE '%$keyword%' OR
		jumlah_aset LIKE '%$keyword%' OR 
		nama_kategori LIKE '%$keyword%' OR
		tanggal_perolehan LIKE '%$keyword%' OR
		umur_ekonomis LIKE '%$keyword%' OR
		nilai_ekonomis LIKE '%$keyword%' OR
		nilai_residu LIKE '%$keyword%' OR
		biaya_penyusutan LIKE '%$keyword%'";
		$result = mysqli_query($this->db->conn, $sql);

		if (!$result) {
            echo "Error: " . mysqli_error($this->db->conn);
            return;
        }

	    $aset = mysqli_fetch_all($result, MYSQLI_ASSOC); 
	    return $aset;
	}

	function getAsetById($id){
		$sql = "SELECT * FROM aset 
		WHERE id = '$id'";
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
		$jumlah_aset = preg_replace("/\./", "", $data["jumlah-aset"]);
		$id_kategori = $data["id-kategori"];
		$tanggal_perolehan = $data["tanggal-perolehan"];
		$nilai_ekonomis = preg_replace("/\./", "", $data["nilai-ekonomis"]);
		$umur_ekonomis = preg_replace("/\./", "", $data["umur-ekonomis"]);
		$nilai_residu = preg_replace("/\./", "", $data["nilai-residu"]);
		$biaya_penyusutan = ($nilai_ekonomis - $nilai_residu) / $umur_ekonomis;
		if($file['gambar']['name'] != ''){
			$this->uploadGambar($file);
			$file_name = $this->new_file_name;
		}else{
			$file_name = "";

		}
		$sql = "INSERT INTO aset (id, gambar, kode_aset, nama_aset, jumlah_aset, id_kategori, tanggal_perolehan, nilai_ekonomis, nilai_residu, umur_ekonomis, biaya_penyusutan)
		VALUES ('', '$file_name', '$kode_aset', '$nama_aset', '$jumlah_aset', '$id_kategori', '$tanggal_perolehan', '$nilai_ekonomis', '$nilai_residu', '$umur_ekonomis', '$biaya_penyusutan')";

		$sql2 = "UPDATE rfid set no_aset = ''";
		mysqli_query($this->db->conn, $sql2);
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

	function ubahAset($data, $gambar) {
	    $id_aset = $data["id-aset"];       
	    $kode_aset = $data["kode-aset"];
	    $nama_aset = $data["nama-aset"];
	    $jumlah_aset = $data["jumlah-aset"];
	    $id_kategori = $data["id-kategori"];
	    $tanggal_perolehan = $data["tanggal-perolehan"];
		$nilai_ekonomis = preg_replace("/\./", "", $data["nilai-ekonomis"]);
		$umur_ekonomis = preg_replace("/\./", "", $data["umur-ekonomis"]);
		$nilai_residu = preg_replace("/\./", "", $data["nilai-residu"]);
		$biaya_penyusutan = ($data["nilai-ekonomis"] - $data["nilai-residu"]) / $data["umur-ekonomis"];
		if(is_array($gambar)){
			$this->uploadGambar($gambar);
			$filename = $this->new_file_name;
			unlink(GAMBAR_PATH . $data["gambar-lama"]);
		}else{
			$filename = $data["gambar-lama"];
		}
	    $sql = "UPDATE aset 
	            SET kode_aset = '$kode_aset', 
	                nama_aset = '$nama_aset', 
	                jumlah_aset = '$jumlah_aset', 
	                id_kategori = '$id_kategori', 
	                tanggal_perolehan = '$tanggal_perolehan', 
	                nilai_ekonomis = '$nilai_ekonomis', 
	                umur_ekonomis = '$umur_ekonomis', 
	                nilai_residu = '$nilai_residu',
	                biaya_penyusutan = '$biaya_penyusutan', 
	                gambar = '$filename' 
	            WHERE id = '$id_aset'";

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

	function hapusAset($id_aset, $gambar) {
	    $sql = "DELETE FROM aset WHERE id = $id_aset";
	    if($gambar != ''){
	    	unlink(GAMBAR_PATH . $gambar);
	    }
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

	function monitoringAset($data){
		$kode_aset = $data['kode-aset'];
		$umur_ekonomis = $data['umur-ekonomis'];
		$tanggal_monitoring = $data['tanggal-monitoring'];

		$sql = "UPDATE aset 
	            SET tanggal_monitoring = '$tanggal_monitoring', 
	                umur_ekonomis = '$umur_ekonomis'
	            WHERE kode_aset = '$kode_aset'";

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
}