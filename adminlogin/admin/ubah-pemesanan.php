<?php require 'config/auth.php'; ?>

<?php $title = 'Pemesanan';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_pemesanan = select("SELECT * FROM pemesanan");
?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (update_pemesanan($_POST) > 0) {
        echo "<script>alert('Selamat! Data Pemesanan Berhasil Di Update. Terima Kasih.');window.location='pemesanan'</script>";
    } else {
        echo "<script>alert('Maaf! Data Pemesanan Gagal Di Update.');window.location='pemesanan'</script>";
    }
}

// Ambil id paket dari url
$id_pemesanan = (int)$_GET['id_pemesanan'];

// Query ambil data user
$qpesan = "SELECT * FROM pemesanan
INNER JOIN pendaftaran ON pemesanan.id_pend = pendaftaran.id_pend
INNER JOIN jadwal ON pemesanan.id_jadwal = jadwal.id_jadwal
INNER JOIN paket ON pemesanan.id_paket = paket.id_paket
WHERE id_pemesanan = $id_pemesanan
";
$sql_rm = mysqli_query($kon, $qpesan) or die(mysqli_error($kon));
$pemesananid = mysqli_fetch_array($sql_rm);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pemesanan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Pemesanan Albadriyah Wisata</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <!-- General Form Elements -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?= $pemesananid['id_pemesanan']; ?>">
                            <label for="no_pemesanan" class="col-sm-2 col-form-label">No. Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_pemesanan" id="no_pemesanan" class="form-control" value="<?= $pemesananid['no_pemesanan']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_registrasi" class="col-sm-2 col-form-label">No. Registrasi</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_registrasi" id="no_registrasi" class="form-control" value="<?= $pemesananid['no_registrasi']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tanggal_pemesanan" class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
                            <div class="col-sm-10">
                                <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" value="<?= $pemesananid['tanggal_pemesanan']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="kode_jadwal" class="col-sm-2 col-form-label">Kode Jadwal</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode_jadwal" id="kode_jadwal" class="form-control" value="<?= $pemesananid['kode_jadwal']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" name="harga" id="harga" onclick="sum();" class="form-control" value="<?= $pemesananid['harga']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telah_bayar" class="col-sm-2 col-form-label">Telah Bayar</label>
                            <div class="col-sm-10">
                                <input type="number" name="telah_bayar" id="telah_bayar" onclick="sum();" class="form-control" value="<?= $pemesananid['telah_bayar']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="sisa" class="col-sm-2 col-form-label">Sisa</label>
                            <div class="col-sm-10">
                                <input type="number" name="sisa" id="sisa" class="form-control" value="<?= $pemesananid['sisa']; ?>" readonly>
                            </div>
                        </div>

                        <script>
                            function sum() {
                                var txtFirstNumberValue = document.getElementById('harga').value;
                                var txtSecondNumberValue = document.getElementById('telah_bayar').value;
                                var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue);
                                if (!isNaN(result)) {
                                    document.getElementById('sisa').value = result;
                                }
                            }
                        </script>

                        <div class="row mb-3">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control">
                                    <?php $status = $pemesananid['status']; ?>
                                    <option value="Belum Lunas" <?= $status == 'Belum Lunas' ? 'selected' : null ?>>Belum Lunas</option>
                                    <option value="Lunas" <?= $status == 'Lunas' ? 'selected' : null ?>>Lunas</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" name="btn_simpan" id="btn_simpan" class="btn btn-primary">Update Pesanan</button>
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