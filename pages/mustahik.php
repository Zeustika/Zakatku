<?php
require "../header.php";
require "../includes/dbh.inc.php";
$path = "http://localhost/zakatfitrah";

if (!isset($_SESSION['userId'])) {
    header("Location: {$path}/index.php?error=notLogin");
    exit();
}

$no = 1;
$query = mysqli_query($conn,"select * from kategori_mustahik");
?>
    <link rel="stylesheet" type="text/css" href="<?php echo $path;?>/styles/text.css">
<main>
    <div class="wrapper-main">
        <h1 class="main-title">Aplikasi Zakat Fitrah</h1>
        <section class="section-default">
            <h3 class="page-label">Add Mustahik</h3>
            <form class="auth-form" action="../includes/mustahik/add-mustahik.inc.php" method="post">
                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-users"></i>
                        <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-with-icon">
                        <i class="fas fa-balance-scale"></i>
                        <input type="number" name="jml_hak" placeholder="Jumlah Hak" class="form-input">
                    </div>
                </div>
                <button type="submit" name="mustahik-submit" title="Submit data" class="report-button">Submit</button>
            </form>

            <?php
                if(isset($_GET["addMustahik"])) {
                    echo '<div class="status-card success-card">
                            <div class="status-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="status-content">
                                <h3>Sukses</h3>
                                <p>Data baru ditambahkan</p>
                            </div>
                          </div>';
                }
                elseif (isset($_GET['editMustahik'])) {
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

            <h3 class="page-label">Detail Mustahik</h3>
            <div class="box-table">
                <table id="table-data" class="display">
                    <thead>
                        <tr>
                            <th class="table-small-width">No</th>
                            <th class="table-wide-width">Nama</th>
                            <th class="table-small-width">Jumlah Hak</th>
                            <th class="table-small-width">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($data = mysqli_fetch_array($query)) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td class="text-left"><?php echo $data['nama_kategori']; ?></td>
                                <td class="text-left"><?php echo $data['jumlah_hak']; ?> Kg</td>
                                <td>
                                    <a href="../includes/edit.inc.php?idMustahik=<?php echo $data['id_kategori']; ?>" class="table-button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" onclick="confirmAction('../includes/mustahik/delete-mustahik.inc.php?id=<?php echo $data['id_kategori']; ?>')" class="table-button">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

<script src="../scripts/datatable.js"></script>
<script src="../scripts/confirm-action.js"></script>

<?php
require "../footer.php";
?>  