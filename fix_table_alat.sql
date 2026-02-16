-- Backup data lama (kalau ada)
CREATE TABLE IF NOT EXISTS alat_backup AS SELECT * FROM alat;

-- Drop tabel lama
DROP TABLE IF EXISTS alat;

-- Buat tabel baru dengan struktur yang benar
CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(100) NOT NULL,
    stok INT DEFAULT 0,
    harga DECIMAL(10,2) NOT NULL,
    status ENUM('tersedia', 'disewa', 'maintenance') DEFAULT 'tersedia',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data contoh
INSERT INTO alat (nama_alat, stok, harga, status) VALUES 
('Toyota Avanza', 5, 350000, 'tersedia'),
('Honda Jazz', 3, 400000, 'tersedia'),
('Mitsubishi Xpander', 4, 450000, 'tersedia'),
('Daihatsu Terios', 2, 380000, 'tersedia'),
('Suzuki Ertiga', 3, 340000, 'tersedia');
