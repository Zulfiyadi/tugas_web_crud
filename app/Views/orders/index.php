<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-1"><i class="fas fa-shopping-cart" style="color: var(--secondary-color); margin-right:.5rem;"></i>Order Laundry</h2>
            <p class="text-muted mb-0">Kelola dan pantau seluruh transaksi cucian pelanggan Anda.</p>
        </div>
        <a href="/orders/create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Order
        </a>
    </div>

    <!-- Data Panel -->
    <div class="card glass-panel border-0 p-3">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Nomor HP</th>
                        <th>Berat (kg)</th>
                        <th>Total Harga</th>
                        <th>Tanggal Masuk</th>
                        <th>Status Laundry</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $o): ?>
                        <tr>
                            <td class="text-muted fw-bold">#<?= $o['id_order'] ?></td>
                            <td>
                                <div class="fw-bold text-light" style="color: var(--text-color) !important;"><?= $o['nama_pelanggan'] ?></div>
                            </td>
                            <td>
                                <a href="tel:<?= $o['no_hp'] ?>" class="text-muted text-decoration-none hover-primary">
                                    <i class="fas fa-phone-alt me-1" style="color: var(--secondary-color); font-size: 0.85rem;"></i><?= $o['no_hp'] ?>
                                </a>
                            </td>
                            <td>
                                <span class="fw-bold"><?= number_format($o['berat'], 2, ',', '.') ?> kg</span>
                            </td>
                            <td>
                                <span class="fw-bold text-primary">Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></span>
                            </td>
                            <td>
                                <span class="text-muted"><i class="far fa-calendar-alt me-1"></i><?= date('d M Y', strtotime($o['tanggal_masuk'])) ?></span>
                            </td>
                            <td>
                                <?php
                                    $badge_class = $o['status'] == 'Selesai' ? 'success' : 
                                                 ($o['status'] == 'Proses' ? 'warning' : 'danger');
                                    
                                    $status_icon = $o['status'] == 'Selesai' ? 'fa-check-double' : 
                                                 ($o['status'] == 'Proses' ? 'fa-spinner fa-spin' : 'fa-times');
                                ?>
                                <span class="badge bg-<?= $badge_class ?> d-inline-flex align-items-center gap-1">
                                    <i class="fas <?= $status_icon ?>" style="font-size: 0.75rem;"></i>
                                    <?= $o['status'] ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="/orders/edit/<?= $o['id_order'] ?>" class="btn btn-sm btn-warning" title="Edit Orderan">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/orders/delete/<?= $o['id_order'] ?>" class="btn btn-sm btn-danger" title="Hapus Orderan">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-3x" style="opacity: 0.3;"></i>
                            </div>
                            <h5 class="fw-bold mb-1">Belum Ada Orderan</h5>
                            <p class="text-xs">Silakan tambahkan data transaksi order laundry untuk memulainya.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
