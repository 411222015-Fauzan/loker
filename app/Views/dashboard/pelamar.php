<?= view('layout/header') ?>

<h4 class="mb-4">Cari Lowongan Pekerjaan</h4>

<form method="get" action="/lowongan/search" class="row g-2 mb-4">
    <div class="col-md-5">
        <input type="text" name="keyword" class="form-control" placeholder="Posisi atau perusahaan">
    </div>
    <div class="col-md-3">
        <select name="klasifikasi" class="form-select">
            <option value="">Semua Klasifikasi</option>
        </select>
    </div>
    <div class="col-md-3">
        <select name="wilayah" class="form-select">
            <option value="">Semua Wilayah</option>
        </select>
    </div>
    <div class="col-md-1">
        <button class="btn btn-primary w-100">Cari</button>
    </div>
</form>

<?= view('layout/footer') ?>
