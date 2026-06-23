<div class="container d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-10">
            <!-- Glassmorphic Register Card -->
            <div class="card glass-panel p-4 p-sm-5 border-0">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--secondary-color) 0%, rgba(80,200,120,0.12) 100%); border: 1px solid rgba(212,175,55,0.22); box-shadow: 0 8px 20px rgba(212,175,55,0.08);">
                        <i class="fas fa-user-plus" style="font-size: 1.6rem; color: #071021;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">Registrasi Admin</h3>
                    <p class="text-muted fs-7">Sistem Informasi Laundry.In</p>
                </div>

                <form action="/auth/register" method="post" id="registerForm">
                    <!-- Username Field -->
                    <div class="mb-3 position-relative">
                        <label class="form-label" for="username"><i class="far fa-user me-2" style="color: var(--secondary-color);"></i>Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Pilih username unik" required autocomplete="off">
                        <small class="form-text text-danger d-none" id="usernameFeedback">Username minimal harus 3 karakter.</small>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label class="form-label" for="password"><i class="fas fa-lock me-2" style="color: var(--secondary-color);"></i>Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Pilih password kuat" required>
                        
                        <!-- Password Strength Meter -->
                        <div class="mt-2">
                            <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.08);">
                                <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <small class="text-muted" id="strengthText">Kekuatan: Sangat Lemah</small>
                                <small class="text-muted text-xs" style="font-size:0.75rem;">Min. 6 karakter</small>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 py-3 mb-3 mt-2" id="submitBtn">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </button>
                </form>

                <div class="text-center mt-3 pt-3 border-top" style="border-top-color: var(--glass-border) !important;">
                    <p class="text-muted fs-7 mb-0">
                        Sudah punya akun? <a href="/auth/login" class="fw-semibold ms-1" style="color: var(--secondary-color); text-decoration: none;">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        const usernameFeedback = document.getElementById('usernameFeedback');
        const registerForm = document.getElementById('registerForm');

        // Username inline validation
        usernameInput.addEventListener('input', () => {
            if (usernameInput.value.length < 3 && usernameInput.value.length > 0) {
                usernameInput.style.borderColor = 'var(--accent-color)';
                usernameFeedback.classList.remove('d-none');
            } else if (usernameInput.value.length >= 3) {
                usernameInput.style.borderColor = 'var(--primary-color)';
                usernameFeedback.classList.add('d-none');
            } else {
                usernameInput.style.borderColor = 'var(--glass-border)';
                usernameFeedback.classList.add('d-none');
            }
        });

        // Password strength checker
        passwordInput.addEventListener('input', () => {
            const val = passwordInput.value;
            let score = 0;
            
            if (val.length === 0) {
                score = 0;
            } else {
                if (val.length >= 6) score += 25;
                if (/[A-Z]/.test(val)) score += 25;
                if (/[0-9]/.test(val)) score += 25;
                if (/[^A-Za-z0-9]/.test(val)) score += 25;
            }

            // Update strength bar color and text
            strengthBar.style.width = score + '%';
            if (score === 0) {
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.innerText = 'Kekuatan: Sangat Lemah';
                strengthText.className = 'text-muted';
                passwordInput.style.borderColor = 'var(--glass-border)';
            } else if (score <= 25) {
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.innerText = 'Kekuatan: Lemah';
                strengthText.className = 'text-danger';
                passwordInput.style.borderColor = 'var(--accent-color)';
            } else if (score <= 50) {
                strengthBar.className = 'progress-bar bg-warning';
                strengthText.innerText = 'Kekuatan: Sedang';
                strengthText.className = 'text-warning';
                passwordInput.style.borderColor = 'var(--secondary-color)';
            } else {
                strengthBar.className = 'progress-bar bg-success';
                strengthText.innerText = 'Kekuatan: Kuat';
                strengthText.className = 'text-success';
                passwordInput.style.borderColor = 'var(--primary-color)';
            }
        });

        // Form Submit check
        registerForm.addEventListener('submit', function(e) {
            if (usernameInput.value.length < 3) {
                e.preventDefault();
                createToast("Username minimal harus 3 karakter!", 'danger');
            } else if (passwordInput.value.length < 6) {
                e.preventDefault();
                createToast("Password minimal harus 6 karakter!", 'danger');
            }
        });
    });
</script>
