-- Tambah user petugas dan peminjam
INSERT INTO user (username, password, role) VALUES 
('petugas', 'petugas123', 'petugas'),
('peminjam', 'peminjam123', 'peminjam');

-- Atau update user yang sudah ada
-- UPDATE user SET role='petugas' WHERE username='user';
