/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100130 (10.1.30-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : gki

 Target Server Type    : MySQL
 Target Server Version : 100130 (10.1.30-MariaDB)
 File Encoding         : 65001

 Date: 11/06/2025 14:20:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for dokumen_lamaran
-- ----------------------------
DROP TABLE IF EXISTS `dokumen_lamaran`;
CREATE TABLE `dokumen_lamaran`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_lamaran` int NOT NULL,
  `id_dokumen_lowongan` int NULL DEFAULT NULL,
  `jenis_dokumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ukuran_file` int NOT NULL,
  `tipe_file` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_lamaran`(`id_lamaran` ASC) USING BTREE,
  INDEX `id_dokumen_lowongan`(`id_dokumen_lowongan` ASC) USING BTREE,
  CONSTRAINT `fk_dokumen_lamaran_dokumen_lowongan` FOREIGN KEY (`id_dokumen_lowongan`) REFERENCES `dokumen_lowongan` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `fk_dokumen_lamaran_lamaran` FOREIGN KEY (`id_lamaran`) REFERENCES `lamaran_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of dokumen_lamaran
-- ----------------------------
INSERT INTO `dokumen_lamaran` VALUES (1, 1, 1, 'CV', 'cv_dewi.pdf', 512, 'pdf', '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_lamaran` VALUES (2, 2, 2, 'Portofolio', 'rafi_porto.jpg', 2048, 'jpg', '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_lamaran` VALUES (41, 305, 3, 'CV', 'CV_23_1748953717.pdf', 43, 'application/pdf', '2025-06-03 20:28:37', '2025-06-03 20:28:37');
INSERT INTO `dokumen_lamaran` VALUES (42, 305, 24, 'transkrip', 'transkrip_23_1748320811.pdf', 15, 'application/pdf', '2025-06-03 20:28:37', '2025-06-03 20:28:37');
INSERT INTO `dokumen_lamaran` VALUES (43, 305, 25, 'lainnya', 'lainnya_23_1748953717.jpg', 186, 'image/jpeg', '2025-06-03 20:28:37', '2025-06-03 20:28:37');
INSERT INTO `dokumen_lamaran` VALUES (44, 306, 26, 'ktp', 'ktp_25_1749001224.pdf', 43, 'application/pdf', '2025-06-04 09:41:49', '2025-06-04 09:41:49');
INSERT INTO `dokumen_lamaran` VALUES (45, 306, 27, 'ijazah', 'ijazah_25_1749001224.pdf', 43, 'application/pdf', '2025-06-04 09:41:50', '2025-06-04 09:41:50');
INSERT INTO `dokumen_lamaran` VALUES (46, 306, 28, 'cv', 'cv_25_1749001224.pdf', 0, 'application/pdf', '2025-06-04 09:41:50', '2025-06-04 09:41:50');
INSERT INTO `dokumen_lamaran` VALUES (47, 306, 32, 'lainnya', 'lainnya_25_1749001310.jpg', 186, 'image/jpeg', '2025-06-04 09:41:50', '2025-06-04 09:41:50');
INSERT INTO `dokumen_lamaran` VALUES (48, 306, 29, 'transkrip', 'transkrip_25_1749001239.pdf', 43, 'application/pdf', '2025-06-04 09:41:50', '2025-06-04 09:41:50');
INSERT INTO `dokumen_lamaran` VALUES (49, 306, 30, 'sertifikat', 'sertifikat_25_1749001239.pdf', 43, 'application/pdf', '2025-06-04 09:41:50', '2025-06-04 09:41:50');
INSERT INTO `dokumen_lamaran` VALUES (50, 306, 31, 'foto', 'foto_25_1749001262.jpg', 186, 'image/jpeg', '2025-06-04 09:41:50', '2025-06-04 09:41:50');

-- ----------------------------
-- Table structure for dokumen_lowongan
-- ----------------------------
DROP TABLE IF EXISTS `dokumen_lowongan`;
CREATE TABLE `dokumen_lowongan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_lowongan` int NOT NULL,
  `jenis_dokumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_dokumen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wajib` tinyint(1) NOT NULL DEFAULT 1,
  `format_diizinkan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pdf|doc|docx|jpg|jpeg|png',
  `ukuran_maksimal` int NOT NULL DEFAULT 2048,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_lowongan`(`id_lowongan` ASC) USING BTREE,
  CONSTRAINT `fk_dokumen_lowongan_lowongan` FOREIGN KEY (`id_lowongan`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of dokumen_lowongan
-- ----------------------------
INSERT INTO `dokumen_lowongan` VALUES (1, 1, 'CV', 'Curriculum Vitae', 1, 'pdf|doc|docx|jpg|jpeg|png', 2048, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_lowongan` VALUES (2, 1, 'Portofolio', 'Portofolio Anyaman', 1, 'pdf|doc|docx|jpg|jpeg|png', 2048, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_lowongan` VALUES (3, 2, 'CV', 'Curriculum Vitae', 1, 'pdf|doc|docx|jpg|jpeg|png', 2048, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_lowongan` VALUES (24, 2, 'transkrip', 'Transkrip Nilai', 1, 'pdf', 2048, 'Unggah scan transkrip nilai pendidikan terakhir.', '2025-05-27 12:58:15', '2025-05-27 12:58:15');
INSERT INTO `dokumen_lowongan` VALUES (25, 2, 'lainnya', 'Hasil Kerajinan', 1, 'pdf|doc|docx|jpg|jpeg|png', 2048, '', '2025-05-27 12:58:34', '2025-05-27 12:58:34');
INSERT INTO `dokumen_lowongan` VALUES (26, 205, 'ktp', 'KTP (Kartu Tanda Penduduk)', 1, 'pdf|jpg|jpeg|png', 1024, 'Unggah scan atau foto KTP yang masih berlaku dan jelas terbaca.', '2025-06-04 09:30:53', '2025-06-04 09:30:53');
INSERT INTO `dokumen_lowongan` VALUES (27, 205, 'ijazah', 'Ijazah Pendidikan Terakhir', 1, 'pdf', 2048, 'Unggah scan ijazah pendidikan terakhir (minimal SMA/SMK/sederajat).', '2025-06-04 09:30:53', '2025-06-04 09:30:53');
INSERT INTO `dokumen_lowongan` VALUES (28, 205, 'cv', 'Curriculum Vitae (CV)', 1, 'pdf|doc|docx', 2048, 'Unggah CV terbaru yang berisi informasi pendidikan, pengalaman kerja, dan keahlian Anda.', '2025-06-04 09:30:53', '2025-06-04 09:30:53');
INSERT INTO `dokumen_lowongan` VALUES (29, 205, 'transkrip', 'Transkrip Nilai', 0, 'pdf', 2048, 'Unggah scan transkrip nilai pendidikan terakhir.', '2025-06-04 09:30:53', '2025-06-04 09:30:53');
INSERT INTO `dokumen_lowongan` VALUES (30, 205, 'sertifikat', 'Sertifikat Pendukung', 0, 'pdf', 2048, 'Unggah sertifikat pelatihan, kursus, atau sertifikasi yang relevan dengan posisi yang dilamar.', '2025-06-04 09:30:53', '2025-06-04 09:30:53');
INSERT INTO `dokumen_lowongan` VALUES (31, 205, 'foto', 'Pas Foto', 0, 'jpg|jpeg|png', 1024, 'Unggah pas foto terbaru dengan latar belakang berwarna (ukuran 4x6).', '2025-06-04 09:30:53', '2025-06-04 09:30:53');
INSERT INTO `dokumen_lowongan` VALUES (32, 205, 'lainnya', 'Hasil Karya', 1, 'pdf|doc|docx|jpg|jpeg|png', 2048, '', '2025-06-04 09:31:11', '2025-06-04 09:31:11');

-- ----------------------------
-- Table structure for dokumen_pelamar
-- ----------------------------
DROP TABLE IF EXISTS `dokumen_pelamar`;
CREATE TABLE `dokumen_pelamar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pengguna` int NOT NULL,
  `jenis_dokumen` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_dokumen` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ukuran_file` int NOT NULL,
  `tipe_file` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_id_pengguna`(`id_pengguna` ASC) USING BTREE,
  CONSTRAINT `fk_dokumen_pelamar_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of dokumen_pelamar
-- ----------------------------
INSERT INTO `dokumen_pelamar` VALUES (1, 2, 'CV', 'CV Dewi', 'cv_dewi.pdf', 512, 'pdf', '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_pelamar` VALUES (2, 3, 'Portofolio', 'Portofolio Rafi', 'rafi_porto.jpg', 2048, 'jpg', '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `dokumen_pelamar` VALUES (11, 23, 'cv', 'Curriculum Vitae (CV)', 'cv_23_1748320811.pdf', 49, 'application/pdf', '2025-05-27 12:40:11', '2025-05-27 12:40:11');
INSERT INTO `dokumen_pelamar` VALUES (12, 23, 'ktp', 'KTP (Kartu Tanda Penduduk)', 'ktp_23_1748320811.jpg', 17, 'image/jpeg', '2025-05-27 12:40:11', '2025-05-27 12:40:11');
INSERT INTO `dokumen_pelamar` VALUES (13, 23, 'ijazah', 'Ijazah Pendidikan Terakhir', 'ijazah_23_1748320811.pdf', 15, 'application/pdf', '2025-05-27 12:40:11', '2025-05-27 12:40:11');
INSERT INTO `dokumen_pelamar` VALUES (14, 23, 'transkrip', 'Transkrip Nilai', 'transkrip_23_1748320811.pdf', 15, 'application/pdf', '2025-05-27 12:40:11', '2025-05-27 12:40:11');
INSERT INTO `dokumen_pelamar` VALUES (15, 23, 'sertifikat', 'Sertifikat Pendukung', 'sertifikat_23_1748320811.pdf', 15, 'application/pdf', '2025-05-27 12:40:11', '2025-05-27 12:40:11');
INSERT INTO `dokumen_pelamar` VALUES (16, 23, 'foto', 'Pas Foto', 'foto_23_1748320830.jpg', 20, 'image/jpeg', '2025-05-27 12:40:30', '2025-05-27 12:40:30');
INSERT INTO `dokumen_pelamar` VALUES (17, 25, 'cv', 'Curriculum Vitae (CV)', 'cv_25_1749001224.pdf', 43, 'application/pdf', '2025-06-04 09:40:24', '2025-06-04 09:40:24');
INSERT INTO `dokumen_pelamar` VALUES (18, 25, 'ktp', 'KTP (Kartu Tanda Penduduk)', 'ktp_25_1749001224.pdf', 43, 'application/pdf', '2025-06-04 09:40:24', '2025-06-04 09:40:24');
INSERT INTO `dokumen_pelamar` VALUES (19, 25, 'ijazah', 'Ijazah Pendidikan Terakhir', 'ijazah_25_1749001224.pdf', 43, 'application/pdf', '2025-06-04 09:40:24', '2025-06-04 09:40:24');
INSERT INTO `dokumen_pelamar` VALUES (20, 25, 'transkrip', 'Transkrip Nilai', 'transkrip_25_1749001239.pdf', 43, 'application/pdf', '2025-06-04 09:40:39', '2025-06-04 09:40:39');
INSERT INTO `dokumen_pelamar` VALUES (21, 25, 'sertifikat', 'Sertifikat Pendukung', 'sertifikat_25_1749001239.pdf', 43, 'application/pdf', '2025-06-04 09:40:39', '2025-06-04 09:40:39');
INSERT INTO `dokumen_pelamar` VALUES (22, 25, 'foto', 'Pas Foto', 'foto_25_1749001262.jpg', 186, 'image/jpeg', '2025-06-04 09:41:02', '2025-06-04 09:41:02');

-- ----------------------------
-- Table structure for jawaban_pelamar
-- ----------------------------
DROP TABLE IF EXISTS `jawaban_pelamar`;
CREATE TABLE `jawaban_pelamar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penilaian_pelamar` int NOT NULL,
  `id_soal` int NOT NULL,
  `teks_jawaban` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `id_pilihan_terpilih` int NULL DEFAULT NULL,
  `unggah_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nilai` int NULL DEFAULT NULL,
  `dinilai_oleh` int NULL DEFAULT NULL,
  `tanggal_dinilai` timestamp NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ditandai_ragu` tinyint(1) NULL DEFAULT 0 COMMENT 'Tandai soal sebagai ragu-ragu untuk review',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_penilaian_pelamar`(`id_penilaian_pelamar` ASC) USING BTREE,
  INDEX `id_soal`(`id_soal` ASC) USING BTREE,
  INDEX `id_pilihan_terpilih`(`id_pilihan_terpilih` ASC) USING BTREE,
  INDEX `dinilai_oleh`(`dinilai_oleh` ASC) USING BTREE,
  INDEX `idx_jawaban_ditandai_ragu`(`ditandai_ragu` ASC) USING BTREE,
  INDEX `idx_jawaban_penilaian_soal`(`id_penilaian_pelamar` ASC, `id_soal` ASC) USING BTREE,
  CONSTRAINT `jawaban_pelamar_ibfk_1` FOREIGN KEY (`id_penilaian_pelamar`) REFERENCES `penilaian_pelamar` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `jawaban_pelamar_ibfk_2` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `jawaban_pelamar_ibfk_3` FOREIGN KEY (`id_pilihan_terpilih`) REFERENCES `pilihan_soal` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `jawaban_pelamar_ibfk_4` FOREIGN KEY (`dinilai_oleh`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 71 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jawaban_pelamar
-- ----------------------------
INSERT INTO `jawaban_pelamar` VALUES (66, 55, 22, NULL, 39, NULL, NULL, NULL, NULL, '2025-06-04 09:46:26', '2025-06-04 09:46:26', 0);
INSERT INTO `jawaban_pelamar` VALUES (67, 59, 1, NULL, 1, NULL, NULL, NULL, NULL, '2025-06-11 11:07:44', '2025-06-11 11:07:44', 0);
INSERT INTO `jawaban_pelamar` VALUES (68, 59, 19, NULL, 32, NULL, NULL, NULL, NULL, '2025-06-11 11:07:44', '2025-06-11 11:07:44', 0);
INSERT INTO `jawaban_pelamar` VALUES (69, 59, 20, 'Coba', NULL, NULL, 20, 22, '2025-06-11 11:08:50', '2025-06-11 11:07:44', '2025-06-11 14:20:18', 0);
INSERT INTO `jawaban_pelamar` VALUES (70, 59, 21, NULL, 36, NULL, NULL, NULL, NULL, '2025-06-11 11:07:44', '2025-06-11 11:07:44', 0);

-- ----------------------------
-- Table structure for jenis_penilaian
-- ----------------------------
DROP TABLE IF EXISTS `jenis_penilaian`;
CREATE TABLE `jenis_penilaian`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of jenis_penilaian
-- ----------------------------
INSERT INTO `jenis_penilaian` VALUES (1, 'Tes Kerajinan', 'Penilaian dasar keahlian membuat kerajinan', '2025-05-27 12:09:41', '2025-05-27 12:09:41');

-- ----------------------------
-- Table structure for kategori_blog
-- ----------------------------
DROP TABLE IF EXISTS `kategori_blog`;
CREATE TABLE `kategori_blog`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `slug` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `slug`(`slug` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of kategori_blog
-- ----------------------------
INSERT INTO `kategori_blog` VALUES (1, 'Kerajinan', 'kerajinan', 'Berita dan informasi seputar produk kerajinan tangan', '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `kategori_blog` VALUES (2, 'Wisata', 'wisata', 'Informasi wisata budaya dan alam di sekitar galeri', '2025-05-27 12:09:41', '2025-05-27 12:09:41');

-- ----------------------------
-- Table structure for kategori_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `kategori_pekerjaan`;
CREATE TABLE `kategori_pekerjaan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of kategori_pekerjaan
-- ----------------------------
INSERT INTO `kategori_pekerjaan` VALUES (1, 'Kerajinan Tangan', 'Pekerjaan yang berhubungan dengan anyaman, rotan, dan mebel khas Kalimantan Selatan', '2025-05-27 12:09:41', '2025-05-27 12:09:41');

-- ----------------------------
-- Table structure for kategori_post_blog
-- ----------------------------
DROP TABLE IF EXISTS `kategori_post_blog`;
CREATE TABLE `kategori_post_blog`  (
  `id_post` int NOT NULL,
  `id_kategori` int NOT NULL,
  PRIMARY KEY (`id_post`, `id_kategori`) USING BTREE,
  INDEX `id_kategori`(`id_kategori` ASC) USING BTREE,
  CONSTRAINT `kategori_post_blog_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post_blog` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `kategori_post_blog_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_blog` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of kategori_post_blog
-- ----------------------------
INSERT INTO `kategori_post_blog` VALUES (1, 1);
INSERT INTO `kategori_post_blog` VALUES (2, 2);

-- ----------------------------
-- Table structure for lamaran_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `lamaran_pekerjaan`;
CREATE TABLE `lamaran_pekerjaan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pekerjaan` int NOT NULL,
  `id_pelamar` int NOT NULL,
  `surat_lamaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `cv` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('menunggu','direview','wawancara','interview','seleksi','diterima','ditolak') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'menunggu',
  `tanggal_lamaran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `catatan_admin` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pekerjaan`(`id_pekerjaan` ASC) USING BTREE,
  INDEX `id_pelamar`(`id_pelamar` ASC) USING BTREE,
  CONSTRAINT `lamaran_pekerjaan_ibfk_1` FOREIGN KEY (`id_pekerjaan`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `lamaran_pekerjaan_ibfk_2` FOREIGN KEY (`id_pelamar`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 307 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of lamaran_pekerjaan
-- ----------------------------
INSERT INTO `lamaran_pekerjaan` VALUES (1, 1, 2, NULL, NULL, 'direview', '2025-05-27 12:09:41', '2025-05-27 13:09:12', 'zz');
INSERT INTO `lamaran_pekerjaan` VALUES (2, 1, 3, NULL, NULL, 'menunggu', '2025-05-27 12:09:41', '2025-05-27 12:09:41', NULL);
INSERT INTO `lamaran_pekerjaan` VALUES (3, 2, 4, NULL, NULL, 'menunggu', '2025-05-27 12:09:41', '2025-05-27 12:09:41', NULL);
INSERT INTO `lamaran_pekerjaan` VALUES (4, 2, 5, NULL, NULL, 'direview', '2025-05-27 12:09:41', '2025-05-27 13:09:09', NULL);
INSERT INTO `lamaran_pekerjaan` VALUES (305, 2, 23, 'Anooo sumimasen, can i join this club?', 'cv_23_1748320811.pdf', 'direview', '2025-06-03 14:28:37', '2025-06-03 22:18:06', NULL);
INSERT INTO `lamaran_pekerjaan` VALUES (306, 205, 25, 'asd', 'cv_25_1749001224.pdf', 'diterima', '2025-06-04 03:41:49', '2025-06-04 03:48:36', 'Esok langsung masujkk begawi');

-- ----------------------------
-- Table structure for lowongan_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `lowongan_pekerjaan`;
CREATE TABLE `lowongan_pekerjaan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_kategori` int NULL DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `persyaratan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tanggung_jawab` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `lokasi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_pekerjaan` enum('penuh_waktu','paruh_waktu','kontrak','magang') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rentang_gaji` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `batas_waktu` date NULL DEFAULT NULL,
  `jumlah_lowongan` int NULL DEFAULT 1,
  `unggulan` tinyint(1) NULL DEFAULT 0,
  `status` enum('aktif','ditutup','draft') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'draft',
  `dibuat_oleh` int NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_kategori`(`id_kategori` ASC) USING BTREE,
  INDEX `dibuat_oleh`(`dibuat_oleh` ASC) USING BTREE,
  CONSTRAINT `lowongan_pekerjaan_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_pekerjaan` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `lowongan_pekerjaan_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 207 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of lowongan_pekerjaan
-- ----------------------------
INSERT INTO `lowongan_pekerjaan` VALUES (1, 'Pengrajin Anyaman Eceng Gondok', 1, 'Bergabung dengan tim kreatif kami dalam membuat kerajinan tangan berbahan eceng gondok.', 'Memiliki pengalaman dasar anyaman, domisili Kalimantan Selatan.', 'Membuat produk anyaman, menjaga kualitas hasil kerja.', 'Desa Banyu Hirang', 'penuh_waktu', 'Rp2.000.000 - Rp3.500.000', '2025-07-30', 3, 0, 'aktif', 1, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `lowongan_pekerjaan` VALUES (2, 'Perajin Mebel Artistik', 1, 'Membuat mebel dari bahan lokal dengan desain etnik.', 'Menguasai teknik dasar pertukangan kayu, jujur, dan teliti.', 'Mengerjakan proyek mebel seperti kursi dan meja khas.', 'Amuntai Selatan', 'kontrak', 'Rp3.000.000 - Rp4.500.000', '2025-08-15', 2, 0, 'aktif', 1, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `lowongan_pekerjaan` VALUES (205, 'Pengrajin', 1, 'Pengrajin', 'Usia 50\r\nBisa menganyam', 'Bisa menganyam', 'Gallery Kembang Ilung', 'penuh_waktu', 'Rp. 3.000.000', '2025-06-26', 1, 0, 'aktif', 1, '2025-06-04 09:30:40', '2025-06-04 09:34:26');
INSERT INTO `lowongan_pekerjaan` VALUES (206, 'Pelukis', 1, 'Mencat hasil anyaman', '-minimal lulusan smk/sma sederajat\r\n-good loking', '-ngecat', 'Gallery Kembang Ilung', '', 'Rp. 3.000.000', '2025-10-06', 1, 0, '', 1, '2025-06-04 21:56:44', '2025-06-04 21:56:44');

-- ----------------------------
-- Table structure for notifikasi
-- ----------------------------
DROP TABLE IF EXISTS `notifikasi`;
CREATE TABLE `notifikasi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pengguna` int NOT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pesan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis` enum('lamaran_baru','status_lamaran','sistem','registrasi_pengguna','jadwal_interview','penilaian','lowongan_baru') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'sistem' COMMENT 'Jenis notifikasi',
  `prioritas` enum('rendah','normal','tinggi','urgent') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'normal' COMMENT 'Tingkat prioritas notifikasi',
  `status` enum('belum_dibaca','dibaca','diarsipkan') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'belum_dibaca' COMMENT 'Status baca notifikasi',
  `id_referensi` int UNSIGNED NULL DEFAULT NULL COMMENT 'ID referensi ke tabel terkait',
  `tabel_referensi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Nama tabel referensi',
  `url_aksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'URL untuk aksi notifikasi',
  `icon` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Icon class untuk notifikasi',
  `warna` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Warna tema notifikasi',
  `dibaca_pada` timestamp NULL DEFAULT NULL COMMENT 'Waktu notifikasi dibaca',
  `kedaluwarsa_pada` timestamp NULL DEFAULT NULL COMMENT 'Waktu kedaluwarsa notifikasi',
  `dibuat_oleh` int UNSIGNED NULL DEFAULT NULL COMMENT 'ID pengguna yang membuat notifikasi',
  `sudah_dibaca` tinyint(1) NULL DEFAULT 0,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pengguna`(`id_pengguna` ASC) USING BTREE,
  INDEX `idx_jenis`(`jenis` ASC) USING BTREE,
  INDEX `idx_status`(`status` ASC) USING BTREE,
  INDEX `idx_prioritas`(`prioritas` ASC) USING BTREE,
  INDEX `idx_dibuat_pada`(`dibuat_pada` ASC) USING BTREE,
  INDEX `idx_referensi`(`id_referensi` ASC, `tabel_referensi` ASC) USING BTREE,
  CONSTRAINT `fk_notifikasi_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of notifikasi
-- ----------------------------
INSERT INTO `notifikasi` VALUES (6, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Status lamaran Anda telah diperbarui menjadi: Reviewed', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:06:43');
INSERT INTO `notifikasi` VALUES (7, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Status lamaran Anda telah diperbarui menjadi: Reviewed', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:06:49');
INSERT INTO `notifikasi` VALUES (8, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Selamat! Anda lolos ke tahap seleksi.', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:06:54');
INSERT INTO `notifikasi` VALUES (9, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Anda telah dijadwalkan untuk wawancara.', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:06:58');
INSERT INTO `notifikasi` VALUES (10, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Selamat! Lamaran Anda diterima.', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:07:01');
INSERT INTO `notifikasi` VALUES (11, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Mohon maaf, lamaran Anda tidak dapat kami proses lebih lanjut.', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:07:04');
INSERT INTO `notifikasi` VALUES (12, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Status lamaran Anda telah diperbarui menjadi: Reviewed', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:07:08');
INSERT INTO `notifikasi` VALUES (13, 2, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Pengrajin Anyaman Eceng Gondok telah diperbarui. Status lamaran Anda telah diperbarui menjadi: Reviewed', 'status_lamaran', 'normal', 'belum_dibaca', 1, 'lamaran_pekerjaan', 'pelamar/lamaran/1', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:07:15');
INSERT INTO `notifikasi` VALUES (14, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Status lamaran Anda telah diperbarui menjadi: Reviewed', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:08:37');
INSERT INTO `notifikasi` VALUES (15, 5, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Lamaran Anda sedang ditinjau oleh tim HR.', 'status_lamaran', 'normal', 'belum_dibaca', 4, 'lamaran_pekerjaan', 'pelamar/lamaran/4', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:09:09');
INSERT INTO `notifikasi` VALUES (16, 2, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Pengrajin Anyaman Eceng Gondok telah diperbarui. Lamaran Anda sedang ditinjau oleh tim HR.', 'status_lamaran', 'normal', 'belum_dibaca', 1, 'lamaran_pekerjaan', 'pelamar/lamaran/1', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-05-27 13:09:13');
INSERT INTO `notifikasi` VALUES (17, 1, 'Lamaran Baru Diterima', 'Lamaran baru telah diterima untuk posisi Perajin Mebel Artistik dari Bayu Anyaman. Silakan tinjau dan proses lamaran ini.', 'lamaran_baru', 'normal', 'belum_dibaca', 305, 'lamaran_pekerjaan', 'admin/detail_lamaran/305', 'ni ni-briefcase-24', 'info', NULL, NULL, NULL, 0, '2025-06-03 20:28:37');
INSERT INTO `notifikasi` VALUES (18, 23, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Status lamaran Anda telah diperbarui menjadi: Menunggu', 'status_lamaran', 'normal', 'belum_dibaca', 305, 'lamaran_pekerjaan', 'pelamar/lamaran/305', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-06-03 22:18:03');
INSERT INTO `notifikasi` VALUES (19, 23, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Perajin Mebel Artistik telah diperbarui. Lamaran Anda sedang ditinjau oleh tim HR.', 'status_lamaran', 'normal', 'belum_dibaca', 305, 'lamaran_pekerjaan', 'pelamar/lamaran/305', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-06-03 22:18:06');
INSERT INTO `notifikasi` VALUES (20, 1, 'Lamaran Baru Diterima', 'Lamaran baru telah diterima untuk posisi Pengrajin dari Fauzi. Silakan tinjau dan proses lamaran ini.', 'lamaran_baru', 'normal', 'belum_dibaca', 306, 'lamaran_pekerjaan', 'admin/detail_lamaran/306', 'ni ni-briefcase-24', 'info', NULL, NULL, NULL, 0, '2025-06-04 09:41:50');
INSERT INTO `notifikasi` VALUES (21, 25, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Pengrajin telah diperbarui. Lamaran Anda sedang ditinjau oleh tim HR.', 'status_lamaran', 'normal', 'belum_dibaca', 306, 'lamaran_pekerjaan', 'pelamar/lamaran/306', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-06-04 09:42:11');
INSERT INTO `notifikasi` VALUES (22, 25, 'Update Status Lamaran', 'Status lamaran Anda untuk posisi Pengrajin telah diperbarui. Selamat! Anda lolos ke tahap seleksi.', 'status_lamaran', 'normal', 'belum_dibaca', 306, 'lamaran_pekerjaan', 'pelamar/lamaran/306', 'ni ni-check-bold', 'success', NULL, NULL, 1, 0, '2025-06-04 09:43:37');

-- ----------------------------
-- Table structure for pengaturan_notifikasi
-- ----------------------------
DROP TABLE IF EXISTS `pengaturan_notifikasi`;
CREATE TABLE `pengaturan_notifikasi`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pengguna` int UNSIGNED NOT NULL,
  `jenis_notifikasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `email_notifikasi` tinyint(1) NOT NULL DEFAULT 0,
  `whatsapp_notifikasi` tinyint(1) NOT NULL DEFAULT 0,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_id_pengguna`(`id_pengguna` ASC) USING BTREE,
  INDEX `idx_jenis_notifikasi`(`jenis_notifikasi` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Pengaturan notifikasi pengguna' ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of pengaturan_notifikasi
-- ----------------------------

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` enum('admin','staff','pelamar','hrd','direktur') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `foto_profil` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `login_terakhir` timestamp NULL DEFAULT NULL,
  `status` enum('aktif','nonaktif','diblokir') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'aktif',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `nama_pengguna`(`nama_pengguna` ASC) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'admin', 'seni01@galleryilung.id', '$2y$10$0qnU/2eJW.SSrLr38v7c7.JUOa4KBfWEFi/Hn2f0AJtZUgQ2YOSVy', 'admin', 'Admin Kembang Ilung', '082155000101', 'Desa Banyu Hirang', NULL, '2025-05-27 12:09:41', '2025-06-11 13:48:31', '2025-06-11 13:48:31', 'aktif');
INSERT INTO `pengguna` VALUES (2, 'user1', 'pengrajin1@galleryilung.id', '$2y$10$0qnU/2eJW.SSrLr38v7c7.JUOa4KBfWEFi/Hn2f0AJtZUgQ2YOSVy', 'pelamar', 'Dewi Anyaman', '082155000102', 'Amuntai Selatan', NULL, '2025-05-27 12:09:41', '2025-05-27 12:46:57', NULL, 'aktif');
INSERT INTO `pengguna` VALUES (3, 'user2', 'pengrajin2@galleryilung.id', '$2y$10$0qnU/2eJW.SSrLr38v7c7.JUOa4KBfWEFi/Hn2f0AJtZUgQ2YOSVy', 'pelamar', 'Rafi Ukiran', '082155000103', 'Banyu Hirang', NULL, '2025-05-27 12:09:41', '2025-05-27 12:47:02', NULL, 'aktif');
INSERT INTO `pengguna` VALUES (4, 'user3', 'pengrajin3@galleryilung.id', '$2y$10$0qnU/2eJW.SSrLr38v7c7.JUOa4KBfWEFi/Hn2f0AJtZUgQ2YOSVy', 'pelamar', 'Siti Rotan', '082155000104', 'Hulu Sungai Tengah', NULL, '2025-05-27 12:09:41', '2025-05-27 12:47:05', NULL, 'aktif');
INSERT INTO `pengguna` VALUES (5, 'user4', 'pengrajin4@galleryilung.id', '$2y$10$0qnU/2eJW.SSrLr38v7c7.JUOa4KBfWEFi/Hn2f0AJtZUgQ2YOSVy', 'pelamar', 'Budi Bambu', '082155000105', 'Barabai', NULL, '2025-05-27 12:09:41', '2025-05-27 12:47:06', NULL, 'aktif');
INSERT INTO `pengguna` VALUES (22, 'hrdgki', 'hrdgki@gmail.coms', '$2y$10$0qnU/2eJW.SSrLr38v7c7.JUOa4KBfWEFi/Hn2f0AJtZUgQ2YOSVy', 'hrd', 'HRD Gallery Kembang Ilung', '081256180502', 'marabahans', 'profile_1748320017_8263.jpg', '2025-05-27 06:26:57', '2025-06-11 11:08:12', '2025-06-11 11:08:12', 'aktif');
INSERT INTO `pengguna` VALUES (23, 'bayu', 'bayu@gmail.com', '$2y$10$XrbJ66n0VmHvBuIMwccxc.gT4ikRNTvH3iS5d/f9BwmI14J9jbxKG', 'pelamar', 'Bayu Anyaman', '081256180502', 'Jl. Jendral Sudirman  No. 10', 'profile_23_1748320811.jpg', '2025-05-27 06:28:25', '2025-06-11 11:09:02', '2025-06-11 11:09:02', 'aktif');
INSERT INTO `pengguna` VALUES (24, 'direkturgki', 'direktur.gki@mail.com', '$2y$10$5PPm1NqxZemKtFcaKwMEweoMHTSlxgtQUfJNfGYZs2sQeGslTacY6', 'direktur', 'Direktur Gallery Kembang Ilung', '', '', 'profile_1748952019_1060.jpg', '2025-06-03 14:00:19', '2025-06-11 10:49:19', '2025-06-11 10:49:19', 'aktif');
INSERT INTO `pengguna` VALUES (25, 'fauzi', 'fauzi@fauzi.com', '$2y$10$PsMFzRzcAg5mz4dibXqFEurqE5GWiqIlA0Q1pAF.GUeQNOPeuYobW', 'pelamar', 'Fauzi', '1123123', 'asd', 'profile_25_1749001280.jpg', '2025-06-04 03:33:14', '2025-06-04 13:28:09', '2025-06-04 07:28:09', 'aktif');

-- ----------------------------
-- Table structure for penilaian
-- ----------------------------
DROP TABLE IF EXISTS `penilaian`;
CREATE TABLE `penilaian`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` int NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `petunjuk` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `batas_waktu` int NULL DEFAULT NULL,
  `nilai_lulus` int NULL DEFAULT NULL,
  `aktif` tinyint(1) NULL DEFAULT 1,
  `maksimal_percobaan` int NULL DEFAULT 1,
  `dibuat_oleh` int NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acak_soal` tinyint(1) NULL DEFAULT 0 COMMENT 'Aktifkan pengacakan urutan soal untuk setiap peserta',
  `mode_cat` tinyint(1) NULL DEFAULT 0 COMMENT 'Aktifkan mode CAT (Computer Adaptive Test) interface',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_jenis`(`id_jenis` ASC) USING BTREE,
  INDEX `dibuat_oleh`(`dibuat_oleh` ASC) USING BTREE,
  INDEX `idx_penilaian_mode_cat`(`mode_cat` ASC) USING BTREE,
  INDEX `idx_penilaian_acak_soal`(`acak_soal` ASC) USING BTREE,
  CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_penilaian` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of penilaian
-- ----------------------------
INSERT INTO `penilaian` VALUES (1, 'Tes Anyaman Dasar', 1, 'Tes dasar pengetahuan kerajinan anyaman', NULL, NULL, 70, 1, 1, 1, '2025-05-27 12:09:41', '2025-05-27 12:09:41', 0, 0);
INSERT INTO `penilaian` VALUES (6, 'Kerajinan', 1, 'asd', 'Berdoa', 10, 100, 1, 1, 1, '2025-06-04 03:32:14', '2025-06-04 03:45:13', 0, 0);

-- ----------------------------
-- Table structure for penilaian_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `penilaian_pekerjaan`;
CREATE TABLE `penilaian_pekerjaan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pekerjaan` int NOT NULL,
  `id_penilaian` int NOT NULL,
  `wajib` tinyint(1) NULL DEFAULT 1,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pekerjaan`(`id_pekerjaan` ASC) USING BTREE,
  INDEX `id_penilaian`(`id_penilaian` ASC) USING BTREE,
  CONSTRAINT `penilaian_pekerjaan_ibfk_1` FOREIGN KEY (`id_pekerjaan`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `penilaian_pekerjaan_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of penilaian_pekerjaan
-- ----------------------------
INSERT INTO `penilaian_pekerjaan` VALUES (1, 1, 1, 1, '2025-05-27 12:09:41', '2025-05-27 12:09:41');

-- ----------------------------
-- Table structure for penilaian_pelamar
-- ----------------------------
DROP TABLE IF EXISTS `penilaian_pelamar`;
CREATE TABLE `penilaian_pelamar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_lamaran` int NOT NULL,
  `id_penilaian` int NOT NULL,
  `waktu_mulai` timestamp NULL DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL,
  `nilai` int NULL DEFAULT NULL,
  `status` enum('belum_mulai','sedang_berlangsung','selesai','sudah_dinilai') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'belum_mulai',
  `ditugaskan_pada` timestamp NULL DEFAULT NULL,
  `ditugaskan_oleh` int NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggal_penilaian` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_lamaran`(`id_lamaran` ASC) USING BTREE,
  INDEX `id_penilaian`(`id_penilaian` ASC) USING BTREE,
  INDEX `ditugaskan_oleh`(`ditugaskan_oleh` ASC) USING BTREE,
  CONSTRAINT `penilaian_pelamar_ibfk_1` FOREIGN KEY (`id_lamaran`) REFERENCES `lamaran_pekerjaan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `penilaian_pelamar_ibfk_2` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `penilaian_pelamar_ibfk_3` FOREIGN KEY (`ditugaskan_oleh`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of penilaian_pelamar
-- ----------------------------
INSERT INTO `penilaian_pelamar` VALUES (55, 306, 6, '2025-06-04 03:46:19', '2025-06-04 03:46:26', 100, 'selesai', '2025-06-04 03:46:10', 1, '2025-06-04 03:46:10', '2025-06-04 09:46:26', NULL);
INSERT INTO `penilaian_pelamar` VALUES (56, 306, 1, NULL, NULL, NULL, 'belum_mulai', '2025-06-05 03:04:59', 22, '2025-06-05 03:04:59', '2025-06-05 09:04:59', NULL);
INSERT INTO `penilaian_pelamar` VALUES (57, 305, 6, '2025-06-11 11:06:11', NULL, NULL, '', '2025-06-10 01:24:57', 1, '2025-06-10 01:24:57', '2025-06-11 11:06:11', NULL);
INSERT INTO `penilaian_pelamar` VALUES (58, 1, 6, NULL, NULL, NULL, 'belum_mulai', '2025-06-10 01:24:57', 1, '2025-06-10 01:24:57', '2025-06-10 07:24:57', NULL);
INSERT INTO `penilaian_pelamar` VALUES (59, 305, 1, '2025-06-11 11:07:23', '2025-06-11 11:07:44', 19, 'sudah_dinilai', '2025-06-10 04:58:33', 1, '2025-06-10 04:58:33', '2025-06-11 11:08:57', '2025-06-11 11:07:00');

-- ----------------------------
-- Table structure for pilihan_soal
-- ----------------------------
DROP TABLE IF EXISTS `pilihan_soal`;
CREATE TABLE `pilihan_soal`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_soal` int NOT NULL,
  `teks_pilihan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `benar` tinyint(1) NULL DEFAULT 0,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_soal`(`id_soal` ASC) USING BTREE,
  CONSTRAINT `pilihan_soal_ibfk_1` FOREIGN KEY (`id_soal`) REFERENCES `soal` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of pilihan_soal
-- ----------------------------
INSERT INTO `pilihan_soal` VALUES (1, 1, 'Kertas', 0, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `pilihan_soal` VALUES (2, 1, 'Plastik', 0, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `pilihan_soal` VALUES (3, 1, 'Eceng Gondok', 1, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `pilihan_soal` VALUES (4, 1, 'Bambu', 0, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `pilihan_soal` VALUES (31, 19, 'Hiasan dinding', 1, '2025-05-27 07:10:25', '2025-05-27 13:10:25');
INSERT INTO `pilihan_soal` VALUES (32, 19, 'Set Kursi', 0, '2025-05-27 07:10:25', '2025-05-27 13:10:25');
INSERT INTO `pilihan_soal` VALUES (33, 19, 'Bambu', 0, '2025-05-27 07:10:25', '2025-05-27 13:10:25');
INSERT INTO `pilihan_soal` VALUES (34, 19, 'Ilung', 0, '2025-05-27 07:10:25', '2025-05-27 13:10:25');
INSERT INTO `pilihan_soal` VALUES (35, 21, 'Anyaman', 1, '2025-05-27 07:13:34', '2025-05-27 13:13:34');
INSERT INTO `pilihan_soal` VALUES (36, 21, 'Ilung', 0, '2025-05-27 07:13:34', '2025-05-27 13:13:34');
INSERT INTO `pilihan_soal` VALUES (37, 21, 'Rotan', 0, '2025-05-27 07:13:34', '2025-05-27 13:13:34');
INSERT INTO `pilihan_soal` VALUES (38, 21, 'Bambu', 0, '2025-05-27 07:13:34', '2025-05-27 13:13:34');
INSERT INTO `pilihan_soal` VALUES (39, 22, 'asd', 1, '2025-06-04 03:32:31', '2025-06-04 09:32:31');
INSERT INTO `pilihan_soal` VALUES (40, 22, 'asd', 0, '2025-06-04 03:32:31', '2025-06-04 09:32:31');
INSERT INTO `pilihan_soal` VALUES (41, 22, 'asd', 0, '2025-06-04 03:32:31', '2025-06-04 09:32:31');
INSERT INTO `pilihan_soal` VALUES (42, 22, 'asd', 0, '2025-06-04 03:32:31', '2025-06-04 09:32:31');

-- ----------------------------
-- Table structure for post_blog
-- ----------------------------
DROP TABLE IF EXISTS `post_blog`;
CREATE TABLE `post_blog`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `konten` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `gambar_utama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` enum('dipublikasi','draft') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'draft',
  `tampilan` int NULL DEFAULT 0,
  `id_penulis` int NOT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `slug`(`slug` ASC) USING BTREE,
  INDEX `id_penulis`(`id_penulis` ASC) USING BTREE,
  CONSTRAINT `post_blog_ibfk_1` FOREIGN KEY (`id_penulis`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of post_blog
-- ----------------------------
INSERT INTO `post_blog` VALUES (1, 'Keindahan Anyaman dari Kembang Ilung', 'keindahan-anyaman-kembang-ilung', 'Gallery Kembang Ilung mengangkat keunikan kerajinan tangan eceng gondok ke panggung nasional.', 'blog_1748319019.jpg', 'dipublikasi', 0, 1, '2025-05-27 12:09:41', '2025-05-27 06:10:19');
INSERT INTO `post_blog` VALUES (2, 'Rumah Terapung: Wisata Budaya dan Alam', 'rumah-terapung-galeri', 'Destinasi wisata budaya dengan rumah terapung di Desa Banyu Hirang menjadi magnet pengunjung.', 'blog_1748319052.jpg', 'dipublikasi', 1, 1, '2025-05-27 12:09:41', '2025-05-27 06:10:52');

-- ----------------------------
-- Table structure for profil_pelamar
-- ----------------------------
DROP TABLE IF EXISTS `profil_pelamar`;
CREATE TABLE `profil_pelamar`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pengguna` int NOT NULL,
  `tanggal_lahir` date NULL DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan','lainnya') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pendidikan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `pengalaman` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `keahlian` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `cv` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `surat_lamaran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `url_linkedin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url_portofolio` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pengguna`(`id_pengguna` ASC) USING BTREE,
  CONSTRAINT `profil_pelamar_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of profil_pelamar
-- ----------------------------
INSERT INTO `profil_pelamar` VALUES (1, 2, '1995-04-21', 'perempuan', 'SMK Seni Kriya', '3 tahun membuat anyaman rotan.', 'Anyaman tangan, desain produk', NULL, NULL, NULL, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `profil_pelamar` VALUES (2, 3, '1992-06-10', 'laki-laki', 'SMA', '2 tahun sebagai pengrajin', 'Eceng gondok, rotan, bambu', NULL, NULL, NULL, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `profil_pelamar` VALUES (3, 4, '1990-12-05', 'perempuan', 'Diploma Seni Rupa', '5 tahun sebagai perajin anyaman.', 'Rotan artistik, seni dekoratif', NULL, NULL, NULL, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `profil_pelamar` VALUES (4, 5, '1988-09-11', 'laki-laki', 'SMA Pertukangan', '4 tahun tukang mebel lokal.', 'Kayu ulin, finishing furniture', NULL, NULL, NULL, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `profil_pelamar` VALUES (20, 23, '2025-05-28', 'laki-laki', 'S-1 UNISKA', 'Pengrajin Anyaman 10 tahun', 'Pengrajin', 'cv_23_1748320811.pdf', NULL, 'http://localhost/sirek/pelamar/profil', 'http://localhost/sirek/pelamar/profil', '2025-05-27 12:28:25', '2025-05-27 12:40:11');
INSERT INTO `profil_pelamar` VALUES (21, 25, '2025-06-17', 'perempuan', 'asd', 'asd', 'asd', 'cv_25_1749001224.pdf', NULL, 'http://localhost/sirek/pelamar/profil', 'http://localhost/sirek/pelamar/profil', '2025-06-04 09:33:14', '2025-06-04 09:41:02');

-- ----------------------------
-- Table structure for soal
-- ----------------------------
DROP TABLE IF EXISTS `soal`;
CREATE TABLE `soal`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penilaian` int NOT NULL,
  `teks_soal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis_soal` enum('pilihan_ganda','benar_salah','esai','unggah_file') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `poin` int NULL DEFAULT 1,
  `gambar_soal` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dibuat_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diperbarui_pada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_penilaian`(`id_penilaian` ASC) USING BTREE,
  CONSTRAINT `soal_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of soal
-- ----------------------------
INSERT INTO `soal` VALUES (1, 1, 'Apa bahan utama dalam produk Kembang Ilung?', 'pilihan_ganda', 1, NULL, '2025-05-27 12:09:41', '2025-05-27 12:09:41');
INSERT INTO `soal` VALUES (19, 1, 'Disebut apa anyaman ini', 'pilihan_ganda', 1, 'question_1748322613_6806.jpg', '2025-05-27 07:10:13', '2025-05-27 13:10:13');
INSERT INTO `soal` VALUES (20, 1, 'Apa itu Gallery Kembang Ilung', 'esai', 100, 'question_1748322680_3607.png', '2025-05-27 07:11:20', '2025-05-27 07:11:31');
INSERT INTO `soal` VALUES (21, 1, 'Yang termasuk kerajinan tangan', 'pilihan_ganda', 1, NULL, '2025-05-27 07:13:23', '2025-05-27 13:13:23');
INSERT INTO `soal` VALUES (22, 6, 'asdasdasdas', 'pilihan_ganda', 1, NULL, '2025-06-04 03:32:25', '2025-06-04 09:32:25');

-- ----------------------------
-- View structure for pekerjaan
-- ----------------------------
DROP VIEW IF EXISTS `pekerjaan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `pekerjaan` AS SELECT 
    id,
    judul,
    id_kategori,
    deskripsi,
    persyaratan,
    tanggung_jawab,
    lokasi,
    jenis_pekerjaan,
    rentang_gaji,
    batas_waktu,
    jumlah_lowongan,
    unggulan,
    status,
    dibuat_oleh,
    dibuat_pada,
    diperbarui_pada
FROM lowongan_pekerjaan ; ;

SET FOREIGN_KEY_CHECKS = 1;
