-- Cek user yang ada
SELECT * FROM user;

-- Hapus semua user lama (opsional, kalau mau mulai dari awal)
-- TRUNCATE TABLE user;

-- Insert user baru dengan role lengkap
INSERT INTO user (username, password, role) VALUES 
('admin', 'admin123', 'admin'),
('petugas', 'petugas123', 'petugas'),
('petugas2', 'petugas123', 'petugas'),
('peminjam', 'peminjam123', 'peminjam'),
('user', 'user123', 'peminjam')
ON DUPLICATE KEY UPDATE role=VALUES(role);

-- Atau kalau mau update user yang sudah ada
-- UPDATE user SET role='admin' WHERE username='admin';
-- UPDATE user SET role='petugas' WHERE username='petugas';
-- UPDATE user SET role='peminjam' WHERE username='peminjam';

-- Cek hasil
SELECT username, password, role FROM user;
