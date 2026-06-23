<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Glassmorphic Card -->
            <div class="card glass-panel border-0 p-4">
                <div class="card-header bg-transparent border-0 ps-0 pb-3 mb-3" style="border-bottom: 1px solid var(--glass-border) !important;">
                    <h4 class="fw-bold mb-1"><i class="fas fa-edit" style="color: var(--secondary-color); margin-right:.5rem;"></i>Edit Order Laundry</h4>
                    <p class="text-muted mb-0 fs-7">Ubah detail transaksi laundry pelanggan.</p>
                </div>

                <form action="/orders/edit/<?= $order['id_order'] ?>" method="post">
                    <div class="row">
                        <!-- Nama Pelanggan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_pelanggan">Nama Pelanggan</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" value="<?= $order['nama_pelanggan'] ?>" required autocomplete="off">
                        </div>

                        <!-- Nomor HP -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="no_hp">Nomor Telepon / HP</label>
                            <div class="input-group">
                                <span class="input-group-text border-0" style="background-color: rgba(255,255,255,0.03); color: var(--text-color);"><i class="fas fa-phone-alt" style="color: var(--secondary-color);"></i></span>
                                <input type="tel" id="no_hp" name="no_hp" class="form-control" value="<?= $order['no_hp'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Paket Layanan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="id_paket">Paket Layanan</label>
                            <select id="id_paket" name="id_paket" class="form-select" required>
                                <option value="">-- Pilih Paket --</option>
                                <?php foreach ($paket as $p): ?>
                                <option value="<?= $p['id_paket'] ?>" <?= $p['id_paket'] == $order['id_paket'] ? 'selected' : '' ?>>
                                    <?= $p['nama_paket'] ?> - Rp <?= number_format($p['harga'], 0, ',', '.') ?>/kg
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Berat Cucian -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="berat">Berat Cucian (kg)</label>
                            <div class="input-group">
                                <input type="number" id="berat" name="berat" class="form-control" step="0.01" value="<?= $order['berat'] ?>" required>
                                <span class="input-group-text border-0" style="background-color: rgba(255,255,255,0.05); color: var(--text-color);">Kg</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tanggal Masuk -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="<?= $order['tanggal_masuk'] ?>" required>
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="<?= $order['tanggal_selesai'] ?>">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4 col-md-6">
                        <label class="form-label" for="status">Status Order</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="Proses" <?= $order['status'] == 'Proses' ? 'selected' : '' ?>>Proses</option>
                            <option value="Selesai" <?= $order['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            <option value="Dibatalkan" <?= $order['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                        </select>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="/orders" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
