<?= view('layout/header') ?>

<h4 class="mb-4">Cari Lowongan Pekerjaan</h4>

<form method="get" action="/lowongan/search" class="row g-2 mb-4">
    <div class="col-md-5">
        <input type="text" name="keyword" class="form-control" placeholder="Cari Pekerjaan">
    </div>
    <div class="col-md-4">
        <select name="wilayah" class="form-select">
            <option value="">Semua Lokasi</option>
            <?php if(!empty($wilayah)): foreach($wilayah as $w): ?>
                <option value="<?= $w['id'] ?>"><?= $w['nama_wilayah'] ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
    <div class="col-md-2">
        <select name="klasifikasi" class="form-select">
            <option value="">Lulusan</option>
            <?php if(!empty($klasifikasi)): foreach($klasifikasi as $k): ?>
                <option value="<?= $k['id'] ?>"><?= $k['nama_klasifikasi'] ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
    <div class="col-md-1">
        <button class="btn btn-primary w-100">Cari</button>
    </div>
</form>

<?php if(!empty($lowongan)): ?>
<div class="row">
    <?php foreach($lowongan as $l): ?>
    <div class="col-md-6 mb-3">
        <div class="card job-card h-100">
            <div class="card-body">
                <h5><?= esc($l['judul']) ?></h5>
                <?php if(!empty($l['nama_perusahaan'])): ?><p class="text-muted mb-1"><?= esc($l['nama_perusahaan']) ?></p><?php endif; ?>
                <span class="badge bg-secondary"><?= esc($l['tipe_pekerjaan']) ?></span>
                <p class="mt-2">Rp <?= number_format($l['gaji_min'] ?? 0) ?> - <?= number_format($l['gaji_max'] ?? 0) ?></p>
                <a href="/lowongan/detail/<?= $l['id'] ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <div class="alert alert-secondary">Belum ada lowongan tersedia.</div>
<?php endif; ?>

<?= view('layout/footer') ?>
