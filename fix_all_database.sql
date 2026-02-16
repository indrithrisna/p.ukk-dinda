-- ========================================
-- FIX DATABASE RENTAL MOBIL LENGKAP
-- ========================================

USE rental_mobil;

-- 1. Fix tabel user - pastikan kolom role bisa terima semua value
ALTER TABLE user MODIFY COLUMN role VARCHAR(20) DEFAULT 'peminjam';

-- 2. Hapus user lama dan insert ulang dengan benar
TRUNCATE TABLE user;

INSERT INTO user (username, password, role) VALUES 
('admin', 'admin123', 'admin'),
('petugas', 'petugas123', 'petugas'),
('petugas2', 'petugas123', 'petugas'),
('peminjam', 'peminjam123', 'peminjam'),
('user', 'user123', 'peminjam');

-- 3. Pastikan tabel alat punya kolom id
-- Kalau belum ada, tambahkan
-- ALTER TABLE alat ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST;

-- 4. Cek data alat
SELECT * FROM alat;

-- 5. Cek data peminjaman
SELECT * FROM peminjaman;

-- 6. Verifikasi user sudah benar
SELECT id, username, password, role FROM user;

-- ========================================
-- SELESAI! Sekarang coba:
-- 1. Logout dari aplikasi
-- 2. Login dengan: admin / admin123
-- 3. Dashboard admin akan muncul
-- ========================================
