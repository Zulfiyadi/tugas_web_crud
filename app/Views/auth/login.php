<div class="container d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-10">
            <!-- Glassmorphic Login Card -->
            <div class="card glass-panel p-4 p-sm-5 border-0">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--secondary-color) 0%, rgba(80,200,120,0.12) 100%); border: 1px solid rgba(212,175,55,0.22); box-shadow: 0 8px 20px rgba(212,175,55,0.08);">
                        <i class="fas fa-tshirt" style="font-size: 1.8rem; color: #071021;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Masuk Admin</h3>
                    <p class="text-muted fs-7">Sistem Informasi Laundry.In</p>
                </div>

                <form action="/auth/login" method="post">
                    <!-- Username Field -->
                    <div class="mb-3">
                        <label class="form-label" for="username"><i class="far fa-user me-2" style="color: var(--secondary-color);"></i>Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username Anda" required autocomplete="off">
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
                        <label class="form-label" for="password"><i class="fas fa-lock me-2" style="color: var(--secondary-color);"></i>Password</label>
                        <div class="position-relative">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                    </button>
                </form>

                <div class="text-center mt-3 pt-3 border-top" style="border-top-color: var(--glass-border) !important;">
                    <p class="text-muted fs-7 mb-0">
                        Belum terdaftar? <a href="/auth/register" class="fw-semibold ms-1" style="color: var(--secondary-color); text-decoration: none;">Buat Akun Baru</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
