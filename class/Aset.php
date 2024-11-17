<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/inventaris RFID/class/config.php'); 
require_once(CLASS_PATH.'Database.php');
class Aset{
	function tambahAset($data){
		$kode_aset = $data["kode_aset"];
		$nama_aset = $data["nama_aset"];
		$stok = $data["stok"];
		$id_aset = $data["id_katagori"];
		$waktu = date("Y/m/d H:i:s");
		$sql = "INSERT INTO aset (id, kode_aset, nama_aset, stok, id_kategori, created_at, updated_at)
		VALUES ('', '$kode_aset', '$nama_aset', '$stok', '$id_kategori', '$waktu', '')";

		if (mysqli_query($db->conn, $sql)) {
	        if (mysqli_affected_rows($db->conn) > 0) {
	            return "Data berhasil ditambahkan.";
	        } else {
	            return "Gagal menambahkan data.";
	        }
	    } else {
	        return "Error: " . mysqli_error($db->conn);
	    }
	}

	function ubahAset($data) {
	    $id_aset = $data["id_aset"];       
	    $kode_aset = $data["kode_aset"];
	    $nama_aset = $data["nama_aset"];
	    $stok = $data["stok"];
	    $id_kategori = $data["id_kategori"];
	    $waktu = date("Y/m/d H:i:s");

	    $sql = "UPDATE aset 
	            SET kode_aset = '$kode_aset', 
	                nama_aset = '$nama_aset', 
	                stok = '$stok', 
	                id_kategori = '$id_kategori', 
	                updated_at = '$waktu' 
	            WHERE id = '$id_aset'";

	    if (mysqli_query($db->conn, $sql)) {
	        if (mysqli_affected_rows($db->conn) > 0) {
	            return "Data aset berhasil diubah.";
	        } else {
	            return "Gagal mengubah data atau tidak ada perubahan.";
	        }
	    } else {
	        return "Error: " . mysqli_error($db->conn);
	    }
	}

	function hapusAset($id_aset) {
	    $id_aset = $id_aset;

	    $sql = "DELETE FROM aset WHERE id = $id_aset";

	    if (mysqli_query($db->conn, $sql)) {
	        if (mysqli_affected_rows($db->conn) > 0) {
	            return "Data aset berhasil dihapus.";
	        } else {
	            return "Gagal menghapus data aset atau ID aset tidak ditemukan.";
	        }
	    } else {
	        return "Error: " . mysqli_error($db->conn);
	    }
	}
	

}