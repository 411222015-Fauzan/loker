<?= view('layout/header') ?>

<!-- Search Section -->
<div class="container mt-4 mb-5">
                <form method="get" action="/lowongan/search" class="row g-2">
                    <div class="col-md-5">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari Pekerjaan" value="<?= esc($keyword ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <select name="wilayah" class="form-select">
                            <option value="">Semua Lokasi</option>
                            <?php if(!empty($wilayah)): foreach($wilayah as $w): ?>
                                <option value="<?= $w['id'] ?>" <?= (isset($selected_wilayah) && $selected_wilayah == $w['id']) ? 'selected' : '' ?>><?= $w['nama_wilayah'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="klasifikasi" class="form-select">
                            <option value="">Klasifikasi</option>
                            <?php if(!empty($klasifikasi)): foreach($klasifikasi as $k): ?>
                                <option value="<?= $k['id'] ?>" <?= (isset($selected_klasifikasi) && $selected_klasifikasi == $k['id']) ? 'selected' : '' ?>><?= $k['nama_klasifikasi'] ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary w-100">Cari</button>
                    </div>
                </form>
</div>

<!-- Sign Up / Login CTA Box -->
<div class="container mb-5">
    <div class="card bg-primary text-white p-4 text-center">
        <div class="card-body">
            <h5 class="card-title mb-3">Temukan pekerjaan yang tepat untuk Anda di Loker Kita</h5>
            <p class="card-text mb-3">Masuk untuk mendapatkan pekerjaan yang lebih cocok</p>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="/login" class="btn btn-light btn-lg">Masuk</a>
                <span class="align-self-center">atau</span>
                <a href="/register" class="btn btn-light btn-lg">Belum punya akun? Daftar</a>
            </div>
        </div>
    </div>
</div>

<!-- Companies List - Horizontal Scroll -->
<div class="container mb-5">
    <h5 class="mb-4">Perusahaan yang Merekrut</h5>
    
    <?php if(!empty($perusahaan)): ?>
    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <div style="display: flex; gap: 1rem; min-width: min-content;">
            <?php foreach($perusahaan as $p): ?>
    <?php if(!empty($perusahaan)): ?>
    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <div style="display: flex; gap: 1rem; min-width: min-content;">
            <?php foreach($perusahaan as $p): ?>
            <div style="flex: 0 0 280px;">
                <div class="card h-100 text-center p-3">
                    <div class="card-body">
                        <h6><?= esc($p['nama_perusahaan']) ?></h6>
                        <p class="text-muted small"><?= esc($p['bidang'] ?? 'N/A') ?></p>
                        <small class="text-secondary"><?= esc($p['alamat'] ?? '') ?></small>
                    </div>
                    <?php if(!empty($p['website'])): ?>
                    <a href="<?= esc($p['website']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Kunjungi</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Tips and Tricks -->
<div class="container">
    <h5 class="mb-4">Tips & Trik untuk Pencari Kerja</h5>

    <div class="row mb-5">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">1. Persiapkan CV yang Menarik</h6>
                    <p class="card-text">Pastikan CV Anda lengkap, jelas, dan relevan dengan posisi yang dituju. Gunakan format profesional dan highlighter pencapaian utama Anda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">2. Optimalkan Profil LinkedIn</h6>
                    <p class="card-text">Profil LinkedIn yang lengkap meningkatkan peluang Anda ditemukan rekruter. Tambahkan foto profesional dan deskripsi yang menarik.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">3. Lamar Posisi yang Sesuai</h6>
                    <p class="card-text">Jangan hanya melamar sembarangan. Pilih posisi yang sesuai dengan keahlian dan pengalaman Anda untuk meningkatkan peluang diterima.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">4. Persiapkan Diri untuk Interview</h6>
                    <p class="card-text">Riset perusahaan, latih jawaban umum, dan kenakan pakaian profesional. Tunjukkan antusiasme dan pengetahuan tentang perusahaan target.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">5. Networking adalah Kunci</h6>
                    <p class="card-text">Bangun hubungan profesional melalui acara industri dan media sosial. Banyak posisi diisi melalui referensi dari koneksi yang ada.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">6. Follow Up Setelah Aplikasi</h6>
                    <p class="card-text">Tunggu beberapa hari kemudian lakukan follow up secara profesional. Tunjukkan minat Anda dan ingatkan tentang aplikasi yang Anda kirim.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-primary text-white py-5 px-4 rounded mt-5">
    <div class="container text-center">
        <h4 class="mb-3">Siap Mencari Pekerjaan Impian?</h4>
        <p class="mb-4">Daftar sekarang dan dapatkan akses ke ribuan lowongan kerja terbaru dari perusahaan terkemuka.</p>
        <a href="/register" class="btn btn-light btn-lg">Daftar Gratis</a>
    </div>
</div>

<?= view('layout/footer') ?>
