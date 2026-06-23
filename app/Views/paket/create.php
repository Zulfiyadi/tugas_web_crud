<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Glassmorphic Card -->
            <div class="card glass-panel border-0 p-4">
                <div class="card-header bg-transparent border-0 ps-0 pb-3 mb-3" style="border-bottom: 1px solid var(--glass-border) !important;">
                    <h4 class="fw-bold mb-1"><i class="fas fa-plus" style="color: var(--secondary-color); margin-right:.5rem;"></i>Tambah Paket Layanan</h4>
                    <p class="text-muted mb-0 fs-7">Masukkan detail informasi untuk membuat paket laundry baru.</p>
                </div>

                <form action="/paket/create" method="post">
                    <!-- Nama Paket -->
                    <div class="mb-3">
                        <label class="form-label" for="nama_paket">Nama Paket</label>
                        <input type="text" id="nama_paket" name="nama_paket" class="form-control" placeholder="Contoh: Paket Cuci Kering Setrika" required autocomplete="off">
                    </div>

                    <div class="row">
                        <!-- Harga per Kg -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="harga">Harga per Kg (Rp)</label>
                            <div class="input-group">
                                    <span class="input-group-text border-0" style="background-color: rgba(255,255,255,0.03); color: var(--text-color);">Rp</span>
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="Contoh: 8000" required>
                            </div>
                        </div>

                        <!-- Estimasi Pengerjaan -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="estimasi">Estimasi Pengerjaan</label>
                            <input type="text" id="estimasi" name="estimasi" class="form-control" placeholder="Contoh: 2 Hari" required>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label" for="deskripsi">Deskripsi Paket</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" placeholder="Tuliskan keterangan detail mengenai paket layanan ini..."></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>Simpan Paket
                        </button>
                        <a href="/paket" class="btn btn-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
