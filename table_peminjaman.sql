-- Tabel peminjaman
CREATE TABLE IF NOT EXISTS peminjaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_alat INT NOT NULL,
    nama_peminjam VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    no_ktp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE NOT NULL,
    lama_sewa INT NOT NULL,
    total_harga DECIMAL(10,2) NOT NULL,
    status ENUM('dipinjam', 'dikembalikan', 'terlambat') DEFAULT 'dipinjam',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data contoh peminjaman
INSERT INTO peminjaman (id_user, id_alat, nama_peminjam, no_hp, tanggal_pinjam, tanggal_kembali, lama_sewa, total_harga, status) VALUES 
(1, 1, 'Budi Santoso', '081234567890', '2026-02-01', '2026-02-04', 3, 1050000, 'dipinjam'),
(1, 2, 'Siti Aminah', '081234567891', '2026-02-05', '2026-02-07', 2, 800000, 'dikembalikan');
