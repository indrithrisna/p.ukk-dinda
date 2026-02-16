# 🚗 Sistem Rental Mobil

Aplikasi web untuk mengelola rental mobil dengan sistem role-based access control (Admin, Petugas, Peminjam).

## 📋 Fitur

### 🔐 Sistem Login
- Multi-role authentication (Admin, Petugas, Peminjam)
- Session management
- Role-based dashboard

### 👨‍💼 Admin
- ✅ Kelola semua data mobil (CRUD)
- ✅ Kelola semua data peminjaman
- ✅ Lihat statistik lengkap
- ✅ Dashboard dengan grafik
- ✅ Hapus data peminjaman

### 👷 Petugas
- ✅ Input peminjaman baru
- ✅ Update status peminjaman
- ✅ Lihat data mobil
- ✅ Verifikasi pengembalian
- ❌ Tidak bisa edit/hapus mobil

### 👤 Peminjam
- ✅ Lihat mobil tersedia
- ✅ Ajukan peminjaman
- ✅ Auto-calculate harga sewa
- ✅ Lihat riwayat peminjaman
- ❌ Tidak bisa akses data lain

## 🛠️ Teknologi

- **Backend**: PHP Native (MVC Pattern)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Server**: Apache (Laragon/XAMPP)

## 📁 Struktur Folder

```
rental-mobil/
├── app/
│   ├── controllers/
│   │   ├── AuthControllers.php
│   │   ├── DashboardControllers.php
│   │   ├── AlatControllers.php
│   │   └── PeminjamanControllers.php
│   ├── models/
│   │   ├── database.php
│   │   ├── user.php
│   │   ├── alat.php
│   │   └── peminjaman.php
│   └── views/
│       └── layout/
│           ├── header.php
│           ├── footer.php
│           ├── dashboard/
│           │   ├── admin.php
│           │   ├── petugas.php
│           │   └── peminjam.php
│           └── auth/
│               ├── login.php
│               ├── alat/
│               └── peminjaman/
├── config/
│   └── config.php
├── public/
│   ├── index.php
│   ├── style.css
│   └── .htaccess
└── README.md
```

## 🚀 Instalasi

### 1. Clone/Download Project
```bash
git clone <repository-url>
cd rental-mobil
```

### 2. Setup Database
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Import file `rental_mobil_complete.sql`
3. Atau jalankan SQL manual:

```sql
CREATE DATABASE rental_mobil;
USE rental_mobil;

-- Import semua tabel dari file SQL
```

### 3. Konfigurasi
Edit file `config/config.php`:

```php
define('BASEURL', 'http://localhost/rental-mobil/public');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rental_mobil');
```

### 4. Setup Virtual Host (Opsional)

**Untuk Laragon:**
1. Klik kanan Laragon → Apache → Add Virtual Host
2. Nama: `rental`
3. Path: `C:\laragon\www\rental-mobil\public`
4. Akses: `http://rental.test`

**Manual (httpd-vhosts.conf):**
```apache
<VirtualHost *:80>
    DocumentRoot "C:/path/to/rental-mobil/public"
    ServerName rental.test
    <Directory "C:/path/to/rental-mobil/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Tambahkan di `C:\Windows\System32\drivers\etc\hosts`:
```
127.0.0.1 rental.test
```

### 5. Akses Aplikasi
- Tanpa vhost: `http://localhost/rental-mobil/public/`
- Dengan vhost: `http://rental.test`

## 👥 Default Login

| Role | Username | Password |
|------|----------|----------|
| Admin | admin | admin123 |
| Petugas | petugas | petugas123 |
| Peminjam | peminjam | peminjam123 |

## 📊 Database Schema

### Tabel: user
```sql
- id (INT, PK, AUTO_INCREMENT)
- username (VARCHAR)
- password (VARCHAR)
- role (VARCHAR: admin/petugas/peminjam)
- created_at (TIMESTAMP)
```

### Tabel: alat
```sql
- id (INT, PK, AUTO_INCREMENT)
- nama_alat (VARCHAR)
- stok (INT)
- harga (DECIMAL)
- status (ENUM: tersedia/disewa/maintenance)
- created_at (TIMESTAMP)
```

### Tabel: peminjaman
```sql
- id (INT, PK, AUTO_INCREMENT)
- id_user (INT)
- id_alat (INT)
- nama_peminjam (VARCHAR)
- no_hp (VARCHAR)
- tanggal_pinjam (DATE)
- tanggal_kembali (DATE)
- lama_sewa (INT)
- total_harga (DECIMAL)
- status (ENUM: dipinjam/dikembalikan/terlambat)
- created_at (TIMESTAMP)
```

## 🔧 Troubleshooting

### Login Gagal
1. Pastikan database sudah diimport
2. Cek koneksi database di `config/config.php`
3. Jalankan SQL:
```sql
SELECT * FROM user;
```

### Dashboard Salah Role
1. Logout dari aplikasi
2. Atau buka browser Incognito
3. Login ulang

### Not Found Error
1. Pastikan akses lewat `public/index.php`
2. Cek `.htaccess` di folder `public/`
3. Pastikan `mod_rewrite` Apache aktif

### Role Tidak Sesuai
Jalankan SQL ini:
```sql
UPDATE user SET role='admin' WHERE username='admin';
UPDATE user SET role='petugas' WHERE username='petugas';
UPDATE user SET role='peminjam' WHERE username='peminjam';
```

## 📝 Cara Pakai

### Admin
1. Login sebagai admin
2. Dashboard menampilkan statistik lengkap
3. Kelola data mobil: tambah, edit, hapus
4. Kelola peminjaman: lihat, update status, hapus

### Petugas
1. Login sebagai petugas
2. Dashboard menampilkan peminjaman aktif
3. Input peminjaman baru
4. Update status pengembalian mobil

### Peminjam
1. Login sebagai peminjam
2. Dashboard menampilkan mobil tersedia
3. Klik "Sewa Sekarang" pada mobil
4. Isi form peminjaman (auto-calculate harga)
5. Lihat riwayat peminjaman

## 🎨 Fitur Unggulan

- **Auto-Calculate**: Hitung otomatis lama sewa dan total harga
- **Role-Based Access**: Menu dan fitur sesuai role user
- **Responsive Design**: Tampilan modern dan user-friendly
- **Validation**: Form validation untuk input data
- **Security**: SQL injection prevention dengan mysqli_real_escape_string

## 📄 License

MIT License - Free to use and modify

## 👨‍💻 Developer

Developed with ❤️ for UKK Project

---

**Note**: Aplikasi ini dibuat untuk keperluan pembelajaran dan ujian kompetensi keahlian (UKK).
