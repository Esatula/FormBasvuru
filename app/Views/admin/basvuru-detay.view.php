<div class="mb-3">
    <a href="<?= url('/admin/dashboard') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Listeye Geri Dön
    </a>
</div>

<div class="custom-card shadow-sm mb-4">
    <div class="custom-card-header d-flex flex-wrap align-items-center justify-content-between gap-3 py-3">
        <div class="d-flex align-items-center gap-3">
            <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 48px; height: 48px;">
                <i class="bi bi-person-badge-fill fs-4"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0"><?= htmlspecialchars($basvuru['ad_soyad']) ?></h3>
                <span class="text-muted small">Başvuru #<?= $basvuru['id'] ?></span>
            </div>
        </div>
        <div>
            <?php
                $durum = htmlspecialchars($basvuru['durum']);
                if ($durum === 'Onaylandı') {
                    echo '<span class="badge-status badge-onaylandi fs-6 px-3 py-2"><i class="bi bi-check-circle-fill"></i> Onaylandı</span>';
                } elseif ($durum === 'Reddedildi') {
                    echo '<span class="badge-status badge-reddedildi fs-6 px-3 py-2"><i class="bi bi-x-circle-fill"></i> Reddedildi</span>';
                } else {
                    echo '<span class="badge-status badge-bekliyor fs-6 px-3 py-2"><i class="bi bi-clock-history"></i> Bekliyor</span>';
                }
            ?>
        </div>
    </div>
    
    <div class="card-body p-4">
        <!-- Info Grid -->
        <h5 class="fw-bold mb-3 text-secondary"><i class="bi bi-info-circle me-1"></i> Kişisel & Eğitim Bilgileri</h5>
        <div class="row g-3 mb-4">
            <div class="col-md-6 col-lg-4">
                <div class="p-3 bg-light rounded-3 border">
                    <div class="text-muted small"><i class="bi bi-envelope me-1"></i> E-posta Adresi</div>
                    <div class="fw-semibold text-dark text-break"><?= htmlspecialchars($basvuru['email']) ?></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-3 bg-light rounded-3 border">
                    <div class="text-muted small"><i class="bi bi-telephone me-1"></i> Telefon</div>
                    <div class="fw-semibold text-dark"><?= htmlspecialchars($basvuru['telefon'] ?? 'Belirtilmemiş') ?></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="p-3 bg-light rounded-3 border">
                    <div class="text-muted small"><i class="bi bi-calendar-event me-1"></i> Başvuru Tarihi</div>
                    <div class="fw-semibold text-dark"><?= date('d.m.Y H:i', strtotime($basvuru['basvuru_tarihi'])) ?></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="p-3 bg-light rounded-3 border">
                    <div class="text-muted small"><i class="bi bi-building me-1"></i> Üniversite</div>
                    <div class="fw-semibold text-dark"><?= htmlspecialchars($basvuru['universite'] ?? 'Belirtilmemiş') ?></div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="p-3 bg-light rounded-3 border">
                    <div class="text-muted small"><i class="bi bi-journal-bookmark me-1"></i> Bölüm</div>
                    <div class="fw-semibold text-dark"><?= htmlspecialchars($basvuru['bolum'] ?? 'Belirtilmemiş') ?></div>
                </div>
            </div>
        </div>

        <?php if (!empty($basvuru['on_yazi'])): ?>
            <h5 class="fw-bold mb-2 text-secondary"><i class="bi bi-chat-quote me-1"></i> Ön Yazı</h5>
            <div class="p-3 bg-light rounded-3 border mb-4 text-dark position-relative">
                <?= nl2br(htmlspecialchars($basvuru['on_yazi'])) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($basvuru['staj_belgesi_yolu'])): ?>
            <h5 class="fw-bold mb-2 text-secondary"><i class="bi bi-file-earmark-pdf me-1"></i> Ekli Belge</h5>
            <div class="p-3 bg-white rounded-3 border d-flex align-items-center justify-content-between mb-4 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-danger fs-2">
                        <i class="bi bi-file-earmark-pdf-fill"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark">Zorunlu Staj Belgesi</div>
                        <div class="text-muted small">Eklenen PDF dosyasını görüntülemek için tıklayın.</div>
                    </div>
                </div>
                <a href="<?= url('/' . ltrim($basvuru['staj_belgesi_yolu'], '/')) ?>" class="btn btn-outline-primary rounded-pill px-3" target="_blank">
                    <i class="bi bi-box-arrow-up-right me-1"></i> Belgeyi Görüntüle
                </a>
            </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <hr class="my-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h5 class="fw-bold mb-1"><i class="bi bi-sliders me-1"></i> Başvuru İşlemleri</h5>
                <p class="text-muted small mb-0">Başvuruyu onaylayabilir, reddedebilir veya sistemden kalıcı olarak silebilirsiniz.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <form action="<?= url('/admin/basvuru/guncelle') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $basvuru['id'] ?>">
                    <input type="hidden" name="durum" value="Onaylandı">
                    <button type="submit" class="btn btn-success rounded-pill px-4" <?= $durum === 'Onaylandı' ? 'disabled' : '' ?>>
                        <i class="bi bi-check-lg me-1"></i> Onayla
                    </button>
                </form>
                <form action="<?= url('/admin/basvuru/guncelle') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $basvuru['id'] ?>">
                    <input type="hidden" name="durum" value="Reddedildi">
                    <button type="submit" class="btn btn-warning text-dark rounded-pill px-4" <?= $durum === 'Reddedildi' ? 'disabled' : '' ?>>
                        <i class="bi bi-x-lg me-1"></i> Reddet
                    </button>
                </form>
                <form action="<?= url('/admin/basvuru/sil') ?>" method="POST" onsubmit="return confirm('Bu başvuruyu kalıcı olarak silmek istediğinizden emin misiniz? Bu işlem geri alınamaz!');">
                    <input type="hidden" name="id" value="<?= $basvuru['id'] ?>">
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                        <i class="bi bi-trash-fill me-1"></i> Başvuruyu Sil
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>