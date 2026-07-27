<?php
$totalCount = count($basvurular);
$pendingCount = 0;
$approvedCount = 0;
$rejectedCount = 0;

foreach ($basvurular as $b) {
    $d = $b['durum'] ?? 'Bekliyor';
    if ($d === 'Bekliyor') $pendingCount++;
    elseif ($d === 'Onaylandı') $approvedCount++;
    elseif ($d === 'Reddedildi') $rejectedCount++;
}
?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-speedometer2 text-primary me-2"></i>Gelen Staj Başvuruları</h2>
        <p class="text-muted small mb-0">Tüm staj başvurularını listeleyin, arayın ve durumlarını güncelleyin.</p>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="bi bi-folder-fill"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold">Toplam Başvuru</div>
                <div class="fs-4 fw-bold text-dark"><?= $totalCount ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold">Bekleyenler</div>
                <div class="fs-4 fw-bold text-dark"><?= $pendingCount ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold">Onaylananlar</div>
                <div class="fs-4 fw-bold text-dark"><?= $approvedCount ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div>
                <div class="text-muted small fw-semibold">Reddedilenler</div>
                <div class="fs-4 fw-bold text-dark"><?= $rejectedCount ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar Card -->
<div class="custom-card p-3 mb-4 bg-white">
    <form method="GET" action="<?= url('/admin/dashboard') ?>" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label for="search" class="form-label"><i class="bi bi-search"></i> Arama Yap</label>
            <input type="text" id="search" name="search" class="form-control" value="<?= htmlspecialchars($filters['search'] ?? '') ?>" placeholder="Ad soyad veya e-posta...">
        </div>
        <div class="col-md-4">
            <label for="status" class="form-label"><i class="bi bi-funnel"></i> Durum Filtresi</label>
            <select id="status" name="status" class="form-select">
                <option value="">Tümü</option>
                <option value="Bekliyor" <?= ($filters['status'] ?? '') === 'Bekliyor' ? 'selected' : '' ?>>Bekliyor</option>
                <option value="Onaylandı" <?= ($filters['status'] ?? '') === 'Onaylandı' ? 'selected' : '' ?>>Onaylandı</option>
                <option value="Reddedildi" <?= ($filters['status'] ?? '') === 'Reddedildi' ? 'selected' : '' ?>>Reddedildi</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary-custom w-100">
                <i class="bi bi-filter"></i> Filtrele
            </button>
            <?php if (!empty($filters['search']) || !empty($filters['status'])): ?>
                <a href="<?= url('/admin/dashboard') ?>" class="btn btn-outline-secondary" title="Sıfırla">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Applications Table -->
<div class="table-card shadow-sm mb-4">
    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Aday Bilgisi</th>
                    <th>E-posta</th>
                    <th>Başvuru Tarihi</th>
                    <th>Durum</th>
                    <th class="text-end" style="width: 130px;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($basvurular)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                            Kayıtlı başvuru bulunamadı.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($basvurular as $basvuru): ?>
                        <tr>
                            <td class="fw-semibold text-muted">#<?= $basvuru['id'] ?></td>
                            <td>
                                <a href="<?= url('/admin/basvuru?id=' . $basvuru['id']) ?>" class="fw-bold text-dark text-decoration-none">
                                    <?= htmlspecialchars($basvuru['ad_soyad']) ?>
                                </a>
                                <?php if (!empty($basvuru['universite'])): ?>
                                    <div class="small text-muted"><?= htmlspecialchars($basvuru['universite']) ?></div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="small text-secondary"><?= htmlspecialchars($basvuru['email']) ?></span>
                            </td>
                            <td>
                                <span class="small text-muted">
                                    <i class="bi bi-calendar3 me-1"></i><?= date('d.m.Y H:i', strtotime($basvuru['basvuru_tarihi'])) ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                    $durum = $basvuru['durum'] ?? 'Bekliyor';
                                    if ($durum === 'Onaylandı') {
                                        echo '<span class="badge-status badge-onaylandi"><i class="bi bi-check-circle-fill"></i> Onaylandı</span>';
                                    } elseif ($durum === 'Reddedildi') {
                                        echo '<span class="badge-status badge-reddedildi"><i class="bi bi-x-circle-fill"></i> Reddedildi</span>';
                                    } else {
                                        echo '<span class="badge-status badge-bekliyor"><i class="bi bi-clock-history"></i> Bekliyor</span>';
                                    }
                                ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= url('/admin/basvuru?id=' . $basvuru['id']) ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    İncele <i class="bi bi-chevron-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (isset($totalPages) && $totalPages > 1): ?>
<nav aria-label="Page navigation" class="mt-4">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php
            $queryParams = array_merge($filters, ['page' => $i]);
            ?>
            <li class="page-item <?= ($i == ($currentPage ?? 1)) ? 'active' : '' ?>">
                <a class="page-link" href="?<?= http_build_query($queryParams) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>