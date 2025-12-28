<?= view('layout/header') ?>

<h4 class="mb-4">Lamaran Masuk</h4>

<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>Email Pelamar</th>
            <th>Lowongan</th>
            <th>Status</th>
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
                <?php if($l['status_review']=='pending'): ?>
                    <a href="/perusahaan/review/<?= $l['id'] ?>" class="btn btn-sm btn-success">✔ Review</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= view('layout/footer') ?>
