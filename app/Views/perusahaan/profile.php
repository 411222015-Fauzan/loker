<?= view('layout/header') ?>

<h4 class="mb-4">Profil Perusahaan</h4>

<form method="post" action="/perusahaan/profile/save">
    <div class="mb-3">
        <label class="form-label">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" class="form-control" value="<?= esc($profile['nama_perusahaan'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" name="no_telp" class="form-control" value="<?= esc($profile['no_telp'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Email (akun)</label>
        <input type="email" class="form-control" value="<?= esc(session('email')) ?>" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?= esc($profile['alamat'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Bidang</label>
        <input type="text" name="bidang" class="form-control" value="<?= esc($profile['bidang'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Lokasi (Wilayah)</label>
        <select name="wilayah_id" class="form-select">
            <option value="">Pilih Wilayah</option>
            <?php foreach((new \App\Models\WilayahModel())->findAll() as $w): ?>
                <option value="<?= $w['id'] ?>" <?= isset($profile['wilayah_id']) && $profile['wilayah_id']==$w['id'] ? 'selected' : '' ?>><?= esc($w['nama_wilayah']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Website (opsional)</label>
        <input type="text" name="website" class="form-control" value="<?= esc($profile['website'] ?? '') ?>">
    </div>

    <button class="btn btn-primary">Simpan Profil</button>
</form>

<hr class="my-5">

<h5 class="mb-4">Ganti Password</h5>

<form method="post" action="/perusahaan/change-password">
    <div class="mb-3">
        <label class="form-label">Password Lama</label>
        <input type="password" name="old_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password" name="new_password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="confirm_password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-warning">Ganti Password</button>
</form>

<?= view('layout/footer') ?>
