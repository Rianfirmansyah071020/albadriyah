<?php

if (isset($_POST['btn_simpan'])) {
    //Include file koneksi, untuk koneksikan ke database
    include 'includes/koneksi.php';

    // menangkap data dari form
    $noreg = $_POST['noreg'];
    $namalkp = $_POST['namalkp'];
    $tmplhr = $_POST['tmplhr'];
    $tgllhr = $_POST['tgllhr'];
    $jekel = $_POST['jekel'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $provinsi = $_POST['provinsi'];
    $kodepos = $_POST['kodepos'];
    $emailp = $_POST['emailp'];
    $telp = $_POST['telp'];
    $nohp = $_POST['nohp'];
    $ukuran = $_POST['ukuran'];
    $waris = $_POST['waris'];
    $hubungan = $_POST['hubungan'];
    $norek = $_POST['norek'];
    $atas_nama = $_POST['atas_nama'];
    $bank = $_POST['bank'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $ekstensi_diperbolehkan    = array('png', 'jpg');
        $gambar = $_FILES['gambar']['name'];
        $x = explode('.', $gambar);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if (!empty($gambar)) {
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

                //Mengupload gambar
                move_uploaded_file($file_tmp, 'assets/img/upload/' . $gambar);

                $sql = "insert into pendaftaran (id_pend, username, password, no_registrasi, nama_lengkap, tempat_lahir, tanggal_lahir, jk, nik, alamat, kota, provinsi, kode_pos, email, telpon_rumah, no_hp, ukuran_pakaian, ahli_waris, hubungan, norekening, atas_nama, nama_bank, foto) values ('', '$username', '$password', '$noreg', '$namalkp', '$tmplhr', '$tgllhr', '$jekel', '$nik', '$alamat', '$kota', '$provinsi', '$kodepos', '$emailp', '$telp', '$nohp', '$ukuran', '$waris', '$hubungan', '$norek', '$atas_nama', '$bank', '$gambar')";


                $simpan_bank = mysqli_query($kon, $sql);

                if ($simpan_bank) {
                    header("Location:daftar.php?add=berhasil");
                } else {
                    header("Location:daftar.php?add=gagal");
                }
            }
        } else {
            $gambar = "bank_default.png";
        }
    }
}
