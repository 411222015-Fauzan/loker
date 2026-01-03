<?= view('layout/header') ?>

<!-- Search Bar Compact (Optional, keeping it simple for now as per previous header) -->
<div class="bg-light border-bottom py-3">
    <div class="container">
        <form action="/lowongan/search" method="get" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control border-0 shadow-sm" placeholder="Cari posisi atau perusahaan..." value="<?= $keyword ?? '' ?>">
            </div>
            <div class="col-md-3">
                <select name="wilayah" class="form-select border-0 shadow-sm">
                    <option value="">Semua Lokasi</option>
                    <?php foreach($wilayah as $w): ?>
                        <option value="<?= $w['id'] ?>" <?= (isset($selected_wilayah) && $selected_wilayah == $w['id']) ? 'selected' : '' ?>>
                            <?= $w['nama_wilayah'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
             <div class="col-md-3">
                <select name="klasifikasi" class="form-select border-0 shadow-sm">
                    <option value="">Semua Kategori</option>
                    <?php foreach($klasifikasi as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= (isset($selected_klasifikasi) && $selected_klasifikasi == $k['id']) ? 'selected' : '' ?>>
                            <?= $k['nama_klasifikasi'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-dark w-100 fw-bold"><i class="bi bi-search"></i> Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="text-primary fw-bold mb-1"><?= $lowongan['nama_perusahaan'] ?></h5>
                            <small class="text-muted">membutuhkan</small>
                            <h2 class="fw-bold mt-1"><?= $lowongan['judul'] ?></h2>
                            <p class="text-muted mb-0">
                                <?= $lowongan['nama_perusahaan'] ?> @<?= strtolower(str_replace(' ', '', $lowongan['nama_perusahaan'])) ?>
                            </p>
                        </div>
                        <div class="ms-3">
                           <?php if($lowongan['logo']): ?>
                                <img src="/uploads/logo/<?= $lowongan['logo'] ?>" class="rounded shadow-sm" style="width: 80px; height: 80px; object-fit: contain;">
                            <?php else: ?>
                                <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center shadow-sm" style="width: 80px; height: 80px;">
                                    <span class="fs-4 fw-bold"><?= substr($lowongan['nama_perusahaan'], 0, 1) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <h5 class="fw-bold border-bottom pb-2 mb-3">Ringkasan</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-mortarboard text-muted me-2" style="width: 20px;"></i>
                                <span class="text-muted me-2" style="width: 100px;">Pendidikan</span>
                                <span class="fw-medium">: <?= $lowongan['pendidikan'] ?? 'SMA/SMK' ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-briefcase text-muted me-2" style="width: 20px;"></i>
                                <span class="text-muted me-2" style="width: 100px;">Pengalaman</span>
                                <span class="fw-medium">: <?= $lowongan['pengalaman'] ?? '0-2 Tahun' ?></span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-gender-ambiguous text-muted me-2" style="width: 20px;"></i>
                                <span class="text-muted me-2" style="width: 100px;">Tipe</span>
                                <span class="fw-medium">: <?= $lowongan['tipe_pekerjaan'] ?></span>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-currency-dollar text-muted me-2" style="width: 20px;"></i>
                                <span class="text-muted me-2" style="width: 100px;">Gaji</span>
                                <span class="fw-medium">: 
                                    <?php if($lowongan['gaji_min']): ?>
                                        Rp <?= number_format($lowongan['gaji_min'], 0, ',', '.') ?> - <?= number_format($lowongan['gaji_max'], 0, ',', '.') ?>
                                    <?php else: ?>
                                        Kompetitif
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-geo-alt text-muted me-2" style="width: 20px;"></i>
                                <span class="text-muted me-2" style="width: 100px;">Lokasi</span>
                                <span class="fw-medium">: <?= $lowongan['nama_wilayah'] ?></span>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold border-bottom pb-2 mb-3">Deskripsi & Syarat</h5>
                    <div class="mb-4 text-secondary" style="line-height: 1.8;">
                        <?= nl2br(esc($lowongan['deskripsi'])) ?>
                    </div>

                    <h5 class="fw-bold border-bottom pb-2 mb-3">Kontak Lamaran</h5>
                    <div class="alert alert-light border">
                         <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-envelope text-muted me-2" style="width: 20px;"></i>
                            <span class="text-muted me-2" style="width: 100px;">Email</span>
                            <span class="fw-medium">: <?= $lowongan['email_perusahaan'] ?></span>
                        </div>
                        <?php if($lowongan['no_telp']): ?>
                         <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-telephone text-muted me-2" style="width: 20px;"></i>
                            <span class="text-muted me-2" style="width: 100px;">No. Telepon</span>
                            <span class="fw-medium">: <?= $lowongan['no_telp'] ?></span>
                        </div>
                        <?php endif; ?>
                         <?php if($lowongan['website']): ?>
                         <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-globe text-muted me-2" style="width: 20px;"></i>
                            <span class="text-muted me-2" style="width: 100px;">Website</span>
                            <a href="<?= $lowongan['website'] ?>" target="_blank" class="fw-medium text-decoration-none"><?= $lowongan['website'] ?></a>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <?php if(session('isLoggedIn') && session('role') == 'pelamar'): ?>
                             <!-- Trigger Modal for Apply -->
                            <button type="button" class="btn btn-dark px-4 py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#applyModal">
                                <i class="bi bi-send me-1"></i> Lamar Sekarang
                            </button>
                        <?php elseif(!session('isLoggedIn')): ?>
                            <a href="/login" class="btn btn-dark px-4 py-2 fw-bold"><i class="bi bi-lock me-1"></i> Login untuk Melamar</a>
                        <?php endif; ?>
                        
                        <button class="btn btn-outline-secondary px-4 py-2 fw-bold"><i class="bi bi-bookmark me-1"></i> Simpan</button>
                        <button class="btn btn-outline-secondary px-4 py-2 fw-bold"><i class="bi bi-share me-1"></i> Bagikan</button>
                    </div>
                </div>
            </div>

            <!-- Related Jobs -->
            <?php if(!empty($terkait)): ?>
                <h5 class="fw-bold mb-3">Lowongan Terkait</h5>
                <div class="card shadow-sm border-0">
                    <ul class="list-group list-group-flush">
                        <?php foreach($terkait as $rel): ?>
                            <li class="list-group-item p-3">
                                <div class="d-flex align-items-center">
                                     <div class="me-3">
                                        <?php if($rel['logo']): ?>
                                            <img src="/uploads/logo/<?= $rel['logo'] ?>" class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                        <?php else: ?>
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <span class="fw-bold text-muted"><?= substr($rel['nama_perusahaan'], 0, 1) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fw-bold">
                                            <a href="/lowongan/detail/<?= $rel['id'] ?>" class="text-dark text-decoration-none"><?= $rel['judul'] ?></a>
                                        </h6>
                                        <small class="text-muted"><?= $rel['nama_perusahaan'] ?> • <?= $rel['nama_wilayah'] ?></small>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block"><?= date('d M', strtotime($rel['created_at'])) ?></small>
                                        <span class="badge bg-light text-dark border"><?= $rel['tipe_pekerjaan'] ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4 position-sticky" style="top: 20px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Profesi</h6>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <?php foreach(array_slice($klasifikasi, 0, 8) as $k): ?>
                            <a href="/lowongan/search?klasifikasi=<?= $k['id'] ?>" class="badge bg-light text-dark text-decoration-none border fw-normal py-2 px-3"><?= $k['nama_klasifikasi'] ?></a>
                        <?php endforeach; ?>
                    </div>

                    <h6 class="fw-bold mb-2">Lokasi Populer</h6>
                    <ul class="list-unstyled mb-0">
                        <?php foreach(array_slice($wilayah, 0, 5) as $w): ?>
                            <li class="mb-2"><a href="/lowongan/search?wilayah=<?= $w['id'] ?>" class="text-decoration-none text-muted border-bottom d-block pb-2"><?= $w['nama_wilayah'] ?></a></li>
                         <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Apply Modal -->
<?php if(session('isLoggedIn') && session('role') == 'pelamar'): ?>
<div class="modal fade" id="applyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Lamar Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="/pelamar/apply/<?= $lowongan['id'] ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <p>Anda akan melamar posisi <strong><?= $lowongan['judul'] ?></strong> di <strong><?= $lowongan['nama_perusahaan'] ?></strong>.</p>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload CV (PDF)</label>
                        <input type="file" name="cv" accept="application/pdf" class="form-control" required>
                        <div class="form-text">Pastikan CV Anda terbaru.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Lamaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<?= view('layout/footer') ?>
