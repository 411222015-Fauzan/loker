<?= view('layout/header') ?>

<h4 class="mb-4">Profil Pelamar</h4>

<form method="post" action="/pelamar/profile/save" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" value="<?= esc($profile['nama_lengkap'] ?? '') ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nomor HP</label>
        <input type="text" name="no_hp" class="form-control" value="<?= esc($profile['no_hp'] ?? '') ?>" required>
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
        <label class="form-label">Foto (opsional)</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan Profil</button>
</form>

<?= view('layout/footer') ?>
