<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-1"><i class="fas fa-box-open" style="color: var(--secondary-color); margin-right:.5rem;"></i>Paket Layanan</h2>
            <p class="text-muted mb-0">Kelola daftar paket dan estimasi pengerjaan laundry Anda.</p>
        </div>
        <a href="/paket/create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Paket
        </a>
    </div>

    <!-- Data Panel -->
    <div class="card glass-panel border-0 p-3">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Nama Paket</th>
                        <th>Harga / Kg</th>
                        <th>Estimasi Pengerjaan</th>
                        <th>Deskripsi</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($paket)): ?>
                        <?php foreach ($paket as $p): ?>
                        <tr>
                            <td class="text-muted fw-bold">#<?= $p['id_paket'] ?></td>
                            <td>
                                <div class="fw-bold text-light" style="color: var(--text-color) !important;"><?= $p['nama_paket'] ?></div>
                            </td>
                            <td>
                                <span class="fw-bold" style="color: var(--primary-color);">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
                            </td>
                            <td>
                                <span class="badge" style="background: rgba(212,175,55,0.12); color: var(--secondary-color); border:1px solid rgba(212,175,55,0.14);">
                                    <i class="far fa-clock me-1"></i><?= $p['estimasi'] ?>
                                </span>
                            </td>
                            <td>
                                <p class="text-muted mb-0 text-truncate" style="max-width: 250px;" title="<?= $p['deskripsi'] ?>">
                                    <?= !empty($p['deskripsi']) ? $p['deskripsi'] : '-' ?>
                                </p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="/paket/edit/<?= $p['id_paket'] ?>" class="btn btn-sm btn-warning" title="Edit Paket">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/paket/delete/<?= $p['id_paket'] ?>" class="btn btn-sm btn-danger" title="Hapus Paket">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-3x" style="opacity: 0.3;"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Belum Ada Paket</h5>
                            <p class="text-xs">Silakan tambahkan paket layanan laundry baru untuk memulainya.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
