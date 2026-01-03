<?= view('layout/header') ?>

<div class="row justify-content-center my-auto w-100">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="text-center mb-3">Login</h4>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <form method="post">
                    <?= csrf_field() ?>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required value="<?= old('email') ?>">
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                    <button class="btn btn-primary w-100">Masuk</button>
                </form>

                <div class="text-center mt-3">
                    <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
