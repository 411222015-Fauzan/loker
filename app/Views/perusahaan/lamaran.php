<?= view('layout/header') ?>

<h4 class="mb-4">Lamaran Masuk</h4>

<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>Email Pelamar</th>
            <th>Lowongan</th>
            <th>Status</th>
            <th>CV</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lamaran as $l): ?>
        <tr>
            <td><?= $l['email'] ?></td>
            <td><?= $l['judul'] ?></td>
            <td>
                <span class="badge <?= $l['status_review']=='reviewed'?'bg-success':'bg-warning' ?>">
                    <?= $l['status_review'] ?>
                </span>
            </td>
            <td>
                <?php if($l['cv_file']): ?>
                    <a href="<?= base_url('uploads/cv/' . $l['cv_file']) ?>" target="_blank" class="btn btn-sm btn-info text-white">
                        <i class="bi bi-file-pdf"></i> Lihat CV
                    </a>
                <?php else: ?>
                    <span class="text-muted">No CV</span>
                <?php endif; ?>
            </td>
            <td>
                <?php if($l['status_review']=='pending'): ?>
                    <a href="/perusahaan/review/<?= $l['id'] ?>" class="btn btn-sm btn-success">✔ Review</a>
                <?php else: ?>
                    <a href="/perusahaan/lamaran/delete/<?= $l['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data lamaran ini?')">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= view('layout/footer') ?>
