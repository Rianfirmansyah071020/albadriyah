<?php require 'config/auth.php'; ?>

<?php $title = 'Pembayaran';  ?>

<?php include 'layout/header.php'; ?>

<?php
// Ambil id paket dari url
$id_pembayaran = (int)$_GET['id_pembayaran'];

$data_pemesanan  = mysqli_query($kon, "SELECT * FROM pemesanan");
$data_pesan = mysqli_fetch_array($data_pemesanan);

$data_pembayaran = "SELECT * FROM pembayaran
                    INNER JOIN pemesanan ON pembayaran.id_pemesanan = pemesanan.id_pemesanan
                    INNER JOIN pendaftaran ON pembayaran.id_pend = pendaftaran.id_pend
                    INNER JOIN paket ON pembayaran.id_paket = paket.id_paket
                    WHERE id_pembayaran = $id_pembayaran
                    ";
$sql_rm = mysqli_query($kon, $data_pembayaran) or die(mysqli_error($kon));
$pembayaran = mysqli_fetch_array($sql_rm);
?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (update_pembayaran($_POST) > 0) {
        echo "<script>alert('Selamat! Pembayaran Berhasil Di Update. Terima Kasih.');window.location='pembayaran'</script>";
    } else {
        echo "<script>alert('Maaf! Pembayaran Gagal Di Update.');window.location='pembayaran'</script>";
    }
}



?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pembayaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Pembayaran Albadriyah Wisata</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <?php

                    $ambil = mysqli_query($kon, "SELECT max(no_pembayaran) as kodeTerbesar FROM pembayaran");
                    $data = mysqli_fetch_array($ambil);
                    $kodereg = $data['kodeTerbesar'];

                    // mengambil angka dari nomor terbesar, menggunakan fungsi substr
                    // dan diubah ke integer dengan (int)
                    $urutan = (int) substr($kodereg, 3, 3);

                    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                    $urutan++;

                    // membentuk nomor registrasi baru
                    // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                    // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                    // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
                    $huruf = "PB";
                    $kodereg = $huruf . sprintf("%03s", $urutan);

                    ?>
                    <!-- General Form Elements -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <input type="text" name="kode_pemb" id="kode_pemb" class="form-control" value="<?= $pembayaran['id_pembayaran']; ?>">
                            <label for="no_pembayaran" class="col-sm-2 col-form-label">No. Pembayaran</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_pembayaran" id="no_pembayaran" class="form-control" value="<?= $pembayaran['no_pembayaran']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_pemesanan" class="col-sm-2 col-form-label">No. Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_pemesanan" id="no_pemesanan" class="form-control" value="<?= $pembayaran['no_pemesanan']; ?>" readonly>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="tanggal_bayar" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                            <div class="col-sm-10">
                                <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control" value="<?= $pembayaran['tanggal_bayar']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah_bayar" class="col-sm-2 col-form-label">Jumlah Bayar</label>
                            <div class="col-sm-10">
                                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control" value="<?= $pembayaran['jumlah_bayar']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control">
                                    <?php $status = $pembayaran['status_pembayaran']; ?>
                                    <option value="Sedang Di Proses" <?= $status == 'Sedang Di Proses' ? 'selected' : null ?>>Sedang Di Proses</option>
                                    <option value="Pembayaran Di Terima" <?= $status == 'Pembayaran Di Terima' ? 'selected' : null ?>>Pembayaran Di Terima</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-primary">Update Pembayaran</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->
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
        document.getElementById('kode').value = prdName[id].kode;
        document.getElementById('kode2').value = prdName[id].kode2;
        document.getElementById('kode3').value = prdName[id].kode3;
        document.getElementById('harganya').value = prdName[id].harganya;
        document.getElementById('sudah_bayar').value = prdName[id].sudah_bayar;
    };
</script>