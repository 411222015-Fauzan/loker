<?= view('layout/header') ?>

<!-- Hero Section with Pattern Background -->
<div class="hero-section text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); position: relative; overflow: hidden;">
    <div class="container position-relative z-1 py-5">
        <h1 class="display-5 fw-bold mb-2">Portal Lowongan Kerja Loker Kita</h1>
        <p class="lead mb-4 opacity-75">Temukan loker terbaru bulan <?= date('F Y') ?> dengan mudah. Selengkapnya</p>

        <!-- Search Box (Floating) -->
        <div class="bg-white p-3 rounded shadow-sm">
            <form action="/lowongan/search" method="get">
                <div class="row g-2 align-items-center">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="keyword" class="form-control border-0 shadow-none" placeholder="Cari disini.." value="<?= $keyword ?? '' ?>">
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
            
            <!-- Tags (Static for now) -->
            <div class="mt-3 d-flex gap-2 flex-wrap">
                <a href="#" class="badge bg-light text-dark text-decoration-none border fw-normal px-3 py-2">Tanpa Pengalaman</a>
                <a href="#" class="badge bg-light text-dark text-decoration-none border fw-normal px-3 py-2">1 - 2 Tahun</a>
                <a href="#" class="badge bg-light text-dark text-decoration-none border fw-normal px-3 py-2">3 - 4 Tahun</a>
                <a href="#" class="badge bg-light text-dark text-decoration-none border fw-normal px-3 py-2">5 Tahun Lebih</a>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Recommendations Section -->
    <?php if(!empty($rekomendasi)): ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Rekomendasi Lowongan</h4>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary rounded-circle" disabled><</button>
                <button class="btn btn-outline-secondary rounded-circle">></button>
            </div>
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
                                <a href="/perusahaan/detail/<?= $job['perusahaan_id'] ?>" class="text-decoration-none text-dark fw-bold small">
                                    <?= $job['nama_perusahaan'] ?>
                                </a>
                            </div>

                            <div class="d-flex justify-content-between small text-muted border-top pt-3">
                                <span><i class="bi bi-mortarboard me-1"></i> <?= $job['pendidikan'] ?? 'SMA/SMK' ?></span>
                                <span><i class="bi bi-briefcase me-1"></i> <?= $job['pengalaman'] ?? '0-1 Thn' ?></span>
                            </div>
                            <div class="small text-muted mt-2">
                                <i class="bi bi-geo-alt me-1"></i> <?= $job['nama_wilayah'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Latest Jobs Section -->
    <div class="row mt-5">
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Lowongan Terbaru</h4>
                <a href="#" class="text-decoration-none">Lihat Semua >></a>
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
                                    <small class="text-primary fw-bold">Dibutuhkan</small>
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
                                        <span><i class="bi bi-briefcase"></i> <?= $job['pengalaman'] ?? '0-1 Thn' ?></span>
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
                    <i class="bi bi-search display-4 d-block mb-3"></i>
                    <h5>Belum ada lowongan ditemukan.</h5>
                    <p class="mb-0">Coba ubah kata kunci pencarian Anda.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Menu Cepat</h6>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary"><i class="bi bi-clock-history me-2"></i> Riwayat Lamaran</button>
                        <button class="btn btn-outline-warning"><i class="bi bi-bookmark me-2"></i> Lowongan Disimpan</button>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Profesi Populer</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Administrasi</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Sales & Marketing</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Teknologi Informasi</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Akuntansi</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Desain Kreatif</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<?= view('layout/footer') ?>
