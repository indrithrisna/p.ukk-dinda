-- Ubah sistem stok ke plat nomor
-- Hapus kolom stok, tambah plat nomor

ALTER TABLE alat 
DROP COLUMN stok,
ADD COLUMN plat_nomor VARCHAR(15) UNIQUE NOT NULL AFTER nama_alat;

-- Update data lama dengan plat nomor dummy
UPDATE alat SET plat_nomor = CONCAT('B ', id * 1000, ' ABC') WHERE plat_nomor IS NULL OR plat_nomor = '';

-- Cek hasil
DESCRIBE alat;
SELECT * FROM alat;
