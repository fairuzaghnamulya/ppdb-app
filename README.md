# 🎓 PPDB Online - Penerimaan Peserta Didik Baru

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)
[![Version](https://img.shields.io/badge/version-1.0.0-brightgreen)](https://github.com/yourusername/ppdb-online)

Sistem informasi digital untuk penerimaan peserta didik baru berbasis web yang memudahkan proses pendaftaran siswa secara online, transparan, dan efisien.

## 🌟 Fitur Utama

### 👨‍🎓 Untuk Calon Siswa
- ✅ **Pendaftaran Online** - Daftar kapan saja dan di mana saja
- 📋 **Multi-step Form** - Formulir pendaftaran yang terstruktur dan mudah diikuti
- 📁 **Upload Dokumen** - Unggah dokumen pendukung secara digital
- 📊 **Status Tracking** - Pantau status verifikasi dokumen dan pengumuman
- 📱 **Responsive Design** - Tampil sempurna di semua perangkat

### 👨‍💼 Untuk Administrator
- 👥 **Manajemen Siswa** - Kelola data calon siswa dengan mudah
- 📄 **Verifikasi Dokumen** - Tinjau dan verifikasi dokumen yang diunggah
- 📢 **Pengumuman** - Buat dan kelola pengumuman penting
- ⚙️ **Pengaturan Sistem** - Atur tanggal pendaftaran dan kuota
- 📈 **Dashboard Analytics** - Statistik pendaftaran secara real-time

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP (Native)
- **Frontend**: HTML5, CSS3, JavaScript, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Server**: Apache (dengan PHP 7.4+)

## 📸 Preview Aplikasi

### Halaman Beranda
![Halaman Beranda](https://ik.imagekit.io/8qdpqpv3a/halaman-utama.png?updatedAt=1756917498992)

### Dashboard Siswa
![Dashboard Siswa](https://ik.imagekit.io/8qdpqpv3a/dashboard-siswa.png?updatedAt=1756917498999)

### Dashboard Admin
![Dashboard Admin](https://ik.imagekit.io/8qdpqpv3a/dashboard-admin.png?updatedAt=1756917498990)

## 🚀 Instalasi

### Prasyarat
- PHP 7.4 atau lebih tinggi
- MySQL / MariaDB
- Web Server (Apache/Nginx)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/yourusername/ppdb-online.git
   cd ppdb-online
   ```

2. **Import Database**
   ```sql
   # Buat database baru
   CREATE DATABASE ppdb;
   
   # Import skema database
   mysql -u username -p ppdb < database.sql
   ```

3. **Konfigurasi Database**
   Edit file `config/database.php`:
   ```php
   $host = 'localhost';
   $username = 'your_db_username';
   $password = 'your_db_password';
   $dbname = 'ppdb';
   ```

4. **Jalankan Aplikasi**
   ```
   # Dengan PHP built-in server
   php -S localhost:8000
   
   # Atau letakkan di web server directory
   ```

### Login Default
- **Admin**: 
  - Username: `admin`
  - Password: `admin123`
- **Siswa**: 
  - Username: `siswa`
  - Password: `admin123`

## 📁 Struktur Direktori

```
ppdb-online/
├── assets/
│   ├── css/
│   └── js/
├── config/
│   └── database.php
├── html-templates/
│   ├── alur.html
│   ├── dasbor-admin.html
│   ├── dasbor-siswa.html
│   ├── faq.html
│   ├── index.html
│   ├── jadwal.html
│   ├── jalur.html
│   ├── kontak.html
│   ├── login.html
│   └── register.html
├── lib/
│   └── functions.php
├── templates/
│   └── partials/
├── uploads/
├── database.sql
├── index.php
├── login.php
├── register.php
├── dashboard_admin.php
├── dashboard_siswa.php
├── documents.php
├── profile.php
├── announcements_admin.php
├── documents_admin.php
├── settings.php
├── students.php
├── alur_pendaftaran.php
├── faq.php
├── jadwal.php
├── jalur_pendaftaran.php
├── kontak.php
├── logout.php
├── fix_admin.php
├── fix_admin_login.php
├── test_db.php
├── test_login.php
└── README.md
```

### Kategori File

**Halaman Utama:**
- `index.php` - Halaman beranda
- `login.php` - Halaman login
- `register.php` - Halaman registrasi

**Dashboard Admin:**
- `dashboard_admin.php` - Dashboard administrator
- `announcements_admin.php` - Manajemen pengumuman
- `documents_admin.php` - Verifikasi dokumen
- `settings.php` - Pengaturan sistem
- `students.php` - Manajemen siswa

**Dashboard Siswa:**
- `dashboard_siswa.php` - Dashboard siswa
- `documents.php` - Manajemen dokumen
- `profile.php` - Profil pengguna

**Halaman Informasi:**
- `alur_pendaftaran.php` - Alur pendaftaran
- `faq.php` - Pertanyaan umum
- `jadwal.php` - Jadwal penting
- `jalur_pendaftaran.php` - Jalur pendaftaran
- `kontak.php` - Kontak

**Utility & Maintenance:**
- `fix_admin.php` - Perbaikan login admin
- `fix_admin_login.php` - Script perbaikan password admin
- `test_db.php` - Test koneksi database
- `test_login.php` - Test login
- `logout.php` - Logout

**Konfigurasi & Library:**
- `config/database.php` - Konfigurasi database
- `lib/functions.php` - Fungsi-fungsi umum
- `templates/partials/*.php` - Template partials

## 🎨 Desain UI/UX

### Framework CSS
- **Tailwind CSS** - Utility-first CSS framework untuk tampilan modern
- **Alpine.js** - Framework JavaScript ringan untuk interaktivitas

### Komponen UI
- 🎨 **Color Scheme**: Biru langit (#38bdf8) sebagai warna utama
- 📱 **Responsive**: Mobile-first design dengan breakpoint yang optimal
- 🎭 **Typography**: Google Fonts Inter untuk kenyamanan membaca
- 🎯 **UX Flow**: Navigasi intuitif dan proses pendaftaran yang mudah

## 🔐 Keamanan

- ✅ Password hashing dengan `password_hash()`
- ✅ Prepared statements untuk mencegah SQL Injection
- ✅ Validasi dan sanitasi input
- ✅ Session management yang aman
- ✅ File upload validation

## 🤝 Kontribusi

Kontribusi sangat kami nantikan! Untuk berkontribusi:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

## 📄 Lisensi

Distributed under the MIT License. See `LICENSE` for more information.

## 📧 Kontak

fairuzaghnamulya - fairuzaghnamulya.dev@gmail.com

Project Link: [https://github.com/fairuzaghnamulya/ppdb-app/](https://github.com/fairuzaghnamulya/ppdb-app/)

## 🙏 Acknowledgements

- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Google Fonts](https://fonts.google.com)
- [Font Awesome](https://fontawesome.com)

---
⭐ **Jangan lupa beri bintang jika Anda menyukai project ini!**
