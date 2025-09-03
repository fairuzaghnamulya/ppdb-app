-- SQL schema for PPDB application

-- Table for user authentication and roles
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('siswa', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for prospective students' personal data
CREATE TABLE calon_siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nama VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    alamat TEXT NOT NULL,
    no_telepon VARCHAR(15),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table for parents' data
CREATE TABLE data_orangtua (
    id INT AUTO_INCREMENT PRIMARY KEY,
    calon_siswa_id INT NOT NULL,
    nama_ayah VARCHAR(100) NOT NULL,
    nama_ibu VARCHAR(100) NOT NULL,
    pekerjaan_ayah VARCHAR(100),
    pekerjaan_ibu VARCHAR(100),
    FOREIGN KEY (calon_siswa_id) REFERENCES calon_siswa(id) ON DELETE CASCADE
);

-- Table for tracking uploaded documents and their verification status
CREATE TABLE dokumen_siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    calon_siswa_id INT NOT NULL,
    nama_dokumen VARCHAR(100) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    status_verifikasi ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (calon_siswa_id) REFERENCES calon_siswa(id) ON DELETE CASCADE
);

-- Table for registration settings such as dates and quotas
CREATE TABLE pengaturan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    kuota INT NOT NULL
);

-- Table for announcements related to the registration process
CREATE TABLE pengumuman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    isi TEXT NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data for users
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('siswa1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'siswa');

-- Sample data for calon_siswa
INSERT INTO calon_siswa (user_id, nama, tanggal_lahir, jenis_kelamin, alamat, no_telepon) VALUES
(2, 'Budi Santoso', '2005-05-15', 'L', 'Jl. Merdeka No. 1', '08123456789');

-- Sample data for data_orangtua
INSERT INTO data_orangtua (calon_siswa_id, nama_ayah, nama_ibu, pekerjaan_ayah, pekerjaan_ibu) VALUES
(1, 'Joko Santoso', 'Siti Aminah', 'Petani', 'Ibu Rumah Tangga');

-- Sample data for pengaturan
INSERT INTO pengaturan (tanggal_mulai, tanggal_selesai, kuota) VALUES
('2023-06-01', '2023-06-30', 100);

-- Sample data for pengumuman
INSERT INTO pengumuman (judul, isi) VALUES
('Pendaftaran Dibuka!', 'Pendaftaran peserta didik baru tahun ajaran 2023/2024 dibuka mulai 1 Juni hingga 30 Juni 2023.');