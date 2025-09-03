<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';

// Get announcements
$announcements = getAnnouncements(3);

// Get registration settings
$settings = getRegistrationSettings();
?>

<?php include 'templates/partials/header_tailwind.php'; ?>

<!-- Hero Section -->
<section id="beranda" class="gradient-bg pt-20 pb-24">
    <div class="container mx-auto px-6 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-4 leading-tight">Selamat Datang di Portal PPDB Online 2025</h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8">Penerimaan Peserta Didik Baru kini lebih mudah, cepat, dan transparan. <?php if (!isset($_SESSION['user_id'])): ?>Daftarkan putra-putri terbaik Anda melalui portal resmi kami.<?php else: ?>Selamat datang kembali, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Pengguna'); ?>!<?php endif; ?></p>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="cta-button bg-sky-600 text-white font-bold py-3 px-8 rounded-lg text-lg hover:bg-sky-700 inline-block">Mulai Pendaftaran</a>
            <?php else: ?>
                <a href="dashboard_<?php echo $_SESSION['user_role']; ?>.php" class="cta-button bg-sky-600 text-white font-bold py-3 px-8 rounded-lg text-lg hover:bg-sky-700 inline-block">Ke Dashboard</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Information / Features Section -->
<section id="informasi" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Jalur Pendaftaran PPDB 2025</h2>
            <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Pilih jalur pendaftaran yang sesuai dengan kriteria calon peserta didik.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature Card 1: Zonasi -->
            <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-900">Jalur Zonasi</h3>
                <p class="text-gray-600">Bagi calon siswa yang berdomisili di dalam wilayah zonasi yang telah ditetapkan pemerintah daerah.</p>
            </div>
            <!-- Feature Card 2: Afirmasi -->
            <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-900">Jalur Afirmasi</h3>
                <p class="text-gray-600">Untuk calon siswa dari keluarga ekonomi tidak mampu dan penyandang disabilitas.</p>
            </div>
            <!-- Feature Card 3: Prestasi -->
            <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-900">Jalur Prestasi</h3>
                <p class="text-gray-600">Bagi calon siswa yang memiliki prestasi akademik maupun non-akademik yang diakui.</p>
            </div>
        </div>
    </div>
</section>

<!-- Registration Flow Section -->
<section id="alur" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Alur Pendaftaran Siswa Baru</h2>
            <p class="text-gray-600 mt-2">Ikuti 4 langkah mudah untuk mendaftar.</p>
        </div>
        <div class="relative">
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-sky-200" style="transform: translateY(-50%);"></div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 relative">
                <!-- Step 1 --><!-- Step 2 --><!-- Step 3 --><!-- Step 4 -->
                <div class="text-center p-4">
                    <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">1</div>
                    <h3 class="font-bold text-lg mb-2">Buat Akun</h3>
                    <p class="text-gray-600 text-sm">Isi formulir pendaftaran awal untuk membuat akun PPDB.</p>
                </div>
                <div class="text-center p-4">
                    <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">2</div>
                    <h3 class="font-bold text-lg mb-2">Lengkapi Data</h3>
                    <p class="text-gray-600 text-sm">Masuk & lengkapi data diri serta unggah dokumen.</p>
                </div>
                <div class="text-center p-4">
                   <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">3</div>
                    <h3 class="font-bold text-lg mb-2">Verifikasi</h3>
                    <p class="text-gray-600 text-sm">Panitia akan memverifikasi data dan dokumen pendaftaran Anda.</p>
                </div>
                <div class="text-center p-4">
                   <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">4</div>
                    <h3 class="font-bold text-lg mb-2">Pengumuman</h3>
                    <p class="text-gray-600 text-sm">Cek hasil kelulusan melalui akun Anda sesuai jadwal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Schedule Section -->
