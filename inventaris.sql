/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - inventaris
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventaris` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `inventaris`;

/*Table structure for table `aset` */

DROP TABLE IF EXISTS `aset`;

CREATE TABLE `aset` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `gambar` varchar(200) DEFAULT NULL,
  `kode_aset` varchar(100) NOT NULL,
  `nama_aset` varchar(250) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `nilai_ekonomis` int(10) DEFAULT NULL,
  `nilai_residu` int(10) DEFAULT NULL,
  `umur_ekonomis` int(3) DEFAULT NULL,
  `biaya_penyusutan` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`kode_aset`),
  UNIQUE KEY `kode_aset_unique` (`kode_aset`),
  KEY `aset_kategori` (`id_kategori`),
  CONSTRAINT `aset_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `aset` */

insert  into `aset`(`id`,`gambar`,`kode_aset`,`nama_aset`,`stok`,`id_kategori`,`tanggal_perolehan`,`nilai_ekonomis`,`nilai_residu`,`umur_ekonomis`,`biaya_penyusutan`) values 
(38,'gambar_20241130_204041.png','INV-123','Kursi Gaming',21,1,'2024-11-05',8000000,1000000,5,1400000),
(39,'gambar_20241201_194804.png','INV-12312','SofaG',1,2,'2024-12-10',8000000,1000000,5,1400000);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`nama_kategori`,`created_at`,`updated_at`) values 
(1,'Furniture','2024-11-17 16:37:23','2024-11-24 15:38:59'),
(2,'Elektronik','2024-11-17 19:42:40','0000-00-00 00:00:00');

/*Table structure for table `rfid` */

DROP TABLE IF EXISTS `rfid`;

CREATE TABLE `rfid` (
  `no_aset` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rfid` */

insert  into `rfid`(`no_aset`) values 
('');

/*Table structure for table `riwayat_pengadaan` */

DROP TABLE IF EXISTS `riwayat_pengadaan`;

CREATE TABLE `riwayat_pengadaan` (
  `id_riwayat_pengadaan` int(5) NOT NULL AUTO_INCREMENT,
  `kode_aset` varchar(100) NOT NULL,
  `stok` int(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_riwayat_pengadaan`),
  KEY `fk_riwayat_pengadaan_kode_aset` (`kode_aset`),
  CONSTRAINT `fk_riwayat_pengadaan_kode_aset` FOREIGN KEY (`kode_aset`) REFERENCES `aset` (`kode_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayat_pengadaan` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`nama`,`role`,`username`,`password`) values 
(7,'Ahmad Sanosi','Pimpinan','sanosi','123'),
(8,'Afwa Fitrasya Muaja','Admin','afwa','123');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
