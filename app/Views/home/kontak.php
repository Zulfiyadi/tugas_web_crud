<div class="container-fluid">
    <!-- Page Header -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1"><i class="fas fa-id-card text-primary me-2"></i>Kontak Usaha</h2>
        <p class="text-muted mb-0">Informasi profil, operasional, dan kontak bisnis Laundry.In.</p>
    </div>

    <div class="row g-4">
        <!-- Contact Details -->
        <div class="col-lg-8">
            <div class="card glass-panel border-0 p-4 h-100">
                <div class="card-header bg-transparent border-0 ps-0 pb-3 mb-3" style="border-bottom: 1px solid var(--glass-border) !important;">
                    <h5 class="fw-bold mb-0 text-light" style="color: var(--text-color) !important;">
                        <i class="fas fa-info-circle text-primary me-2"></i>Profil Resmi
                    </h5>
                </div>

                <div class="row g-4 mb-4">
                    <!-- Nama Laundry -->
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-opacity-10 bg-primary p-2" style="background: rgba(0, 245, 212, 0.1); width: 44px; height: 44px; min-width: 44px;">
                                <i class="fas fa-store text-primary" style="font-size: 1.25rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Nama Usaha</small>
                                <span class="fs-6 fw-bold text-light" style="color: var(--text-color) !important;"><?= $nama_laundry ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-opacity-10 bg-primary p-2" style="background: rgba(0, 245, 212, 0.1); width: 44px; height: 44px; min-width: 44px;">
                                <i class="fas fa-phone-alt text-primary" style="font-size: 1.25rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Nomor Telepon</small>
                                <a href="tel:<?= $no_telepon ?>" class="fs-6 fw-bold text-decoration-none" style="color: var(--primary-color) !important;"><?= $no_telepon ?></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <!-- Email -->
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-opacity-10 bg-primary p-2" style="background: rgba(0, 245, 212, 0.1); width: 44px; height: 44px; min-width: 44px;">
                                <i class="fas fa-envelope text-primary" style="font-size: 1.25rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Alamat Email</small>
                                <a href="mailto:<?= $email ?>" class="fs-6 fw-bold text-decoration-none" style="color: var(--primary-color) !important;"><?= $email ?></a>
                            </div>
                        </div>
                    </div>

                    <!-- Jam Operasional -->
                    <div class="col-sm-6">
                        <div class="d-flex align-items-start gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-opacity-10 bg-primary p-2" style="background: rgba(0, 245, 212, 0.1); width: 44px; height: 44px; min-width: 44px;">
                                <i class="fas fa-clock text-primary" style="font-size: 1.25rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Jam Operasional</small>
                                <span class="fs-6 fw-bold text-light" style="color: var(--text-color) !important;"><?= $jam_operasional ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Alamat -->
                    <div class="col-12">
                        <div class="d-flex align-items-start gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 bg-opacity-10 bg-primary p-2" style="background: rgba(0, 245, 212, 0.1); width: 44px; height: 44px; min-width: 44px;">
                                <i class="fas fa-map-marked-alt text-primary" style="font-size: 1.25rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Alamat Operasional</small>
                                <span class="fs-6 fw-bold text-light" style="color: var(--text-color) !important;"><?= $alamat ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card Sidebar -->
        <div class="col-lg-4">
            <div class="card glass-panel border-0 p-4 h-100 text-center d-flex flex-column align-items-center justify-content-center">
                <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: rgba(0,245,212,0.15); border: 1px solid rgba(0,245,212,0.3); color: var(--primary-color); box-shadow: 0 0 15px rgba(0,245,212,0.1);">
                    <i class="fas fa-headset" style="font-size: 2.2rem;"></i>
                </div>
                <h5 class="fw-bold mb-2">Butuh Bantuan?</h5>
                <p class="text-muted fs-7 mb-0">
                    Tim administrasi kami siap melayani Anda. Jika terdapat kendala sistem operasional atau butuh bantuan lebih lanjut mengenai pesanan pelanggan, silakan hubungi kontak di sebelah atau datang langsung ke gerai kami.
                </p>
            </div>
        </div>
    </div>
</div>
