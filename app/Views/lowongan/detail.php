<?= view('layout/header') ?>

<?php if(empty($lowongan)): ?>
    <div class="alert alert-warning">Lowongan tidak ditemukan.</div>
    <?= view('layout/footer') ?>
    <?php return; ?>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-body">
        <h3><?= esc($lowongan['judul']) ?></h3>
        <?php if(!empty($lowongan['nama_perusahaan'])): ?><p class="text-muted"><?= esc($lowongan['nama_perusahaan']) ?></p><?php endif; ?>
        <div class="mb-3"><?= nl2br(esc($lowongan['deskripsi'])) ?></div>
        <p><strong>Tipe:</strong> <?= esc($lowongan['tipe_pekerjaan']) ?></p>
        <p><strong>Gaji:</strong> Rp <?= number_format($lowongan['gaji_min'] ?? 0) ?> - <?= number_format($lowongan['gaji_max'] ?? 0) ?></p>
    </div>
</div>

<?php if(session('isLoggedIn') && session('role') == 'pelamar'): ?>
    <div class="card mb-5">
        <div class="card-body">
            <h5>Lamar Pekerjaan</h5>
            <form method="post" action="/pelamar/apply/<?= $lowongan['id'] ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Upload CV (PDF)</label>
                    <input type="file" name="cv" accept="application/pdf" class="form-control" required>
                </div>
                <button class="btn btn-primary">Kirim Lamaran</button>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info">Silakan <a href="/login">login sebagai pelamar</a> untuk melamar pekerjaan ini.</div>
<?php endif; ?>

<?= view('layout/footer') ?>
