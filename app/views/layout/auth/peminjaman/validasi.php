<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Validasi Pengembalian Mobil</h2>

<div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 20px rgba(66, 165, 245, 0.1); margin-bottom: 20px; border: 1px solid #e3f2fd;">
    <h3 style="margin-top: 0; color: #1976d2;">Data Peminjaman</h3>
    <table style="width: 100%; border: none; box-shadow: none;">
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>Nama Peminjam:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= $data['peminjaman']['nama_peminjam'] ?></td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>No HP:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= $data['peminjaman']['no_hp'] ?></td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>No KTP:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= $data['peminjaman']['no_ktp'] ?? '-' ?></td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>Mobil:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= $data['peminjaman']['nama_alat'] ?></td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>Tanggal Pinjam:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= date('d/m/Y', strtotime($data['peminjaman']['tanggal_pinjam'])) ?></td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>Tanggal Kembali:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= date('d/m/Y', strtotime($data['peminjaman']['tanggal_kembali'])) ?></td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>Lama Sewa:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= $data['peminjaman']['lama_sewa'] ?> hari</td>
        </tr>
        <tr>
            <td style="border: none; padding: 8px 0;"><strong>Total Harga:</strong></td>
            <td style="border: none; padding: 8px 0;">Rp <?= number_format($data['peminjaman']['total_harga'], 0, ',', '.') ?></td>
        </tr>
    </table>
</div>

<form method="post" class="form-card">
    <input type="hidden" name="id" value="<?= $data['peminjaman']['id'] ?>">
    
    <h3 style="margin-top: 0;">Form Validasi Petugas</h3>
    
    <label>Kondisi Mobil Saat Dikembalikan: <span style="color: red;">*</span></label>
    <select name="kondisi_kembali" required>
        <option value="">-- Pilih Kondisi --</option>
        <option value="baik">✅ Baik (Tidak ada kerusakan)</option>
        <option value="rusak ringan">⚠️ Rusak Ringan (Lecet, kotor)</option>
        <option value="rusak berat">❌ Rusak Berat (Penyok, rusak mesin)</option>
    </select>
    
    <label>Catatan Petugas:</label>
    <textarea name="catatan_petugas" rows="4" placeholder="Catatan kondisi mobil, denda (jika ada), dll..." style="width: 100%; padding: 12px; border: 2px solid #bbdefb; border-radius: 8px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"></textarea>
    
    <label>Keputusan: <span style="color: red;">*</span></label>
    <select name="validasi_petugas" required>
        <option value="">-- Pilih Keputusan --</option>
        <option value="disetujui">✅ Setujui Pengembalian (KTP dikembalikan)</option>
        <option value="ditolak">❌ Tolak (Mobil belum layak dikembalikan)</option>
    </select>
    
    <div class="alert-info" style="margin-top: 20px;">
        <strong>ℹ️ Informasi:</strong>
        <ul style="margin: 10px 0 0 20px; padding: 0; box-shadow: none; border: none;">
            <li>Cek kondisi mobil dengan teliti sebelum menyetujui</li>
            <li>Jika disetujui, KTP akan dikembalikan ke peminjam</li>
            <li>Jika ditolak, peminjam harus memperbaiki kondisi mobil</li>
        </ul>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn">Simpan Validasi</button>
        <a href="<?= BASEURL ?>/index.php?url=peminjaman" class="btn-cancel">Batal</a>
    </div>
</form>

<?php require_once __DIR__ . '/../../footer.php'; ?>
