<?php
require "../header.php";
require "../includes/dbh.inc.php";
$path = "http://localhost/zakatfitrah";

if (!isset($_SESSION['userId'])) {
    header("Location: {$path}/index.php?error=notLogin");
    exit();
}

$no = 1;
$query_bayar_zakat = mysqli_query($conn,"select * from bayarzakat");
$query_report = mysqli_query(
        $conn,
        "SELECT 
                    COUNT(nama_muzakki) AS 'Total Muzakki',
                    SUM(jumlah_tanggunganyangdibayar) AS 'Total Jiwa',
                    SUM(bayar_beras) AS 'Total Beras',
                    SUM(bayar_uang) AS 'Total Uang'
                FROM bayarzakat"
)
?>
    <link rel="stylesheet" type="text/css" href="<?php echo $path;?>/styles/text.css">
<main>
    <div class="wrapper-main">
        <h1 class="main-title">Aplikasi Zakat Fitrah</h1>
        <section class="section-default">
            <h3 class="page-label">Warga yang sudah bayar zakat</h3>

            <?php
                if(isset($_GET["addBayarZakat"])) {
                    echo '<div class="status-card success-card">
                            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="status-content">
                                <h3>Sukses</h3>
                                <p>Data baru ditambahkan</p>
                            </div>
                          </div>';
                }
                elseif (isset($_GET['editZakat'])) {
                    echo '<div class="status-card success-card">
                            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="status-content">
                                <h3>Sukses</h3>
                                <p>Data telah diubah</p>
                            </div>
                          </div>';
                }
                elseif (isset($_GET['deleteMuzakki'])) {
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
                    <a href="../includes/bayar-zakat/add-bayar-zakat/add-bayar-zakat.php" class="report-button">
                        <i class="fas fa-plus-square"></i>
                        Tambahkan
                    </a>
                </div>
            </div>

            <div class="box-table">
                <table id="table-data" class="display">
                    <thead>
                    <tr>
                        <th class="table-small-width">No</th>
                        <th class="table-wide-width">Nama</th>
                        <th class="table-small-width">Tanggungan</th>
                        <th class="table-small-width">Jenis</th>
                        <th class="table-small-width">Pembayaran</th>
                        <th class="table-small-width">Beras</th>
                        <th class="table-small-width">Uang</th>
                        <th class="table-small-width">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($data = mysqli_fetch_array($query_bayar_zakat)) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="text-left"><?php echo $data['nama_muzakki']; ?></td>
                            <td><?php echo $data['jumlah_tanggungan']; ?> orang</td>
                            <td class="text-left"><?php echo $data['jenis_bayar']; ?></td>
                            <td class="text-left"><?php echo $data['jumlah_tanggunganyangdibayar']; ?> orang</td>
                            <td class="text-left"><?php echo $data['bayar_beras']; ?> Kg</td>
                            <td class="text-left">Rp. <?php echo $data['bayar_uang']; ?></td>
                            <td>
                                <a href="../includes/edit.inc.php?idBayar=<?php echo $data['id_zakat'];?>" class="table-button">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmAction('../includes/bayar-zakat/delete-bayar-zakat.inc.php?id=<?php echo $data['id_zakat']; ?>&nama=<?php echo $data['nama_muzakki']; ?>')" class="table-button">
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
            <h3 class="page-label">Rekap Data Warga yang telah bayar zakat</h3>
            
            <div class="islamic-separator">
                <div class="separator-line"></div>
                <div class="separator-icon">☪</div>
                <div class="separator-line"></div>
            </div>

            <div class="report-box report-bayar">
                <?php while($data = mysqli_fetch_array($query_report)) : ?>
                    <div class="report-inner-box">
                        <p><i class="fas fa-users"></i> Total Muzakki: <?php echo $data["Total Muzakki"]?> Perwakilan</p>
                    </div>
                    <div class="report-inner-box">
                        <p><i class="fas fa-user-friends"></i> Total Jiwa: <?php echo $data["Total Jiwa"]?> Jiwa</p>
                    </div>
                    <div class="report-inner-box">
                        <p><i class="fas fa-seedling"></i> Total Beras: <?php echo $data["Total Beras"]?> Kg</p>
                    </div>
                    <div class="report-inner-box">
                        <p><i class="fas fa-money-bill-wave"></i> Total Uang: Rp.<?php echo $data["Total Uang"]?></p>
                    </div>
                <?php endwhile; ?>
                <a href="#" onclick="confirmAction('../includes/report/report-bayar-zakat.php')" class="report-button">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            </div>
        </section>
    </div>
</main>

<script src="../scripts/datatable.js"></script>
<script src="../scripts/confirm-action.js"></script>

<?php
require "../footer.php";
?>