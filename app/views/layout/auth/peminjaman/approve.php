<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Approval Peminjaman Mobil</h2>

<div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 20px rgba(66, 165, 245, 0.1); margin-bottom: 20px; border: 1px solid #e3f2fd;">
    <h3 style="margin-top: 0; color: #1976d2;">Data Peminjaman</h3>
    <table style="width: 100%; border: none; box-shadow: none;">
        <tr>
            <td style="border: none; padding: 8px 0; width: 200px;"><strong>Nama Peminjam:</strong></td>
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
            <td style="border: none; padding: 8px 0;"><strong>Alamat:</strong></td>
            <td style="border: none; padding: 8px 0;"><?= $data['peminjaman']['alamat'] ?? '-' ?></td>
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
            <td style="border: none; padding: 8px 0; color: #1976d2; font-size: 18px; font-weight: bold;">Rp <?= number_format($data['peminjaman']['total_harga'], 0, ',', '.') ?></td>
        </tr>
    </table>
</div>

<form method="post" class="form-card">
    <input type="hidden" name="id" value="<?= $data['peminjaman']['id'] ?>">
    <input type="hidden" name="petugas_id" value="<?= $_SESSION['user_id'] ?? 1 ?>">
    
    <h3 style="margin-top: 0;">Form Approval Petugas</h3>
    
    <label>Keputusan: <span style="color: red;">*</span></label>
    <select name="keputusan" required>
        <option value="">-- Pilih Keputusan --</option>
        <option value="disetujui">✅ Setujui Peminjaman</option>
        <option value="ditolak">❌ Tolak Peminjaman</option>
    </select>
    
    <label>Catatan Petugas:</label>
    <textarea name="catatan_approval" rows="4" placeholder="Alasan persetujuan/penolakan, syarat tambahan, dll..." style="width: 100%; padding: 12px; border: 2px solid #bbdefb; border-radius: 8px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"></textarea>
    
    <div class="alert-info" style="margin-top: 20px;">
        <strong>ℹ️ Informasi:</strong>
        <ul style="margin: 10px 0 0 20px; padding: 0; box-shadow: none; border: none;">
            <li>Cek kelengkapan dokumen (KTP) sebelum menyetujui</li>
            <li>Pastikan mobil tersedia dan dalam kondisi baik</li>
            <li>Jika disetujui, KTP akan ditahan sebagai jaminan</li>
            <li>Jika ditolak, peminjam akan diberitahu alasannya</li>
        </ul>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn">Simpan Keputusan</button>
        <a href="<?= BASEURL ?>/index.php?url=peminjaman" class="btn-cancel">Batal</a>
    </div>
</form>

<?php require_once __DIR__ . '/../../footer.php'; ?>
