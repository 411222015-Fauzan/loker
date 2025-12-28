<?= view('layout/header') ?>

<h4 class="mb-4">Lowongan Terbaru</h4>

<div class="row">
<?php foreach($lowongan as $l): ?>
    <div class="col-md-6 mb-3">
        <div class="card job-card h-100">
            <div class="card-body">
                <h5><?= $l['judul'] ?></h5>
                <p class="text-muted mb-1"><?= $l['nama_perusahaan'] ?></p>
                <span class="badge bg-secondary"><?= $l['tipe_pekerjaan'] ?></span>
                <p class="mt-2">Rp <?= number_format($l['gaji_min']) ?> - <?= number_format($l['gaji_max']) ?></p>
                <a href="/lowongan/detail/<?= $l['id'] ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<?= view('layout/footer') ?>
