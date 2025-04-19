<?php
require "../header.php";
require "../includes/dbh.inc.php";
$path = "http://localhost/zakatfitrah";

if (!isset($_SESSION['userId'])) {
    header("Location: {$path}/index.php?error=notLogin");
    exit();
}
$no = 1;
$query_bayar_zakat = mysqli_query($conn,"select * from mustahik_warga");
$query_report = mysqli_query(
    $conn,
    "SELECT 
                    COUNT(nama) AS 'total-mustahik-warga',
                    SUM(hak) AS 'total-beras'
                FROM mustahik_warga"
);
$query_mustahik = mysqli_query(
        $conn,
        "select 
                    * 
                from kategori_mustahik 
                where nama_kategori in ('Miskin', 'Fakir', 'Mampu', 'Amil')"
);
?>
    <link rel="stylesheet" type="text/css" href="<?php echo $path;?>/styles/text.css">
<main>
    <div class="wrapper-main">
        <h1 class="main-title">Aplikasi Zakat Fitrah</h1>
        <section class="section-default">
            <h3 class="page-label">Warga yang sudah Menerima zakat</h3>

            <?php
                if(isset($_GET["addDistribusiZakat"])) {
                    echo '<div class="status-card success-card">
                            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="status-content">
                                <h3>Sukses</h3>
                                <p>Data baru ditambahkan</p>
                            </div>
                          </div>';
                }
                elseif (isset($_GET['editDistribusiZakat'])) {
                    echo '<div class="status-card success-card">
                            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="status-content">
                                <h3>Sukses</h3>
                                <p>Data telah diubah</p>
                            </div>
                          </div>';
                }
                elseif (isset($_GET['deleteMustahik'])) {
                    echo '<div class="status-card error-card">
                            <div class="status-icon"><i class="fas fa-times-circle"></i></div>
                            <div class="status-content">
                                <h3>Dihapus</h3>
                                <p>Data telah dihapus</p>
                            </div>
                          </div>';
                }
            ?>

            <div class="button-box">
                <div class="add-button">
                    <a href="../includes/distribusi-zakat-warga/add-distribusi-zakat-warga/add-distribusi-zakat-warga.php" class="report-button">
                        <i class="fas fa-plus-square"></i>
                        Tambahkan
                    </a>
                </div>

                <div class="button-distribute">
                    <div class="distributes-pages button-current">
                        <a href="javascript:void(0)" class="report-button">Distribusi Warga</a>
                    </div>
                    <div class="distributes-pages">
                        <a href="./distribusi-zakat-lainnya.php" class="report-button">Distribusi Warga Lainnya</a>
                    </div>
                </div>
            </div>

            <div class="box-table">
                <table id="table-data" class="display">
                    <thead>
                    <tr>
                        <th class="table-small-width">No</th>
                        <th class="table-wide-width">Nama</th>
                        <th class="table-small-width">Kategori</th>
                        <th class="table-small-width">Hak</th>
                        <th class="table-small-width">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($data = mysqli_fetch_array($query_bayar_zakat)) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="text-left"><?php echo $data['nama']; ?></td>
                            <td class="text-left"><?php echo $data['kategori']; ?></td>
                            <td class="text-left"><?php echo $data['hak']; ?> Kg</td>
                            <td>
                                <a href="../includes/edit.inc.php?idDistribusi=<?php echo $data['id_mustahikwarga'];?>" class="table-button">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmAction('../includes/distribusi-zakat-warga/delete-distribusi-zakat-warga.inc.php?id=<?php echo $data['id_mustahikwarga']; ?>&nama=<?php echo $data['nama']?>')" class="table-button">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="section-default">
            <h3 class="page-label">Rekap Data Warga yang telah mendapatkan zakat</h3>
            
            <div class="islamic-separator">
                <div class="separator-line"></div>
                <div class="separator-icon">☪</div>
                <div class="separator-line"></div>
            </div>
            
            <div class="report-box report-box-distribution">
                <div class="report-inner-box report-distribusi-category">
                    <p class="report-distribusi-category-label"><i class="fas fa-list-ul"></i> Kategori Mustahik:</p>
                    <ul class="footer-links">
                        <?php while($data = mysqli_fetch_array($query_mustahik)) : ?>
                            <li><i class="fas fa-angle-right"></i> Kategori <?php echo $data['nama_kategori']?> mempunyai hak <?php echo $data['jumlah_hak']?> Kg beras</li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="report-distribusi-mustahik">
                    <?php while($data = mysqli_fetch_array($query_report)) : ?>
                        <div class="report-inner-box">
                            <p><i class="fas fa-users"></i> Total Mustahik Warga: <?php echo $data["total-mustahik-warga"]?> Orang</p>
                        </div>
                        <div class="report-inner-box">
                            <p><i class="fas fa-seedling"></i> Total Beras: <?php echo $data["total-beras"]?> Kg</p>
                        </div>
                    <?php endwhile; ?>
                    <div class="report-distribusi-button">
                        <a href="#" onclick="confirmAction('../includes/report/report-distribusi-zakat.php')" class="report-button">
                            <i class="fas fa-print"></i> Cetak Laporan
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="../scripts/datatable.js"></script>
<script src="../scripts/confirm-action.js"></script>

<?php
require "../footer.php";
?>