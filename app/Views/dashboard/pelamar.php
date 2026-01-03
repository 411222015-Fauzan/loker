<?= view('layout/header') ?>

<!-- Hero Section -->
<div class="hero-section text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); position: relative; overflow: hidden;">
    <div class="container position-relative z-1 py-4">
        <h1 class="display-6 fw-bold mb-2">Halo, <?= esc($pelamar['nama_lengkap']) ?>!</h1>
        <p class="lead mb-4 opacity-75">Siap menemukan peluang karir baru hari ini?</p>

        <!-- Search Box -->
        <div class="bg-white p-3 rounded shadow-sm text-dark">
            <form action="/lowongan/search" method="get">
                <div class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="keyword" class="form-control border-0 shadow-none" placeholder="Cari posisi.." value="<?= $keyword ?? '' ?>">
                        </div>
                    </div>
                    <div class="col-md-3 border-start">
                        <select name="wilayah" class="form-select border-0 shadow-none">
                            <option value="">Semua Lokasi</option>
                            <?php foreach($wilayah as $w): ?>
                                <option value="<?= $w['id'] ?>" <?= (isset($selected_wilayah) && $selected_wilayah == $w['id']) ? 'selected' : '' ?>>
                                    <?= $w['nama_wilayah'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 border-start">
                        <select name="klasifikasi" class="form-select border-0 shadow-none">
                            <option value="">Semua Kategori</option>
                            <?php foreach($klasifikasi as $k): ?>
                                <option value="<?= $k['id'] ?>" <?= (isset($selected_klasifikasi) && $selected_klasifikasi == $k['id']) ? 'selected' : '' ?>>
                                    <?= $k['nama_klasifikasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-dark w-100 fw-bold" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Recommendations Section -->
     <?php if(!empty($rekomendasi)): ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Rekomendasi Untuk Anda</h4>
        </div>
        
        <div class="row flex-nowrap overflow-auto pb-4" style="scrollbar-width: thin;">
            <?php foreach($rekomendasi as $job): ?>
                <div class="col-md-3 col-10">
                    <div class="card h-100 border shadow-sm job-card border-0">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div>
                                    <small class="text-muted">Dibutuhkan</small>
                                    <h6 class="card-title fw-bold text-truncate mt-1" style="max-width: 180px;" title="<?= $job['judul'] ?>">
                                        <?= $job['judul'] ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="text-center my-4">
                                <?php if($job['logo']): ?>
                                    <img src="/uploads/logo/<?= $job['logo'] ?>" class="img-fluid" style="height: 60px; object-fit: contain;">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width: 60px; height: 60px;">
                                        <span class="fw-bold text-muted"><?= substr($job['nama_perusahaan'], 0, 1) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="text-center mb-3">
                                <span class="text-dark fw-bold small">
                                    <?= $job['nama_perusahaan'] ?>
                                </span>
                            </div>

                            <div class="d-flex justify-content-between small text-muted border-top pt-3">
                                <span><i class="bi bi-mortarboard me-1"></i> <?= $job['pendidikan'] ?? 'SMA/SMK' ?></span>
                                <span><i class="bi bi-briefcase me-1"></i> <?= $job['pengalaman'] ?? 'Unspecified' ?></span>
                            </div>
                            <div class="text-center mt-3">
                                <a href="/lowongan/detail/<?= $job['id'] ?>" class="btn btn-outline-primary btn-sm w-100 rounded-pill">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Latest Jobs Section -->
    <div class="row mt-4">
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Lowongan Terbaru</h4>
            </div>

            <?php if(!empty($latest)): ?>
                <?php foreach($latest as $job): ?>
                    <div class="card mb-3 border-0 shadow-sm job-card">
                        <div class="card-body p-3">
                            <div class="row align-items-center g-3">
                                <div class="col-md-2 text-center text-md-start">
                                    <?php if($job['logo']): ?>
                                        <img src="/uploads/logo/<?= $job['logo'] ?>" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: contain;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto mx-md-0" style="width: 80px; height: 80px;">
                                            <span class="fs-4 fw-bold text-muted"><?= substr($job['nama_perusahaan'], 0, 1) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-7">
                                    <h5 class="fw-bold mb-1">
                                        <a href="/lowongan/detail/<?= $job['id'] ?>" class="text-dark text-decoration-none stretched-link">
                                            <?= $job['judul'] ?>
                                        </a>
                                        <?php if(strtotime($job['created_at']) > strtotime('-1 day')): ?>
                                            <span class="badge bg-danger ms-2" style="font-size: 0.6em">BARU</span>
                                        <?php endif; ?>
                                    </h5>
                                    <div class="text-muted small mb-2">
                                        <i class="bi bi-building me-1"></i> <?= $job['nama_perusahaan'] ?>
                                        <span class="mx-2">•</span>
                                        <i class="bi bi-currency-dollar me-1"></i> Kompetitif
                                    </div>
                                    <div class="d-flex gap-3 small text-muted">
                                        <span><i class="bi bi-mortarboard"></i> <?= $job['pendidikan'] ?? 'SMA/SMK' ?></span>
                                        <span><i class="bi bi-briefcase"></i> <?= $job['pengalaman'] ?? 'Unspecified' ?></span>
                                        <span><i class="bi bi-geo-alt"></i> <?= $job['nama_wilayah'] ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3 text-md-end text-center">
                                    <span class="text-muted small fst-italic">
                                        <i class="bi bi-clock me-1"></i> <?= date('d M', strtotime($job['created_at'])) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info py-5 text-center">
                     <h5>Belum ada lowongan terbaru.</h5>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Profil Saya</h6>
                    <div class="text-center mb-3">
                         <?php if(!empty($pelamar['foto'])): ?>
                            <img src="/uploads/pelamar/<?= $pelamar['foto'] ?>" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($pelamar['nama_lengkap']) ?>&background=random" class="rounded-circle mb-2" style="width: 80px; height: 80px;">
                        <?php endif; ?>
                        <h6 class="mb-0"><?= $pelamar['nama_lengkap'] ?></h6>
                        <small class="text-muted"><?= session('email') ?></small>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="/pelamar/profile" class="btn btn-outline-primary btn-sm">Edit Profil</a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Status Lamaran</h6>
                    <ul class="list-group list-group-flush small">
                         <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Terkirim
                            <span class="badge bg-primary rounded-pill">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            Interview
                            <span class="badge bg-warning rounded-pill">0</span>
                        </li>
                    </ul>
                     <div class="d-grid mt-3">
                        <a href="/pelamar/lamaran" class="btn btn-light btn-sm">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <!-- Menu Cepat / Quick Menu -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Menu Cepat</h6>
                    <div class="d-grid gap-2">
                        <a href="/pelamar/lamaran" class="btn btn-outline-primary btn-sm text-start"><i class="bi bi-clock-history me-2"></i> Riwayat Lamaran</a>
                        <a href="/pelamar/saved" class="btn btn-outline-warning btn-sm text-start"><i class="bi bi-bookmark me-2"></i> Lowongan Disimpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<?= view('layout/footer') ?>
