<?php

// Fungsi untuk menampilkan data
function select($query)
{
    // Panggil koneksi ke database
    global $kon;

    $result =  mysqli_query($kon, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


// Tambah data pemesanan
function create_pemesanan($post)
{
    global $kon;

    $no_pemesanan = strip_tags($post['no_pemesanan']);
    $kodepend = strip_tags($post['kodepend']);
    $no_registrasi = strip_tags($post['no_registrasi']);
    $tanggal_pemesanan = strip_tags($post['tanggal_pemesanan']);
    $kode_jadwal = strip_tags($post['kode']);
    $kode_paket = strip_tags($post['kode4']);
    $harga = strip_tags($post['harga']);
    $telah_bayar = 0;
    $sisa = 0;
    $status      = 'Belum Lunas';


    // Query tambah data
    $query = "INSERT INTO pemesanan VALUES('', '$no_pemesanan', '$kodepend', '$tanggal_pemesanan', '$kode_jadwal', '$kode_paket', '$harga', '$telah_bayar', '$sisa', '$status')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

// Tambah data pembayaran
function create_pembayaran($post)
{

    global $kon;

    $kode = strip_tags($post['kode']);
    $no_pembayaran = strip_tags($post['no_pembayaran']);
    $kode2 = strip_tags($post['kode2']);
    $kode3 = strip_tags($post['kode3']);
    $kode4 = strip_tags($post['kode4']);
    $tanggal_bayar = strip_tags($post['tanggal_bayar']);
    $jumlah_bayar = strip_tags($post['jumlah_bayar']);
    $sudah_bayar = strip_tags($post['sudah_bayar']);
    $sisa_bayar = strip_tags($post['sisa_bayar']);
    $update_bayar = strip_tags($post['update_bayar']);
    $foto = upload_file();
    $status_pembayaran = 'Sedang Di Proses';


    // Query tambah data
    $query = "INSERT INTO pembayaran VALUES('', '$no_pembayaran', '$kode', '$kode3', '$kode4', '$tanggal_bayar', '$jumlah_bayar', '$foto', '$status_pembayaran')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Fungsi mengupload file
function upload_file()
{
    $namafile   = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpname    = $_FILES['foto']['tmp_name'];

    // Cek file yang di upload
    $extensifilevalid = ['jpg', 'jpeg', 'png'];
    $extensifile      = explode('.', $namafile);
    $extensifile      = strtolower(end($extensifile));

    // Cek format / Extensi File
    if (!in_array($extensifile, $extensifilevalid)) {
        // Pesan Gagal
        echo "<script>alert('Maaf! Format File Tidak Valid');window.location='index'</script>";

        die();
    }

    // Cek ukuran file
    if ($ukuranfile > 2048000) {
        // Pesan Gagal
        echo "<script>alert('Ukuran File Max 2 MB');window.location='index'</script>";

        die();
    }

    // Pindahkan ke folder
    move_uploaded_file($tmpname, '../assets/img/upload/' . $namafile);
    return $namafile;
}
