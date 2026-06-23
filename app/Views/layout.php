<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Laundry.In' ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Theme stylesheet -->
    <!-- Theme stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme.css') ?>">
</head>
<body>
    <!-- Background elements -->
    <div class="ambient-bg-glow glow-1"></div>
    <div class="ambient-bg-glow glow-2"></div>

    <!-- Loading Screen -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <?php if (session()->get('logged_in')): ?>
            <button class="btn btn-outline-light border-0 me-2" id="sidebarToggle" style="color: var(--text-color);">
                <i class="fas fa-bars"></i>
            </button>
            <?php endif; ?>
            
            <a class="navbar-brand" href="/">
                <i class="fas fa-tshirt"></i> Laundry.In
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white"><i class="fas fa-ellipsis-v"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center flex-row justify-content-end gap-2 mt-2 mt-lg-0">
                    <!-- Light/Dark Mode Switcher -->
                    <li class="nav-item">
                        <button id="themeToggle" class="btn btn-outline-light border-0" style="color: var(--text-color); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>

                    <?php if (session()->get('logged_in')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--text-color);">
                            <span class="profile-avatar" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                            </span>
                            <span class="d-none d-md-inline"><?= session()->get('username') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end rounded-3 mt-2" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/"><i class="fas fa-home me-2"></i> Dashboard</a></li>
                            <li><a class="dropdown-item" href="/kontak"><i class="fas fa-phone me-2"></i> Kontak</a></li>
                            <li><hr class="dropdown-divider" style="background-color: var(--glass-border);"></li>
                            <li><a class="dropdown-item text-danger" href="/auth/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light border-0" href="/auth/login" style="color: var(--text-color);">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="/auth/register" style="padding: 8px 16px;">Daftar</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="app-container">
        <!-- Sidebar Navigation -->
        <?php if (session()->get('logged_in')): ?>
        <aside class="sidebar" id="sidebarContainer">
            <nav class="nav flex-column">
                <a class="nav-link <?= current_url() == base_url('/') ? 'active' : '' ?>" href="/">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a class="nav-link <?= strpos(current_url(), '/paket') !== false ? 'active' : '' ?>" href="/paket">
                    <i class="fas fa-box-open"></i>
                    <span>Paket Layanan</span>
                </a>
                <a class="nav-link <?= strpos(current_url(), '/orders') !== false ? 'active' : '' ?>" href="/orders">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Order Laundry</span>
                </a>
                <a class="nav-link <?= strpos(current_url(), '/kontak') !== false ? 'active' : '' ?>" href="/kontak">
                    <i class="fas fa-id-card"></i>
                    <span>Hubungi Kontak</span>
                </a>
            </nav>

            <div class="sidebar-profile">
                <div class="profile-avatar">
                    <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                </div>
                <div class="profile-details">
                    <div class="text-white fw-bold fs-6" style="color: var(--text-color) !important;"><?= session()->get('username') ?></div>
                    <small class="text-muted" style="color: var(--muted-color) !important;">Administrator</small>
                </div>
            </div>
        </aside>
        <?php endif; ?>

        <!-- Main Dynamic Content -->
        <main class="content-area fade-in">
            <?= view($content) ?>
        </main>
    </div>

    <!-- Confirm Delete Modal (Glassmorphic) -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-panel" style="border: 1px solid var(--glass-border); border-radius: 16px;">
                <div class="modal-header" style="border-bottom: 1px solid var(--glass-border);">
                    <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="fas fa-exclamation-triangle text-warning me-2"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                </div>
                <div class="modal-body py-4">
                    Apakah Anda yakin ingin menghapus data ini? Tindakan ini bersifat permanen.
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--glass-border);">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-primary" style="background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">&copy; 2026 Laundry.In. Made with <i class="fas fa-heart text-danger"></i> for visual excellence.</p>
        </div>
    </footer>

    <!-- Toast Notifications Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Loading Overlay functions
        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('active');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.remove('active');
        }

        // Theme Toggle Script
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;

        const savedTheme = localStorage.getItem('theme') || 'dark';
        if (savedTheme === 'light') {
            body.classList.add('light-theme');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        } else {
            themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
        }

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('light-theme');
            const isLight = body.classList.contains('light-theme');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
            themeToggle.innerHTML = isLight ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            window.dispatchEvent(new Event('themechange'));
        });

        // Sidebar Toggle Script
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', body.classList.contains('sidebar-collapsed') ? 'true' : 'false');
            });
            // Restore sidebar status
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                body.classList.add('sidebar-collapsed');
            }
        }

        // Custom Toast Function
        function createToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'custom-toast';
            
            let icon = '<i class="fas fa-check-circle text-success" style="font-size: 1.25rem;"></i>';
            if (type === 'error' || type === 'danger') {
                icon = '<i class="fas fa-times-circle text-danger" style="font-size: 1.25rem;"></i>';
            } else if (type === 'warning') {
                icon = '<i class="fas fa-exclamation-circle text-warning" style="font-size: 1.25rem;"></i>';
            }

            toast.innerHTML = `
                ${icon}
                <div style="font-weight: 500;">${message}</div>
            `;
            container.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => toast.classList.add('show'), 50);
            
            // Auto close after 3.5s
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 400);
            }, 3500);
        }

        // Confirm Delete Modal Integration
        const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');

        document.querySelectorAll('a[href*="/delete/"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                confirmDeleteButton.setAttribute('href', element.getAttribute('href'));
                confirmDeleteModal.show();
            });
        });

        // Bind form submissions to show loading animation
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                showLoading();
            });
        });

        // Show flash message triggers
        <?php if (session()->getFlashdata('success')): ?>
            createToast("<?= session()->getFlashdata('success') ?>", 'success');
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            createToast("<?= session()->getFlashdata('error') ?>", 'danger');
        <?php endif; ?>
    </script>
</body>
</html>
