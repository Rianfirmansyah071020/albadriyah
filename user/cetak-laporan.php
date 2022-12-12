<?php require 'config/auth.php'; ?>

<?php $title = 'Cetak Laporan';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_pembayaran = select("SELECT * FROM pembayaran");
$data_pemesanan  = mysqli_query($kon, "SELECT * FROM pemesanan");
$data_pesan = mysqli_fetch_array($data_pemesanan);
$noreg = $_SESSION['no_registrasi'];
$idpemb = isset($_GET['idpemb']) ? $_GET['idpemb'] : '';
$link = file_get_contents('http://localhost/badriyahwisata/user/kwitansi?id_pembayaran=' . $idpemb, true);

?>

<?php include 'layout/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Cetak Laporan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Cetak Laporan Albadriyah Wisata</li>
            </ol>
            <div class="row">
                <div class="card mb-4"><br />
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Silahkan Pilih No. Pemesanan Untuk Cetak Laporan Pemesanan
                    </div>
                    <div class="card-body">
                        <form action="kwitansi" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="no_pemesanan" class="col-sm-2 col-form-label">No. Pemesanan</label>
                                <div class="col-sm-10">
                                    <select name="no_pemesanan" id="no_pemesanan" class="form-control" onchange='changeValue(this.value)' required>
                                        <option value="">Pilih</option>
                                        <?php
                                        $result = mysqli_query($kon, "select * from pemesanan where no_registrasi = '$noreg'");
                                        $jsArray = "var prdName = new Array();\n";
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_pemesanan'] . '">' . $row['no_pemesanan'] . '</option>';
                                            $jsArray .= "prdName['" . $row['id_pemesanan'] . "'] = {kode:'" . addslashes($row['id_pemesanan']) . "',kode2:'" . addslashes($row['no_pemesanan']) . "',harganya:'" . addslashes($row['harga']) . "',sudah_bayar:'" . addslashes($row['telah_bayar']) . "'};\n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-primary">Cetak Kuitansi</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card mb-4"><br />
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Silahkan Pilih No. Pembayaran Untuk Cetak Kuitansi Pembayaran
                    </div>
                    <div class="card-body">
                        <form action="kwitansi" method="POST">

                            <div class="row mb-3">
                                <label for="no_pemesanan" class="col-sm-2 col-form-label">No. Pemesanan</label>
                                <div class="col-sm-10">
                                    <select name="no_pemesanan" id="no_pemesanan" class="form-control" onchange='changeValue(this.value)' required>
                                        <option value="">Pilih</option>
                                        <?php
                                        $result = mysqli_query($kon, "select * from pembayaran where no_registrasi = '$noreg'");
                                        $jsArray = "var prdName = new Array();\n";
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_pembayaran'] . '">' . $row['no_pembayaran'] . '</option>';
                                            $jsArray .= "prdName['" . $row['id_pembayaran'] . "'] = {idppemb:'" . addslashes($row['id_pembayaran']) . "'};\n";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="text" name="idppemb" id="idppemb" class="form-control">

                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-primary">Tambah Admin</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>


        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Albadriyah Wisata 2022</div>
            </div>
        </div>
    </footer>
</div>
</div>

<?php include 'layout/footer.php'; ?>

<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(id) {
        document.getElementById('idppemb').value = prdName[id].idppemb;
    };
</script>