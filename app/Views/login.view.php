<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5">
        <div class="custom-card shadow-sm">
            <div class="custom-card-header text-center py-4 bg-white border-bottom">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3" style="width: 56px; height: 56px;">
                    <i class="bi bi-shield-lock-fill fs-3"></i>
                </div>
                <h3 class="fw-bold mb-1">Yönetici Girişi</h3>
                <p class="text-muted small mb-0">Yönetim paneline erişmek için oturum açın.</p>
            </div>
            <div class="card-body p-4 p-md-4">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2 rounded-3 mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <div><?= htmlspecialchars($error) ?></div>
                    </div>
                <?php endif; ?>

                <form action="<?= url('/login') ?>" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="bi bi-person me-1"></i> Kullanıcı Adı</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Kullanıcı adınız" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label"><i class="bi bi-key me-1"></i> Şifre</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Giriş Yap
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>