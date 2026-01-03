<?= view('layout/header') ?>

<div class="container my-5">
    <h4 class="mb-4">Lowongan Disimpan</h4>

    <?php if(!empty($saved)): ?>
        <div class="card shadow-sm border-0">
            <ul class="list-group list-group-flush">
                <?php foreach($saved as $s): ?>
                    <li class="list-group-item p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <?php if($s['logo']): ?>
                                    <img src="/uploads/logo/<?= $s['logo'] ?>" class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="fw-bold text-muted"><?= substr($s['nama_perusahaan'], 0, 1) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold">
                                    <a href="/lowongan/detail/<?= $s['id'] ?>" class="text-dark text-decoration-none"><?= $s['judul'] ?></a>
                                </h6>
                                <p class="text-muted small mb-0"><?= $s['nama_perusahaan'] ?> • <?= $s['nama_wilayah'] ?></p>
                                <div class="d-flex gap-2 mt-2">
                                    <span class="badge bg-light text-dark border"><i class="bi bi-mortarboard me-1"></i> <?= $s['pendidikan'] ?? 'SMA' ?></span>
                                    <span class="badge bg-light text-dark border"><i class="bi bi-briefcase me-1"></i> <?= $s['pengalaman'] ?? 'Fresh Grad' ?></span>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#applyModal<?= $s['id'] ?>">Lamar</button>
                                    <form action="/pelamar/delete_saved/<?= $s['saved_id'] ?>" method="post">
                                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus dari daftar simpan?');">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Apply for this specific job -->
                         <div class="modal fade" id="applyModal<?= $s['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Lamar Pekerjaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="post" action="/pelamar/apply/<?= $s['id'] ?>" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <p>Melamar posisi <strong><?= $s['judul'] ?></strong> di <strong><?= $s['nama_perusahaan'] ?></strong>.</p>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Upload CV (PDF)</label>
                                                <input type="file" name="cv" accept="application/pdf" class="form-control" required>
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

                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Belum ada lowongan yang disimpan.</div>
        <a href="/dashboard" class="btn btn-primary mt-3">Cari Lowongan</a>
    <?php endif; ?>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<?= view('layout/footer') ?>
