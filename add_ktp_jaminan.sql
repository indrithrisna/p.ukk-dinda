-- Tambah kolom no_ktp dan alamat ke tabel peminjaman
ALTER TABLE peminjaman 
ADD COLUMN no_ktp VARCHAR(20) NOT NULL AFTER no_hp,
ADD COLUMN alamat TEXT NOT NULL AFTER no_ktp;

-- Update data lama dengan dummy data (opsional, kalau ada data lama)
UPDATE peminjaman SET 
    no_ktp = '3201234567890123',
    alamat = 'Jl. Contoh No. 123'
WHERE no_ktp IS NULL OR no_ktp = '';

-- Cek hasil
DESCRIBE peminjaman;
SELECT * FROM peminjaman;
