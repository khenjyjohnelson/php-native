<?php
require_once 'config/database.php';
require_once 'config/session.php';

// Define isLoggedIn function if not already defined
if (!function_exists('isLoggedIn')) {
    function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }
}

// Get user data if logged in
$user = getUserData();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Logistics Maritime</title>
    <link rel="stylesheet" href="/me/php-native/logistikmaritim/css/index.css" />
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">
                    <img src="/me/php-native/logistikmaritim/image/logo.png" alt="logo" />
                </div>
                <span>Logistik Maritime</span>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="/me/php-native/index.php">Beranda</a></li>
                    <li class="dropdown">
                        <a href="#tentang" class="dropdown-toggle">
                            Tentang Kami
                            <span class="dropdown-arrow">▼</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/me/php-native/logistikmaritim/html/tentang.php">Tentang Perusahaan</a></li>
                            <li><a href="/me/php-native/logistikmaritim/html/fasilitas.php">Fasilitas dan Pelayanan</a></li>
                            <li><a href="/me/php-native/logistikmaritim/html/jaminan.php">Jaminan Pelayanan</a></li>
                            <li><a href="/me/php-native/logistikmaritim/html/syarat.php">Syarat dan Ketentuan</a></li>
                            <li><a href="/me/php-native/logistikmaritim/html/informasi.html">Informasi Pengiriman</a></li>
                            <li><a href="/me/php-native/logistikmaritim/html/karir.php">Karir</a></li>
                            <li><a href="/me/php-native/logistikmaritim/html/tim.php">Tim</a></li>
                        </ul>
                    </li>
                    <li><a href="/me/php-native/logistikmaritim/html/informasi.html">Jadwal Pengiriman</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/kontak.html">Kontak Kami</a></li>
                </ul>
            </nav>

            <!-- Auth Buttons -->
            <div class="auth-buttons">
                <?php if (isLoggedIn()): ?>
                    <div class="user-menu">
                        <span>Welcome, <?php echo isset($user['name']) ? htmlspecialchars($user['name']) : 'User'; ?></span>
                        <a href="/me/php-native/dashboard.php" class="btn-dashboard">Dashboard</a>
                        <a href="/me/php-native/logout.php" class="btn-logout">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="/me/php-native/login.php" class="btn-login">Masuk</a>
                    <a href="/me/php-native/register.php" class="btn-signup">Daftar</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

    </header>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-container">
            <div class="hero-content">
                <h1>LOGISTICS MARITIME</h1>
                <p>Mewujudkan Kesuksesan Logistik Anda</p>
                <?php if (isLoggedIn()): ?>
                    <a href="/me/php-native/dashboard.php" class="cta-button">
                        Dashboard
                    </a>
                <?php else: ?>
                    <a href="/me/php-native/login.php" class="cta-button">
                        Login untuk Cek Pengiriman
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="content-container">
            <div class="content-item">
                <div class="content-image">
                    <img src="/me/php-native/logistikmaritim/image/2.png" alt="Port Container" />
                </div>
                <div class="content-text">
                    <h3>SEJARAH</h3>
                    <p>Dari pelabuhan kecil hingga kami menghubungkan seluruh wilayah Indonesia dengan layanan logistik yang handal dan terpercaya. Dengan pengalaman puluhan tahun dalam industri maritim, kami telah membangun jaringan yang luas dan berpengalaman. Kami memastikan setiap pengiriman berjalan lancar, tepat waktu, dan sesuai standar tertinggi. Mulai dari pemulihan di pelabuhan hingga barang tiba di tujuan, sistem manajemen logistik kami menjaga keakuratan, kecepatan, dan keamanan dalam setiap tahap pengiriman barang melalui jalur laut di seluruh Indonesia.</p>
                    <a href="/me/php-native/logistikmaritim/html/tentang.php" class="selengkapnya-btn">Selengkapnya →</a>
                </div>
            </div>

            <div class="content-item">
                <div class="content-image">
                    <img src="/me/php-native/logistikmaritim/image/3.png" alt="Logistics Service" />
                </div>
                <div class="content-text">
                    <h3>PELAYANAN</h3>
                    <p>Kami menawarkan pelayanan kapal logistik dengan sistem penyimpanan yang mudah dan fleksibel, didukung oleh teknologi terdepan untuk memastikan efisiensi maksimal. Pengiriman dilakukan dengan tepat waktu, menggunakan kapal yang dilengkapi teknologi dan fasilitas bongkar muat modern. Kami juga menyediakan jaminan klaim yang jelas serta respon cepat terhadap permintaan dan kendala, guna memastikan kelancaran operasional dan kepuasan pelanggan di seluruh wilayah Indonesia.</p>
                    <a href="/me/php-native/logistikmaritim/html/fasilitas.php" class="selengkapnya-btn">Selengkapnya →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Highlight Section -->
    <section class="highlight-section">
        <div class="highlight-container">
            <h2 class="highlight-title">HIGHLIGHT</h2>
            <div class="highlight-grid">
                <div class="highlight-card">
                    <img src="/me/php-native/logistikmaritim/image/4.png" alt="Visi Misi" />
                    <h4>Visi & Misi</h4>
                    <p>Menjadi leader logistik maritim terpercaya dengan visi untuk menghubungkan seluruh Indonesia melalui layanan pelayanan.</p>
                    <a href="/me/php-native/logistikmaritim/html/tentang.php" class="selengkapnya-btn1a">Selengkapnya →</a>
                </div>
                <div class="highlight-card">
                    <img src="/me/php-native/logistikmaritim/image/5.png" alt="Karir" />
                    <h4>Karir</h4>
                    <p>Bergabung dengan tim profesional kami di bidang logistik maritim. Kami menyediakan kesempatan karir yang menarik dengan lingkungan kerja yang dinamis dan pengembangan profesional.</p>
                    <a href="/me/php-native/logistikmaritim/html/karir.php" class="selengkapnya-btn1b">Selengkapnya →</a>
                </div>
                <div class="highlight-card">
                    <img src="/me/php-native/logistikmaritim/image/6.png" alt="Syarat Ketentuan" />
                    <h4>Syarat & Ketentuan</h4>
                    <p>Ketahui syarat dan ketentuan layanan logistik maritim kami untuk memastikan kelancaran dan keamanan dalam setiap transaksi pengiriman barang melalui jalur laut.</p>
                    <a href="/me/php-native/logistikmaritim/html/syarat.php" class="selengkapnya-btn1c">Selengkapnya →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <div class="partners-container">
            <h2 class="partners-title">MITRA</h2>
            <p class="partners-subtitle">Kerja sama yang telah kami lakukan</p>
            <div class="partners-grid">
                <div class="partner-logo">
                    <a href="https://www.asus.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/asus.png" alt="ASUS" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.shopee.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/shoope.png" alt="Shopee" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.komatsu.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/komatsu.png" alt="Komatsu" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.adidas.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/adidas.png" alt="Adidas" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.tokopedia.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/tokopedia.png" alt="Tokopedia" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.bukalapak.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/bukalapak.png" alt="Bukalapak" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.advan.id/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/advan.png" alt="Advan" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.iphone.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/iphone.png" alt="iPhone" />
                    </a>
                </div>
                <div class="partner-logo">
                    <a href="https://www.yamaha.com/" target="_blank">
                        <img src="/me/php-native/logistikmaritim/image/yamaha.png" alt="Yamaha" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo">
                    <div class="footer-logo-icon">
                        <img src="/me/php-native/logistikmaritim/image/logo.png" alt="logo" />
                    </div>
                    <div>
                        <h3>Logistics Maritime</h3>
                        <p>Mengirim barang dengan efisien, tepat, dan profesional</p>
                    </div>
                </div>
            </div>

            <div class="footer-section">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="/me/php-native/index.php">Beranda</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/tentang.php">Tentang Perusahaan</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/fasilitas.php">Fasilitas dan Pelayanan</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/jaminan.php">Jaminan Pelayanan</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/syarat.php">Syarat dan Ketentuan</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/informasi.html">Informasi Pengiriman</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/karir.php">Karir</a></li>
                    <li><a href="/me/php-native/logistikmaritim/html/tim.php">Tim</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Kontak Kami</h4>
                <p><strong>Kantor Pusat</strong><br>
                    Jalan Pelabuhan Gang Pantai Indah No 72</p>

                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <img src="/me/php-native/logistikmaritim/image/wa.png" alt="WhatsApp">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="/me/php-native/logistikmaritim/image/ig.png" alt="Instagram">
                    </a>
                    <a href="#" class="social-icon">
                        <img src="/me/php-native/logistikmaritim/image/fb.png" alt="Facebook">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Logistics Maritime. All rights reserved.</p>
        </div>
    </footer>

    <script src="/me/php-native/logistikmaritim/js/script.js"></script>
</body>

</html>