-- ========================================
-- FIX & TAMBAH FITUR APPROVAL LENGKAP
-- ========================================

-- 1. Update kolom status untuk tambah status baru
ALTER TABLE peminjaman 
MODIFY COLUMN status ENUM('pending', 'disetujui', 'dipinjam', 'menunggu validasi', 'dikembalikan', 'ditolak') DEFAULT 'pending';

-- 2. Tambah kolom untuk validasi pengembalian
ALTER TABLE peminjaman 
ADD COLUMN kondisi_kembali ENUM('baik', 'rusak ringan', 'rusak berat') AFTER status,
ADD COLUMN catatan_petugas TEXT AFTER kondisi_kembali,
ADD COLUMN validasi_petugas ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending' AFTER catatan_petugas,
ADD COLUMN tanggal_validasi DATETIME AFTER validasi_petugas,
ADD COLUMN petugas_id INT AFTER tanggal_validasi;

-- 3. Cek hasil
DESCRIBE peminjaman;

-- 4. Update data lama (opsional)
UPDATE peminjaman SET status='dipinjam' WHERE status='pending' OR status='disetujui';

SELECT * FROM peminjaman;
