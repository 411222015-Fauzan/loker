<?= view('layout/header') ?>

<div class="alert alert-info">
    Selamat datang di Dashboard Perusahaan
</div>

<a href="/perusahaan/lamaran" class="btn btn-primary">
    Lihat Lamaran Masuk
</a>

<hr class="my-4">

<h5>Tambah Lowongan Baru</h5>

<form method="post" action="/perusahaan/lowongan/store">
    <div class="mb-3">
        <label class="form-label">Judul Pekerjaan</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Klasifikasi</label>
            <select name="klasifikasi_id" class="form-select">
                <option value="">Pilih Klasifikasi</option>
                <?php if(!empty($klasifikasi)): foreach($klasifikasi as $k): ?>
                    <option value="<?= $k['id'] ?>"><?= $k['nama_klasifikasi'] ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Lokasi (Wilayah)</label>
            <select name="wilayah_id" class="form-select">
                <option value="">Pilih Wilayah</option>
                <?php if(!empty($wilayah)): foreach($wilayah as $w): ?>
                    <option value="<?= $w['id'] ?>"><?= $w['nama_wilayah'] ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label">Tipe</label>
            <select name="tipe_pekerjaan" class="form-select">
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <label class="form-label">Gaji Min</label>
            <input type="number" name="gaji_min" class="form-control">
        </div>
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-success" type="submit">Posting Lowongan</button>
        <a href="/perusahaan/lamaran" class="btn btn-secondary">Batal</a>
    </div>
</form>

<hr class="my-4">

<h5>Daftar Lowongan Anda</h5>
<?php if(!empty($my_lowongan)): ?>
    <div class="list-group mb-4">
        <?php foreach($my_lowongan as $L): ?>
            <div class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="mb-1"><?= esc($L['judul']) ?></h6>
                    <small class="text-muted"><?= esc($L['tipe_pekerjaan']) ?> • <?= esc($L['status_pekerjaan']) ?></small>
                </div>
                <div class="btn-group">
                    <a href="/lowongan/detail/<?= $L['id'] ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                    <?php if($L['status_pekerjaan'] == 'open'): ?>
                        <form method="post" action="/perusahaan/lowongan/close/<?= $L['id'] ?>" style="display:inline;">
                            <button class="btn btn-sm btn-outline-danger" type="submit">Tutup</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-secondary">Belum ada lowongan yang diposting.</div>
<?php endif; ?>

<?= view('layout/footer') ?>
