-- Database rental_mobil lengkap
-- Hapus database lama kalau ada
DROP DATABASE IF EXISTS rental_mobil;

-- Buat database baru
CREATE DATABASE rental_mobil;
USE rental_mobil;

-- Tabel user
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'petugas', 'peminjam') DEFAULT 'peminjam',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel alat (mobil)
CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100) NOT NULL,
    stok INT DEFAULT 0,
    harga DECIMAL(10,2) NOT NULL,
    status ENUM('tersedia', 'disewa', 'maintenance') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel peminjaman
CREATE TABLE peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_alat INT NOT NULL,
    nama_peminjam VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    lama_sewa INT NOT NULL,
    total_harga DECIMAL(10,2) NOT NULL,
    status ENUM('dipinjam', 'dikembalikan', 'terlambat') DEFAULT 'dipinjam',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data user (3 role berbeda)
INSERT INTO user (username, password, role) VALUES 
('admin', 'admin123', 'admin'),
('petugas', 'petugas123', 'petugas'),
('peminjam', 'peminjam123', 'peminjam'),
('user', 'user123', 'peminjam');

-- Insert data mobil
INSERT INTO alat (nama_alat, stok, harga, status) VALUES 
('Toyota Avanza', 5, 350000, 'tersedia'),
('Honda Jazz', 3, 400000, 'tersedia'),
('Mitsubishi Xpander', 4, 450000, 'tersedia'),
('Daihatsu Terios', 2, 380000, 'tersedia'),
('Suzuki Ertiga', 3, 340000, 'tersedia'),
('Toyota Innova', 2, 500000, 'tersedia'),
('Honda CR-V', 2, 550000, 'tersedia'),
('Daihatsu Sigra', 4, 300000, 'tersedia');

-- Insert data peminjaman contoh
INSERT INTO peminjaman (id_user, id_alat, nama_peminjam, no_hp, tanggal_pinjam, tanggal_kembali, lama_sewa, total_harga, status) VALUES 
(1, 1, 'Budi Santoso', '081234567890', '2026-02-01', '2026-02-04', 3, 1050000, 'dipinjam'),
(1, 2, 'Siti Aminah', '081234567891', '2026-02-05', '2026-02-07', 2, 800000, 'dikembalikan'),
(3, 3, 'Ahmad Rizki', '081234567892', '2026-02-08', '2026-02-10', 2, 900000, 'dipinjam'),
(3, 5, 'Dewi Lestari', '081234567893', '2026-02-06', '2026-02-09', 3, 1020000, 'dikembalikan');

-- Selesai!
SELECT 'Database rental_mobil berhasil dibuat!' as Status;
