<?php
require "../header.php";
require "../includes/dbh.inc.php";
$path = "http://localhost/zakatfitrah";

if (!isset($_SESSION['userId'])) {
    header("Location: {$path}/index.php?error=notLogin");
    exit();
}
$no = 1;
$query_bayar_zakat = mysqli_query($conn,"select * from mustahik_lainnya");
$query_report = mysqli_query(
    $conn,
    "SELECT 
                    COUNT(nama) AS 'total-mustahik-lainnya',
                    SUM(hak) AS 'total-beras'
                FROM mustahik_lainnya"
);
$query_mustahik = mysqli_query(
    $conn,
    "select 
                    * 
                from kategori_mustahik 
                where nama_kategori in ('Ibnu Sabil', 'Muallaf', 'Fisabilillah')"
);
?>
    <link rel="stylesheet" type="text/css" href="<?php echo $path;?>/styles/text.css">
<main>
    <div class="wrapper-main">
        <h1 class="main-title">Aplikasi Zakat Fitrah</h1>
        <section class="section-default">
            <h3 class="page-label">Warga Lainnya yang sudah Menerima zakat</h3>

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
                    <a href="../includes/distribusi-zakat-lainnya/add-distribusi-zakat-lainnya/add-distribusi-zakat-lainnya-form.php" class="report-button">
                        <i class="fas fa-plus-square"></i>
                        Tambahkan
                    </a>
                </div>

                <div class="button-distribute">
                    <div class="distributes-pages">
                        <a href="./distribusi-zakat-warga.php" class="report-button">Distribusi Warga</a>
                    </div>
                    <div class="distributes-pages button-current">
                        <a href="javascript:void(0)" class="report-button">Distribusi Warga Lainnya</a>
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
                                <a href="../includes/edit.inc.php?idLainnya=<?php echo $data['id_mustahiklainnya'];?>" class="table-button">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" onclick="confirmAction('../includes/distribusi-zakat-lainnya/delete-distribusi-zakat-lainnya.inc.php?id=<?php echo $data['id_mustahiklainnya']; ?>')" class="table-button">
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
                            <li><i class="fas fa-angle-right"></i> <?php echo $data['nama_kategori']; ?></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                
                <?php $data_report = mysqli_fetch_array($query_report) ?>
                <div class="report-inner-box report-distribusi-summary">
                    <div class="report-item">
                        <div class="report-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="report-content">
                            <h4>Total Mustahik Lainnya</h4>
                            <p><?php echo $data_report['total-mustahik-lainnya']; ?> Orang</p>
                        </div>
                    </div>

                    <div class="report-item">
                        <div class="report-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="report-content">
                            <h4>Total Beras yang Didistribusikan</h4>
                            <p><?php echo $data_report['total-beras']; ?> Kg</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
    function confirmAction(url) {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = url;
        }
    }

    $(document).ready(function() {
        $('#table-data').DataTable({
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>

<?php
    require "../footer.php";
?>