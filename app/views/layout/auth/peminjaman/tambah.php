<?php require_once __DIR__ . '/../../header.php'; ?>

<h2>Tambah Peminjaman</h2>

<?php if(isset($data['mobil_selected'])): ?>
<div style="background: #d1ecf1; padding: 15px; border-radius: 4px; margin-bottom: 20px; border-left: 4px solid #0c5460;">
    <strong>📋 Mobil yang dipilih:</strong> <?= $data['mobil_selected']['nama_alat'] ?> - 
    Rp <?= number_format($data['mobil_selected']['harga'], 0, ',', '.') ?>/hari
</div>
<?php endif; ?>

<form method="post" class="form-card">
    <input type="hidden" name="id_user" value="<?= $_SESSION['user_id'] ?? 1 ?>">
    
    <h3 style="margin-top: 0;">Data Peminjam</h3><br>
    
    <label>Nama Lengkap: <span style="color: red;">*</span></label>
    <input type="text" name="nama_peminjam" required placeholder="Masukkan nama lengkap">
    
    <label>No HP/WhatsApp: <span style="color: red;">*</span></label>
    <input type="text" name="no_hp" required placeholder="08xxxxxxxxxx" pattern="[0-9]{10,13}">
    
    <label>No KTP/NIK (Jaminan): <span style="color: red;">*</span></label>
    <input type="text" name="no_ktp" required placeholder="16 digit nomor KTP" pattern="[0-9]{16}" maxlength="16">
    <small style="color: #666; display: block; margin-top: -10px; margin-bottom: 10px;">* KTP akan dijadikan jaminan selama peminjaman</small>
    
    <label>Alamat Lengkap: <span style="color: red;">*</span></label>
    <textarea name="alamat" required rows="3" placeholder="Masukkan alamat lengkap" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 15px; font-family: Arial;"></textarea>
    
    <hr style="margin: 20px 0;">
    <h3>Keterangan Barang</h3><br>
    
    <label>Pilih Mobil: <span style="color: red;">*</span></label>
    <select name="id_alat" id="mobil" required onchange="hitungTotal()">
        <option value="">-- Pilih Mobil --</option>
        <?php 
        if(mysqli_num_rows($data['alat']) == 0): 
            echo '<option value="">Tidak ada mobil tersedia</option>';
        else:
            foreach($data['alat'] as $a): 
                if($a['status'] == 'tersedia'):
                    $selected = (isset($data['id_mobil_selected']) && $data['id_mobil_selected'] == $a['id']) ? 'selected' : '';
        ?>
            <option value="<?= $a['id'] ?>" data-harga="<?= $a['harga'] ?>" <?= $selected ?>>
                <?= $a['nama_alat'] ?> (<?= $a['plat_nomor'] ?? '-' ?>) - Rp <?= number_format($a['harga'], 0, ',', '.') ?>/hari
            </option>
        <?php 
                endif;
            endforeach; 
        endif;
        ?>
    </select>
    
    <label>Tanggal Pinjam: <span style="color: red;">*</span></label>
    <input type="date" name="tanggal_pinjam" id="tgl_pinjam" required onchange="hitungTotal()" min="<?= date('Y-m-d') ?>">
    
    <label>Tanggal Kembali: <span style="color: red;">*</span></label>
    <input type="date" name="tanggal_kembali" id="tgl_kembali" required onchange="hitungTotal()" min="<?= date('Y-m-d') ?>">
    
    <label>Lama Sewa (hari):</label>
    <input type="number" name="lama_sewa" id="lama_sewa" min="1" required readonly style="background: #f5f5f5;">
    
    <label>Total Harga:</label>
    <input type="number" name="total_harga" id="total_harga" required readonly style="background: #f5f5f5;">
    
    <div style="background: #fff3cd; padding: 15px; border-radius: 4px; margin: 15px 0; border-left: 4px solid #ffc107;">
        <strong>⚠️ Perhatian:</strong>
        <ul style="margin: 10px 0 0 20px;">
            <li>KTP asli wajib diserahkan sebagai jaminan</li>
            <li>KTP akan dikembalikan saat mobil dikembalikan</li>
            <li>Pastikan data yang diisi benar dan sesuai KTP</li>
        </ul>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn">Ajukan Peminjaman</button>
        <a href="<?= BASEURL ?>/index.php?url=dashboard" class="btn-cancel">Batal</a>
    </div>
</form>

<script>
function hitungTotal(){
    var mobil = document.getElementById('mobil');
    var tglPinjam = document.getElementById('tgl_pinjam').value;
    var tglKembali = document.getElementById('tgl_kembali').value;
    
    if(mobil.value && tglPinjam && tglKembali){
        var harga = mobil.options[mobil.selectedIndex].getAttribute('data-harga');
        var date1 = new Date(tglPinjam);
        var date2 = new Date(tglKembali);
        var diffTime = Math.abs(date2 - date1);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if(diffDays > 0){
            document.getElementById('lama_sewa').value = diffDays;
            document.getElementById('total_harga').value = diffDays * harga;
        } else {
            alert('Tanggal kembali harus lebih besar dari tanggal pinjam!');
            document.getElementById('tgl_kembali').value = '';
        }
    }
}
</script>

<?php require_once __DIR__ . '/../../footer.php'; ?>
