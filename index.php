<?php
    require "header.php";
?>

<main>
<link rel="icon" type="image/png" href="img/home.png">
    <div class="hero-banner">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="moon-star-icon">
                <i class="fas fa-star"></i>
                <i class="fas fa-moon"></i>
            </div>
            <h1>Aplikasi Zakat Fitrah</h1>
            <p>Menyalurkan keberkahan, mempermudah ibadah</p>
            <div class="cta-buttons">
                <a href="<?php echo $path;?>/pages/bayar-zakat.php" class="btn btn-primary">
                    <i class="fas fa-hand-holding-usd"></i> Bayar Zakat
                </a>
                <a href="<?php echo $path;?>/pages/distribusi-zakat-warga.php" class="btn btn-secondary">
                    <i class="fas fa-chart-pie"></i> Lihat Distribusi
                </a>
            </div>
        </div>
    </div>

    <div class="wrapper-main">
        <div class="islamic-separator">
            <div class="separator-line"></div>
            <div class="separator-icon"><i class="fas fa-mosque"></i></div>
            <div class="separator-line"></div>
        </div>
        
        <h1 class="main-title">Selamat Datang di ZakatKu</h1>
        
        <section class="status-section">
            <?php
                if (isset($_SESSION['userId'])) {
                    echo '<div class="status-card success-card">
                            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="status-content">
                                <h3>Login Berhasil</h3>
                                <p>Anda telah berhasil masuk! Silakan gunakan layanan zakat fitrah.</p>
                            </div>
                          </div>';
                }
                elseif (isset($_GET["error"])) {
                    if ($_GET["error"] == "notLogin") {
                        echo '<div class="status-card error-card">
                                <div class="status-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <div class="status-content">
                                    <h3>Akses Ditolak</h3>
                                    <p>Anda belum masuk ke akun. Silakan login terlebih dahulu.</p>
                                </div>
                              </div>';
                    }
                    elseif ($_GET["error"] == "emptyFields") {
                        echo '<div class="status-card error-card">
                                <div class="status-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <div class="status-content">
                                    <h3>Form Kosong</h3>
                                    <p>Mohon isi formulir login.</p>
                                </div>
                              </div>';
                    }
                    elseif ($_GET["error"] == "wrongPwd") {
                        echo '<div class="status-card error-card">
                                <div class="status-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <div class="status-content">
                                    <h3>Password Salah</h3>
                                    <p>Password yang Anda masukkan salah.</p>
                                </div>
                              </div>';
                    }
                    elseif ($_GET["error"] == "noUser") {
                        echo '<div class="status-card error-card">
                                <div class="status-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                <div class="status-content">
                                    <h3>Pengguna Tidak Ditemukan</h3>
                                    <p>Pengguna tidak ditemukan dalam database kami.</p>
                                </div>
                              </div>';
                    }
                }
                else {
                    echo '<div class="status-card info-card">
                            <div class="status-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="status-content">
                                <h3>Informasi</h3>
                                <p>Silakan daftar dan masuk untuk menggunakan aplikasi.</p>
                            </div>
                          </div>';
                }
            ?>
        </section>
        
        <!-- Zakat Description -->
        <section class="zakat-description">
            <div class="description-image">
                <img src="<?php echo $path;?>/img/zakat-illustration.jpg" alt="Zakat Illustration" onerror="this.src='https://via.placeholder.com/400x300?text=Zakat+Fitrah'">
            </div>
            <div class="description-content">
                <h2>Apa itu Zakat Fitrah?</h2>
                <p>Zakat Fitrah adalah zakat yang wajib dikeluarkan oleh setiap muslim di akhir bulan Ramadhan. Besarannya sekitar 2,5 kg beras atau setara dengan nilai uangnya, yang disalurkan kepada yang berhak menerimanya.</p>
                <div class="zakat-quote">
                    <i class="fas fa-quote-left"></i>
                    <p>"Telah diwajibkan zakat fitrah untuk membersihkan orang yang berpuasa dari perbuatan sia-sia dan perkataan kotor, serta untuk memberi makan orang-orang miskin."</p>
                    <span>- HR. Abu Dawud</span>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section class="features-section">
            <h2 class="section-title"><i class="fas fa-th-large"></i> Fitur Utama</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Muzakki</h3>
                    <p>Kelola data pembayar zakat dengan mudah dan terstruktur.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Pendataan lengkap</li>
                        <li><i class="fas fa-check"></i> Histori pembayaran</li>
                        <li><i class="fas fa-check"></i> Laporan terpadu</li>
                    </ul>
                    <a href="<?php echo $path;?>/pages/muzakki.php" class="feature-link">
                        Kelola Muzakki <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3>Mustahik</h3>
                    <p>Daftar penerima zakat yang membutuhkan bantuan.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Verifikasi penerima</li>
                        <li><i class="fas fa-check"></i> Kategorisasi asnaf</li>
                        <li><i class="fas fa-check"></i> Prioritas distribusi</li>
                    </ul>
                    <a href="<?php echo $path;?>/pages/mustahik.php" class="feature-link">
                        Kelola Mustahik <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3>Bayar Zakat</h3>
                    <p>Proses pembayaran zakat fitrah dengan mudah dan terstruktur.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Pembayaran aman</li>
                        <li><i class="fas fa-check"></i> Bukti elektronik</li>
                        <li><i class="fas fa-check"></i> Perhitungan otomatis</li>
                    </ul>
                    <a href="<?php echo $path;?>/pages/bayar-zakat.php" class="feature-link">
                        Bayar Sekarang <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Zakat Timeline -->
        <section class="zakat-timeline">
            <h2 class="section-title"><i class="fas fa-clock"></i> Proses Zakat Fitrah</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h3>Pendaftaran</h3>
                        <p>Daftarkan diri sebagai muzakki untuk memulai proses pembayaran zakat.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h3>Perhitungan</h3>
                        <p>Tentukan jumlah zakat yang akan dibayarkan berdasarkan ketentuan syariah.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h3>Pembayaran</h3>
                        <p>Lakukan pembayaran zakat melalui sistem yang aman dan terpercaya.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <h3>Distribusi</h3>
                        <p>Zakat anda akan didistribusikan kepada mustahik yang membutuhkan.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-content">
                <h2>Mulai Bayar Zakat Anda Sekarang</h2>
                <p>Satu langkah kecil untuk membantu sesama dan menjalankan kewajiban sebagai seorang muslim.</p>
            </div>
            <div class="cta-buttons">
                <a href="<?php echo $path;?>/pages/bayar-zakat.php" class="btn btn-primary">
                    <i class="fas fa-hand-holding-usd"></i> Bayar Zakat
                </a>
                <a href="<?php echo $path;?>/pages/signup.php" class="btn btn-outline">
                    <i class="fas fa-user-plus"></i> Daftar Akun
                </a>
            </div>
        </section>
    </div>
</main>

<?php
    require "footer.php";
?>