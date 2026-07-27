<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="custom-card shadow-sm">
            <div class="custom-card-header text-center py-4 bg-white border-bottom">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3" style="width: 56px; height: 56px;">
                    <i class="bi bi-file-earmark-person-fill fs-3"></i>
                </div>
                <h2 class="fw-bold mb-1">Stajyer Başvuru Formu</h2>
                <p class="text-muted small mb-0">Lütfen aşağıdaki bilgileri eksiksiz ve doğru şekilde doldurunuz.</p>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="<?= url('/basvuru') ?>" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ad_soyad" class="form-label"><i class="bi bi-person"></i> Ad Soyad <span class="text-danger">*</span></label>
                            <input type="text" id="ad_soyad" name="ad_soyad" class="form-control" placeholder="Örn: Ahmet Yılmaz" value="<?= htmlspecialchars($old['ad_soyad'] ?? '') ?>" required>
                            <?php if (isset($errors['ad_soyad'])): ?>
                                <div class="form-text text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i><?= $errors['ad_soyad'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label"><i class="bi bi-envelope"></i> E-posta Adresi <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="ahmet@example.com" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="form-text text-danger mt-1"><i class="bi bi-exclamation-circle me-1"></i><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <label for="telefon" class="form-label"><i class="bi bi-telephone"></i> Telefon Numarası</label>
                            <input type="tel" id="telefon" name="telefon" class="form-control" placeholder="0555 123 45 67" value="<?= htmlspecialchars($old['telefon'] ?? '') ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="universite" class="form-label"><i class="bi bi-building"></i> Üniversite</label>
                            <input type="text" id="universite" name="universite" class="form-control" placeholder="Örn: İstanbul Teknik Üniversitesi" value="<?= htmlspecialchars($old['universite'] ?? '') ?>">
                        </div>

                        <div class="col-12">
                            <label for="bolum" class="form-label"><i class="bi bi-journal-bookmark"></i> Bölüm</label>
                            <input type="text" id="bolum" name="bolum" class="form-control" placeholder="Örn: Bilgisayar Mühendisliği" value="<?= htmlspecialchars($old['bolum'] ?? '') ?>">
                        </div>

                        <div class="col-12">
                            <label for="on_yazi" class="form-label"><i class="bi bi-chat-left-text"></i> Ön Yazı / Kendinizden Bahsedin</label>
                            <textarea id="on_yazi" name="on_yazi" class="form-control" rows="4" placeholder="Kariyer hedefleriniz, yetenekleriniz ve staj yapmak isteme nedeniniz..."><?= htmlspecialchars($old['on_yazi'] ?? '') ?></textarea>
                        </div>

                        <div class="col-12">
                            <label for="staj_belgesi" class="form-label"><i class="bi bi-file-earmark-pdf"></i> Zorunlu Staj Belgesi (Sadece PDF)</label>
                            <input type="file" id="staj_belgesi" name="staj_belgesi" class="form-control" accept=".pdf">
                            <div class="form-text text-muted">Varsa onaylı staj belgenizi PDF formatında yükleyebilirsiniz.</div>
                        </div>
                    </div>

                    <div class="d-grid mt-4 pt-2">
                        <button type="submit" class="btn btn-primary-custom btn-lg">
                            <i class="bi bi-send-fill"></i> Başvurumu Gönder
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>