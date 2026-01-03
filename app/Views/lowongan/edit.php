<?= view('layout/header') ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Edit Lowongan</h5>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="/perusahaan/lowongan/update/<?= $l['id'] ?>">
                        <div class="mb-3">
                            <label class="form-label">Judul Pekerjaan</label>
                            <input type="text" name="judul" class="form-control" value="<?= esc($l['judul']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="5" required><?= esc($l['deskripsi']) ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Klasifikasi</label>
                                <select name="klasifikasi_id" class="form-select" required>
                                    <option value="">Pilih Klasifikasi</option>
                                    <?php if(!empty($klasifikasi)): foreach($klasifikasi as $k): ?>
                                        <option value="<?= $k['id'] ?>" <?= $l['klasifikasi_id'] == $k['id'] ? 'selected' : '' ?>><?= $k['nama_klasifikasi'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi (Wilayah)</label>
                                <select name="wilayah_id" class="form-select" required>
                                    <option value="">Pilih Wilayah</option>
                                    <?php if(!empty($wilayah)): foreach($wilayah as $w): ?>
                                        <option value="<?= $w['id'] ?>" <?= $l['wilayah_id'] == $w['id'] ? 'selected' : '' ?>><?= $w['nama_wilayah'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pendidikan</label>
                                <select name="pendidikan" class="form-select" required>
                                    <option value="">Pilih Pendidikan</option>
                                    <?php $pend = ['SMA/SMK', 'D3', 'S1', 'S2', 'Lainnya']; ?>
                                    <?php foreach($pend as $p): ?>
                                        <option value="<?= $p ?>" <?= $l['pendidikan'] == $p ? 'selected' : '' ?>><?= $p ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pengalaman</label>
                                <select name="pengalaman" class="form-select" required>
                                    <option value="">Pilih Pengalaman</option>
                                    <?php $peng = ['Tanpa Pengalaman', '1-2 Tahun', '3-4 Tahun', '5 Tahun Lebih', 'Fresh Graduate']; ?>
                                    <?php foreach($peng as $p): ?>
                                        <option value="<?= $p ?>" <?= $l['pengalaman'] == $p ? 'selected' : '' ?>><?= $p ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tipe Pekerjaan</label>
                                <select name="tipe_pekerjaan" class="form-select" required>
                                    <option value="Full-time" <?= $l['tipe_pekerjaan'] == 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                                    <option value="Part-time" <?= $l['tipe_pekerjaan'] == 'Part-time' ? 'selected' : '' ?>>Part-time</option>
                                    <option value="Contract" <?= $l['tipe_pekerjaan'] == 'Contract' ? 'selected' : '' ?>>Contract</option>
                                    <option value="Freelance" <?= $l['tipe_pekerjaan'] == 'Freelance' ? 'selected' : '' ?>>Freelance</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gaji Minimum (Rp)</label>
                                <input type="number" name="gaji_min" class="form-control" value="<?= esc($l['gaji_min']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gaji Maksimum (Rp)</label>
                                <input type="number" name="gaji_max" class="form-control" value="<?= esc($l['gaji_max']) ?>">
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <a href="/dashboard" class="btn btn-light">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
