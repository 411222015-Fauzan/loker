<?= view('layout/header') ?>

<h4 class="mb-4">Lowongan Terbaru</h4>

<div class="row">
<form method="get" action="/lowongan/search" class="row g-2 mb-4">
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
<?php foreach($lowongan as $l): ?>
    <div class="col-md-6 mb-3">
        <div class="card job-card h-100">
            <div class="card-body">
                <h5><?= esc($l['judul'] ?? '') ?></h5>
                <p class="text-muted mb-1"><?= esc($l['nama_perusahaan'] ?? '-') ?></p>
                <span class="badge bg-secondary"><?= esc($l['tipe_pekerjaan'] ?? '') ?></span>
                <p class="mt-2">Rp <?= number_format($l['gaji_min'] ?? 0) ?> - <?= number_format($l['gaji_max'] ?? 0) ?></p>
                <a href="/lowongan/detail/<?= $l['id'] ?>" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<?= view('layout/footer') ?>
