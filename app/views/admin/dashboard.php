<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <?php include APP_PATH . '/views/layouts/favicon.php'; ?>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/admin-dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php
    $user = Session::getUser();
    ?>

    <div class="admin-container">
        <?php include APP_PATH . '/views/layouts/admin_sidebar.php'; ?>

        <div class="main-content">
            <div class="topbar">
                <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                <div class="topbar-right">
                    <span class="date-display"><i class="fas fa-calendar"></i> <?= date('d/m/Y') ?></span>
                    <div class="user-info">
                        <i class="fas fa-user-circle"></i>
                        <div>
                            <strong><?= htmlspecialchars($user['full_name']) ?></strong>
                            <span style="display: block; font-size: 12px; color: #666; margin-top: 2px;">
                                <?php 
                                if ($user['role'] === 'superadmin') {
                                    echo '👑 Super Administrator';
                                } else {
                                    echo '👤 Administrator';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <!-- Alerts / Warnings Section -->
                <?php if (!empty($alerts)): ?>
                <div class="alerts-section">
                    <?php foreach ($alerts as $alert): ?>
                        <a href="<?= $alert['link'] ?>" class="alert-item alert-<?= $alert['type'] ?>">
                            <i class="<?= $alert['icon'] ?>"></i>
                            <span><?= $alert['message'] ?></span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- KPI Cards with Comparison -->
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-icon blue"><i class="fas fa-dollar-sign"></i></div>
                        <div class="kpi-content">
                            <span class="kpi-label">Doanh thu tháng</span>
                            <span class="kpi-value"><?= number_format($comparison['this_month_revenue']) ?>đ</span>
                            <span class="kpi-change <?= $comparison['revenue_change'] >= 0 ? 'positive' : 'negative' ?>">
                                <i class="fas fa-<?= $comparison['revenue_change'] >= 0 ? 'arrow-up' : 'arrow-down' ?>"></i>
                                <?= abs($comparison['revenue_change']) ?>% vs tháng trước
                            </span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon green"><i class="fas fa-shopping-cart"></i></div>
                        <div class="kpi-content">
                            <span class="kpi-label">Đơn hàng tháng</span>
                            <span class="kpi-value"><?= number_format($comparison['this_month_orders']) ?></span>
                            <span class="kpi-change <?= $comparison['orders_change'] >= 0 ? 'positive' : 'negative' ?>">
                                <i class="fas fa-<?= $comparison['orders_change'] >= 0 ? 'arrow-up' : 'arrow-down' ?>"></i>
                                <?= abs($comparison['orders_change']) ?>% vs tháng trước
                            </span>
                        </div>
                    </div>

                    <div class="kpi-card highlight">
                        <div class="kpi-icon orange"><i class="fas fa-clock"></i></div>
                        <div class="kpi-content">
                            <span class="kpi-label">Hôm nay</span>
                            <span class="kpi-value"><?= number_format($comparison['today_revenue']) ?>đ</span>
                            <span class="kpi-sub"><?= $comparison['today_orders'] ?> đơn hàng mới</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon purple"><i class="fas fa-users"></i></div>
                        <div class="kpi-content">
                            <span class="kpi-label">Tổng khách hàng</span>
                            <span class="kpi-value"><?= number_format($stats['total_users']) ?></span>
                            <span class="kpi-sub"><?= number_format($stats['total_products']) ?> sản phẩm</span>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="dashboard-row">
                    <!-- Left: Mini Chart -->
                    <div class="dashboard-col">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-chart-area"></i> Doanh thu 7 ngày</h3>
                                <a href="<?= BASE_URL ?>/admin/revenue" class="btn-link">Xem chi tiết →</a>
                            </div>
                            <div class="card-body">
                                <div class="mini-chart-container">
                                    <canvas id="weeklyChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Status -->
                    <div class="dashboard-col">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-list-check"></i> Trạng thái đơn hàng</h3>
                                <a href="<?= BASE_URL ?>/admin/orders" class="btn-link">Xem tất cả →</a>
                            </div>
                            <div class="card-body">
                                <div class="order-status-compact">
                                    <a href="<?= BASE_URL ?>/admin/orders?status=pending" class="status-item pending">
                                        <span class="status-count"><?= $orderStats['pending'] ?></span>
                                        <span class="status-label">Chờ xử lý</span>
                                    </a>
                                    <a href="<?= BASE_URL ?>/admin/orders?status=processing" class="status-item processing">
                                        <span class="status-count"><?= $orderStats['processing'] ?></span>
                                        <span class="status-label">Đang xử lý</span>
                                    </a>
                                    <a href="<?= BASE_URL ?>/admin/orders?status=shipping" class="status-item shipping">
                                        <span class="status-count"><?= $orderStats['shipping'] ?></span>
                                        <span class="status-label">Đang giao</span>
                                    </a>
                                    <a href="<?= BASE_URL ?>/admin/orders?status=delivered" class="status-item delivered">
                                        <span class="status-count"><?= $orderStats['delivered'] ?></span>
                                        <span class="status-label">Hoàn thành</span>
                                    </a>
                                    <a href="<?= BASE_URL ?>/admin/orders?status=cancelled" class="status-item cancelled">
                                        <span class="status-count"><?= $orderStats['cancelled'] ?></span>
                                        <span class="status-label">Đã hủy</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Products Compact -->
                <?php if (!empty($topProducts)): ?>
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-fire"></i> Top sản phẩm bán chạy</h3>
                        <a href="<?= BASE_URL ?>/admin/revenue" class="btn-link">Xem thêm →</a>
                    </div>
                    <div class="card-body">
                        <div class="top-products-compact">
                            <?php foreach ($topProducts as $index => $product): ?>
                                <div class="product-item-compact">
                                    <span class="rank rank-<?= $index + 1 ?>">#<?= $index + 1 ?></span>
                                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars($product['image']) ?>" 
                                         alt="<?= htmlspecialchars($product['name']) ?>"
                                         onerror="this.src='<?= BASE_URL ?>/assets/images/no-image.png'">
                                    <div class="product-info">
                                        <span class="product-name"><?= htmlspecialchars($product['name']) ?></span>
                                        <span class="product-sold">Đã bán: <?= number_format($product['total_sold']) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Quick Stats -->
                <div class="quick-stats">
                    <a href="<?= BASE_URL ?>/admin/users?role=user" class="quick-stat-item">
                        <i class="fas fa-users"></i>
                        <span class="stat-number"><?= number_format($stats['total_users']) ?></span>
                        <span class="stat-text">Khách hàng</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/products" class="quick-stat-item">
                        <i class="fas fa-box"></i>
                        <span class="stat-number"><?= number_format($stats['total_products']) ?></span>
                        <span class="stat-text">Sản phẩm</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/orders" class="quick-stat-item">
                        <i class="fas fa-receipt"></i>
                        <span class="stat-number"><?= number_format($stats['total_orders']) ?></span>
                        <span class="stat-text">Đơn hàng</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/suppliers" class="quick-stat-item">
                        <i class="fas fa-truck"></i>
                        <span class="stat-number"><?= number_format($stats['total_suppliers']) ?></span>
                        <span class="stat-text">Nhà cung cấp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mini Weekly Chart
        const weeklyData = <?= json_encode($weeklyRevenue ?? []) ?>;
        
        if (weeklyData.length > 0) {
            const ctx = document.getElementById('weeklyChart').getContext('2d');
            
            const labels = weeklyData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('vi-VN', { weekday: 'short', day: 'numeric' });
            });
            
            const revenues = weeklyData.map(item => parseFloat(item.revenue || 0));
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        data: revenues,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return new Intl.NumberFormat('vi-VN').format(context.parsed.y) + 'đ';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11 } }
                        },
                        y: {
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: {
                                font: { size: 11 },
                                callback: function(value) {
                                    if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
                                    if (value >= 1000) return (value / 1000).toFixed(0) + 'K';
                                    return value;
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
    <?php include APP_PATH . '/views/layouts/toast_notification.php'; ?>
</body>
</html>