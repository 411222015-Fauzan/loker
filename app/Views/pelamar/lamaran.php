<?= view('layout/header') ?>

<div class="container my-5">
    <h4 class="mb-4">Riwayat Lamaran</h4>

    <?php if(!empty($lamaran)): ?>
        <div class="card shadow-sm border-0">
            <ul class="list-group list-group-flush">
                <?php foreach($lamaran as $l): ?>
                    <li class="list-group-item p-4">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <?php if($l['logo']): ?>
                                    <img src="/uploads/logo/<?= $l['logo'] ?>" class="rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <span class="fw-bold text-muted"><?= substr($l['nama_perusahaan'], 0, 1) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-bold">
                                    <a href="/lowongan/detail/<?= $l['lowongan_id'] ?>" class="text-dark text-decoration-none"><?= $l['judul'] ?></a>
                                </h6>
                                <p class="text-muted small mb-0"><?= $l['nama_perusahaan'] ?></p>
                                <small class="text-muted">Melamar pada: <?= date('d M Y, H:i', strtotime($l['created_at'])) ?></small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-secondary"><?= ucfirst($l['status']) ?></span>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Belum ada riwayat lamaran.</div>
    <?php endif; ?>
</div>

<?= view('layout/footer') ?>
