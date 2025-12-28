<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="text-center mb-3">Daftar Akun</h4>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="/register" id="registerForm">
                    <?= csrf_field() ?>
                    <input type="text" name="email" class="form-control mb-3" placeholder="Email" required value="<?= old('email') ?>">
                    <input type="text" name="password" class="form-control mb-3" placeholder="Password" required>

                    <select name="role" class="form-select mb-3">
                        <option value="pelamar">Pencari Kerja</option>
                        <option value="perusahaan">Perusahaan</option>
                    </select>

                    <button type="submit" class="btn btn-success w-100">Daftar</button>
                </form>
                
                <script>
                document.getElementById('registerForm').addEventListener('submit', function(e) {
                    console.log('Form submitted!');
                });
                </script>

                <div class="text-center mt-3">
                    <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
