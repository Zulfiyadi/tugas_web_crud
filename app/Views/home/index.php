<div class="container-fluid">
    <!-- Top Greeting Section -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h1 class="h2 fw-bold mb-1">Selamat Datang, <?= session()->get('username') ?>! 👋</h1>
            <p class="text-muted mb-0">Kelola data dan pantau performa laundry secara real-time.</p>
        </div>
        <div>
            <span class="badge py-2 px-3" style="background: rgba(80,200,120,0.12); color: var(--primary-color); border:1px solid rgba(80,200,120,0.18);"><i class="fas fa-check-circle me-1"></i> Sistem Aktif</span>
        </div>
    </div>

    <!-- Analytics Dashboard Row -->
    <div class="row g-4 mb-4">
        <!-- Stats Widgets -->
        <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="row g-4">
                <div class="col-12">
                    <div class="card glass-panel p-4 text-start position-relative overflow-hidden" style="min-height: 125px;">
                        <div class="position-absolute" style="right: -10px; top: -10px; opacity: 0.06; font-size: 6rem; color: var(--secondary-color); pointer-events: none;">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <small class="text-muted text-uppercase fw-semibold tracking-wider">Total Paket Layanan</small>
                        <h2 class="display-6 fw-bold mt-2 mb-0" style="color: var(--primary-color);"><?= $total_paket ?></h2>
                        <div class="d-flex align-items-center gap-1 mt-3 fs-7">
                            <span class="text-success"><i class="fas fa-arrow-trend-up"></i> +12.4%</span>
                            <span class="text-muted">dari bulan kemarin</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <div class="card glass-panel p-4 text-start position-relative overflow-hidden" style="min-height: 125px;">
                        <div class="position-absolute" style="right: -15px; top: -15px; opacity: 0.06; font-size: 6rem; color: var(--secondary-color); pointer-events: none;">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <small class="text-muted text-uppercase fw-semibold tracking-wider">Total Order Masuk</small>
                        <h2 class="display-6 fw-bold mt-2 mb-0"><?= $total_order ?></h2>
                        <div class="d-flex align-items-center gap-1 mt-3 fs-7">
                            <span class="text-success"><i class="fas fa-arrow-trend-up"></i> +8.2%</span>
                            <span class="text-muted">tingkat konversi order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Chart Card -->
        <div class="col-xl-8 col-lg-7 col-md-12">
            <div class="card glass-panel h-100 p-3">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pb-3">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-chart-line" style="color: var(--secondary-color); margin-right: .5rem;"></i> Performa Pemasukan & Order</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-secondary py-1 px-3" type="button">
                            6 Bulan Terakhir
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div style="position: relative; height: 180px; width: 100%;">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tables Row -->
    <div class="row g-4">
        <!-- Paket Terbaru -->
        <div class="col-lg-6 col-md-12">
            <div class="card glass-panel h-100">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <span class="fw-bold"><i class="fas fa-list" style="color: var(--secondary-color); margin-right: .5rem;"></i> Paket Layanan Terbaru</span>
                    <a href="/paket" class="btn btn-sm btn-secondary py-1 px-3">
                        <i class="fas fa-eye me-1"></i> Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive border-0 rounded-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Paket</th>
                                    <th>Harga/kg</th>
                                    <th>Estimasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($paket)): ?>
                                    <?php foreach (array_slice($paket, 0, 5) as $p): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= $p['nama_paket'] ?></td>
                                        <td class="fw-bold" style="color: var(--primary-color);">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                        <td><span class="badge" style="background: rgba(212,175,55,0.12); color: var(--secondary-color); border:1px solid rgba(212,175,55,0.14);"><i class="far fa-clock me-1"></i><?= $p['estimasi'] ?></span></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada paket layanan</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Terbaru -->
        <div class="col-lg-6 col-md-12">
            <div class="card glass-panel h-100">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-3">
                    <span class="fw-bold"><i class="fas fa-shopping-cart" style="color: var(--secondary-color); margin-right: .5rem;"></i> Order Masuk Terbaru</span>
                    <a href="/orders" class="btn btn-sm btn-secondary py-1 px-3">
                        <i class="fas fa-eye me-1"></i> Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive border-0 rounded-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach (array_slice($orders, 0, 5) as $o): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= $o['nama_pelanggan'] ?></td>
                                        <td><?= date('d M Y', strtotime($o['tanggal_masuk'])) ?></td>
                                        <td>
                                            <?php
                                                $badge_class = $o['status'] == 'Selesai' ? 'success' : 
                                                             ($o['status'] == 'Proses' ? 'warning' : 'danger');
                                            ?>
                                            <?php
                                                $badge_class = $o['status'] == 'Selesai' ? 'success' : 
                                                             ($o['status'] == 'Proses' ? 'warning' : 'danger');
                                            ?>
                                            <span class="badge bg-<?= $badge_class ?>">
                                                <?= $o['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Belum ada order masuk</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('orderChart').getContext('2d');
        
        function getThemeColor(variable) {
            return getComputedStyle(document.documentElement).getPropertyValue(variable).trim();
        }

        let primaryColor = getThemeColor('--primary-color') || '#00f5d4';
        let secondaryColor = getThemeColor('--secondary-color') || '#7209b7';
        let textColor = getThemeColor('--text-color') || '#f1f5f9';
        let mutedColor = getThemeColor('--muted-color') || '#94a3b8';

        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pemasukan (x10k Rp)',
                    data: [150, 220, 180, 290, 270, 380],
                    borderColor: primaryColor,
                    backgroundColor: 'rgba(0, 245, 212, 0.05)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }, {
                    label: 'Jumlah Order',
                    data: [35, 52, 45, 80, 68, 95],
                    borderColor: secondaryColor,
                    backgroundColor: 'rgba(114, 9, 183, 0.05)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            font: {
                                family: 'Plus Jakarta Sans',
                                size: 11
                            },
                            color: textColor
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(8, 12, 22, 0.95)',
                        borderColor: 'rgba(255, 255, 255, 0.08)',
                        borderWidth: 1,
                        titleColor: '#fff',
                        bodyColor: '#e2e8f0',
                        titleFont: { family: 'Plus Jakarta Sans', weight: 'bold' },
                        bodyFont: { family: 'Plus Jakarta Sans' }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { 
                            font: { family: 'Plus Jakarta Sans', size: 10 },
                            color: mutedColor 
                        }
                    },
                    y: {
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { 
                            font: { family: 'Plus Jakarta Sans', size: 10 },
                            color: mutedColor 
                        }
                    }
                }
            }
        });

        // Sync chart colors on theme change
        window.addEventListener('themechange', () => {
            const updatedPrimary = getThemeColor('--primary-color');
            const updatedSecondary = getThemeColor('--secondary-color');
            const updatedText = getThemeColor('--text-color');
            const updatedMuted = getThemeColor('--muted-color');
            
            chart.data.datasets[0].borderColor = updatedPrimary;
            chart.data.datasets[1].borderColor = updatedSecondary;
            chart.options.plugins.legend.labels.color = updatedText;
            chart.options.scales.x.ticks.color = updatedMuted;
            chart.options.scales.y.ticks.color = updatedMuted;
            chart.update();
        });
    });
</script>