<section id="jadwal" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Jadwal Penting PPDB 2025</h2>
            <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Catat tanggal-tanggal penting berikut agar tidak terlewat.</p>
        </div>
        <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php if ($settings): ?>
            <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_mulai'])); ?> - <?php echo date('d F Y', strtotime($settings['tanggal_selesai'])); ?></span>
                <h3 class="text-xl font-bold my-2 text-gray-900">Pendaftaran Online</h3>
                <p class="text-gray-600">Pembuatan akun dan pengisian formulir pendaftaran.</p>
            </div>
            <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_mulai'] . ' +15 days')); ?> - <?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' -10 days')); ?></span>
                <h3 class="text-xl font-bold my-2 text-gray-900">Verifikasi Berkas</h3>
                <p class="text-gray-600">Panitia melakukan verifikasi data dan kelengkapan dokumen.</p>
            </div>
            <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' +5 days')); ?></span>
                <h3 class="text-xl font-bold my-2 text-gray-900">Pengumuman Hasil</h3>
                <p class="text-gray-600">Hasil seleksi akan diumumkan melalui portal PPDB.</p>
            </div>
            <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' +6 days')); ?> - <?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' +10 days')); ?></span>
                <h3 class="text-xl font-bold my-2 text-gray-900">Daftar Ulang</h3>
                <p class="text-gray-600">Calon siswa yang lulus seleksi melakukan proses daftar ulang.</p>
            </div>
            <?php else: ?>
            <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                <span class="font-bold text-sky-600">Jadwal belum ditentukan</span>
                <h3 class="text-xl font-bold my-2 text-gray-900">Informasi akan diumumkan</h3>
                <p class="text-gray-600">Jadwal pendaftaran akan diumumkan segera.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Frequently Asked Questions (FAQ)</h2>
            <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Temukan jawaban atas pertanyaan yang paling sering diajukan.</p>
        </div>
        <div class="max-w-3xl mx-auto space-y-4" x-data="{ selected: 1 }">
            <!-- FAQ Item 1 -->
            <div class="bg-white rounded-lg shadow-md">
                <button @click="selected = (selected === 1 ? null : 1)" class="w-full flex justify-between items-center text-left p-6">
                    <span class="font-semibold text-lg">Bagaimana cara membuat akun PPDB?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 1 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="selected === 1" x-collapse class="px-6 pb-6 text-gray-600">
                    <p>Anda dapat membuat akun dengan mengklik tombol "Daftar Sekarang" di pojok kanan atas halaman. Anda akan diminta untuk mengisi data diri awal seperti NIK dan alamat email.</p>
                </div>
            </div>
            <!-- FAQ Item 2 -->
            <div class="bg-white rounded-lg shadow-md">
                <button @click="selected = (selected === 2 ? null : 2)" class="w-full flex justify-between items-center text-left p-6">
                    <span class="font-semibold text-lg">Dokumen apa saja yang diperlukan?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 2 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="selected === 2" x-collapse class="px-6 pb-6 text-gray-600">
                    <p>Dokumen umum yang diperlukan antara lain Kartu Keluarga, Akta Kelahiran, dan Ijazah/SKL jenjang sebelumnya. Persyaratan spesifik untuk setiap jalur dapat dilihat pada halaman panduan.</p>
                </div>
            </div>
            <!-- FAQ Item 3 -->
            <div class="bg-white rounded-lg shadow-md">
                <button @click="selected = (selected === 3 ? null : 3)" class="w-full flex justify-between items-center text-left p-6">
                    <span class="font-semibold text-lg">Bagaimana jika saya lupa kata sandi?</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 3 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="selected === 3" x-collapse class="px-6 pb-6 text-gray-600">
                    <p>Pada halaman login, terdapat tautan "Lupa Kata Sandi". Klik tautan tersebut dan ikuti instruksi yang akan dikirimkan ke alamat email yang Anda daftarkan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-sky-600">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Memulai Perjalanan Pendidikan Anda?</h2>
        <p class="text-sky-100 text-lg mb-8 max-w-2xl mx-auto">Jangan tunda lagi. Segera daftarkan putra-putri Anda dan pastikan mereka mendapatkan kesempatan terbaik.</p>
        <a href="register.php" class="cta-button bg-white text-sky-600 font-bold py-3 px-8 rounded-lg text-lg hover:bg-gray-100">Daftar Sekarang Juga</a>
    </div>
</section>

<?php include 'templates/partials/footer_tailwind.php'; ?>