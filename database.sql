-- Database rental_mobil
CREATE DATABASE IF NOT EXISTS rental_mobil;
USE rental_mobil;

-- Tabel user
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel alat (mobil)
CREATE TABLE IF NOT EXISTS alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100) NOT NULL,
    stok INT DEFAULT 0,
    harga DECIMAL(10,2) NOT NULL,
    status ENUM('tersedia', 'disewa', 'maintenance') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data user default
INSERT INTO user (username, password, role) VALUES 
('admin', 'admin123', 'admin'),
('user', 'user123', 'user');

-- Insert data mobil contoh
INSERT INTO alat (nama_alat, stok, harga, status) VALUES 
('Toyota Avanza', 5, 350000, 'tersedia'),
('Honda Jazz', 3, 400000, 'tersedia'),
('Mitsubishi Xpander', 4, 450000, 'tersedia'),
('Daihatsu Terios', 2, 380000, 'tersedia'),
('Suzuki Ertiga', 3, 340000, 'tersedia');
