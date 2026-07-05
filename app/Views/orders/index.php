<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h2 class="fw-bold mb-1"><i class="fas fa-shopping-cart" style="color: var(--secondary-color); margin-right:.5rem;"></i>Order Laundry</h2>
            <p class="text-muted mb-0">Kelola dan pantau seluruh transaksi cucian pelanggan Anda.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="/orders/create" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Order
            </a>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="fas fa-shopping-basket me-2"></i>Keranjang (<?= count($cartItems) ?>)
            </button>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <div class="row g-4 mb-4">
        <div class="col-lg-7">
            <div class="card glass-panel border-0 p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-plus-circle me-2" style="color: var(--secondary-color);"></i>Tambah Item ke Keranjang</h5>
                </div>
                <form action="/orders/cart/add" method="post">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label">Paket Layanan</label>
                            <select name="id_paket" class="form-select" required>
                                <option value="">-- Pilih Paket --</option>
                                <?php foreach ((new \App\Models\PaketLayanan())->findAll() as $p): ?>
                                    <option value="<?= $p['id_paket'] ?>"><?= $p['nama_paket'] ?> - Rp <?= number_format($p['harga'], 0, ',', '.') ?>/kg</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Qty</label>
                            <input type="number" name="qty" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card glass-panel border-0 p-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-wallet me-2" style="color: var(--secondary-color);"></i>Ringkasan Keranjang</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Jumlah Item</span>
                    <span class="fw-semibold"><?= count($cartItems) ?></span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Total</span>
                    <span class="fw-bold text-primary">Rp <?= number_format($cartTotal, 0, ',', '.') ?></span>
                </div>
                <form action="/orders/cart/destroy" method="post" class="d-inline">
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-trash me-2"></i>Kosongkan
                    </button>
                </form>
            </div>
        </div>
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

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content glass-panel border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="cartModalLabel"><i class="fas fa-shopping-basket me-2" style="color: var(--secondary-color);"></i>Keranjang Belanja</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($cartItems)): ?>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cartItems as $rowid => $item): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?= esc($item['name']) ?></div>
                                            <small class="text-muted">Estimasi: <?= esc($item['options']['estimasi'] ?? '-') ?></small>
                                        </td>
                                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                                        <td style="min-width: 120px;">
                                            <form action="/orders/cart/update" method="post" class="d-flex gap-2">
                                                <input type="hidden" name="rowid" value="<?= $rowid ?>">
                                                <input type="number" name="qty" class="form-control form-control-sm" value="<?= $item['qty'] ?>" min="1" required>
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Ubah</button>
                                            </form>
                                        </td>
                                        <td>Rp <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?></td>
                                        <td>
                                            <form action="/orders/cart/remove" method="post" class="d-inline">
                                                <input type="hidden" name="rowid" value="<?= $rowid ?>">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                        <p class="mb-0">Keranjang masih kosong.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer border-0">
                <div class="me-auto fw-bold">Total: Rp <?= number_format($cartTotal, 0, ',', '.') ?></div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
