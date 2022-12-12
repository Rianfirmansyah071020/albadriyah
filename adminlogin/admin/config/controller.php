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


// Menambah data admin
function create_admin($post)
{
    global $kon;


    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    //Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $lvl = strip_tags($post['level']);
    $nmlkp = strip_tags($post['nama_lengkap']);
    $tmplhr = strip_tags($post['tempat_lahir']);
    $tgllhr = strip_tags($post['tanggal_lahir']);
    $alamat = strip_tags($post['alamat']);
    $nohp = strip_tags($post['nohp']);
    $foto = upload_file();

    // Cek upload foto
    if (!$foto) {
        return false;
    }

    // Query tambah data
    $query = "INSERT INTO admin VALUES('', '$username', '$password', '$lvl', '$nmlkp', '$tmplhr', '$tgllhr', '$alamat', '$nohp', '$foto')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

// Ubah data admin
function update_admin($post)
{
    global $kon;

    $id_user = strip_tags($post['id_user']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    //Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $lvl = strip_tags($post['level']);
    $nmlkp = strip_tags($post['nama_lengkap']);
    $tmplhr = strip_tags($post['tempat_lahir']);
    $tgllhr = strip_tags($post['tanggal_lahir']);
    $alamat = strip_tags($post['alamat']);
    $nohp = strip_tags($post['nohp']);
    $fotolama = strip_tags($post['fotolama']);

    // Cek upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_file();
    }

    // Query tambah data
    // Jika password tidak diganti
    if (isset($password) or $password == '') {
        $query = "UPDATE admin SET level='$lvl', nama_lengkap = '$nmlkp', tempat_lahir = '$tmplhr', tanggal_lahir = '$tgllhr', alamat = '$alamat', nohp ='$nohp', foto = '$foto' WHERE id_user = $id_user";
    } else {
        $query = "UPDATE admin SET password = '$password', level='$lvl', nama_lengkap = '$nmlkp', tempat_lahir = '$tmplhr', tanggal_lahir = '$tgllhr', alamat = '$alamat', nohp ='$nohp', foto = '$foto' WHERE id_user = $id_user";
    }
    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

// Hapus data admin
function delete_admin($id_user)
{
    global $kon;

    // Query hapus data admin
    $query = "DELETE FROM admin WHERE id_user = $id_user";

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
    move_uploaded_file($tmpname, '../../assets/img/upload/' . $namafile);
    return $namafile;
}

// Tambah data paket
function create_paket($post)
{
    global $kon;


    $kode_paket = strip_tags($post['kode_paket']);
    $jenis = strip_tags($post['jenis']);
    $nama_paket = strip_tags($post['nama_paket']);
    $pesawat = strip_tags($post['pesawat']);
    $hotel_mekkah = strip_tags($post['hotel_mekkah']);
    $hotel_madinah = strip_tags($post['hotel_madinah']);

    // Query tambah data
    $query = "INSERT INTO paket VALUES('', '$kode_paket','$jenis' ,'$nama_paket', '$pesawat', '$hotel_mekkah', '$hotel_madinah')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Ubah data paket
function update_paket($post)
{
    global $kon;

    $id_paket = strip_tags($post['id_paket']);
    $nama_paket = strip_tags($post['nama_paket']);
    $jenis = strip_tags($post['jenis']);
    $pesawat = strip_tags($post['pesawat']);
    $hotel_mekkah = strip_tags($post['hotel_mekkah']);
    $hotel_madinah = strip_tags($post['hotel_madinah']);

    // Query tambah data
    $query = "UPDATE paket SET nama_paket='$nama_paket', jenis='$jenis', pesawat='$pesawat', hotel_mekkah = '$hotel_mekkah', hotel_madinah = '$hotel_madinah' WHERE id_paket = '$id_paket'";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Hapus data paket
function delete_paket($id_paket)
{
    global $kon;

    // Query hapus data admin
    $query = "DELETE FROM paket WHERE id_paket = $id_paket";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Tambah data jadwal
function create_jadwal($post)
{
    global $kon;


    $kode_jadwal = strip_tags($post['kode_jadwal']);
    $kode_paket = strip_tags($post['kode_paket']);
    $harga = strip_tags($post['harga']);
    $isi_kamar = strip_tags($post['isi_kamar']);
    $tanggal_keberangkatan = strip_tags($post['tanggal_keberangkatan']);
    $nopesawat = strip_tags($post['nopesawat']);
    $tanggal_kepulangan = strip_tags($post['tanggal_kepulangan']);
    $kuota_pendaftaran = strip_tags($post['kuota_pendaftaran']);

    // Query tambah data
    $query = "INSERT INTO jadwal VALUES('', '$kode_jadwal', '$kode_paket', '$harga', '$isi_kamar', '$tanggal_keberangkatan', '$nopesawat', '$tanggal_kepulangan', '$kuota_pendaftaran')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

// Ubah data jadwal
function update_jadwal($post)
{
    global $kon;

    $id_jadwal = strip_tags($post['id_jadwal']);
    $kode_jadwal = strip_tags($post['kode_jadwal']);
    $kode_paket = strip_tags($post['kode_paket']);
    $harga = strip_tags($post['harga']);
    $isi_kamar = strip_tags($post['isi_kamar']);
    $tanggal_keberangkatan = strip_tags($post['tanggal_keberangkatan']);
    $nopesawat = strip_tags($post['nopesawat']);
    $tanggal_kepulangan = strip_tags($post['tanggal_kepulangan']);
    $kuota_pendaftaran = strip_tags($post['kuota_pendaftaran']);

    // Query tambah data

    $query = "UPDATE jadwal SET kode_jadwal='$kode_jadwal', id_paket = '$kode_paket', harga = '$harga', isi_kamar = '$isi_kamar', tanggal_keberangkatan = '$tanggal_keberangkatan', nopesawat = '$nopesawat', tanggal_kepulangan = '$tanggal_kepulangan', kuota_pendaftaran = '$kuota_pendaftaran' WHERE id_jadwal = '$id_jadwal'";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Hapus data jadwal
function delete_jadwal($id_jadwal)
{
    global $kon;

    // Query hapus data admin
    $query = "DELETE FROM jadwal WHERE id_jadwal = $id_jadwal";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Tambah data pemesanan
function create_pemesanan($post)
{
    global $kon;

    $no_pemesanan = strip_tags($post['no_pemesanan']);
    $no_registrasi = strip_tags($post['no_registrasi']);
    $tanggal_pemesanan = strip_tags($post['tanggal_pemesanan']);
    $kode_jadwal = strip_tags($post['kode']);
    $kode_paket = strip_tags($post['kode4']);
    $harga = strip_tags($post['harga']);
    $telah_bayar = 0;
    $sisa = 0;
    $status      = 'Belum Lunas';


    // Query tambah data
    $query = "INSERT INTO pemesanan VALUES('', '$no_pemesanan', '$no_registrasi', '$tanggal_pemesanan', '$kode_jadwal', '$kode_paket', '$harga', '$telah_bayar', '$sisa', '$status')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}



// Update data pemesanan
function update_pemesanan($post)
{
    global $kon;

    $id_pemesanan = strip_tags($post['id_pemesanan']);
    $no_pemesanan = strip_tags($post['no_pemesanan']);
    $no_registrasi = strip_tags($post['no_registrasi']);
    $tanggal_pemesanan = strip_tags($post['tanggal_pemesanan']);
    $kode_jadwal = strip_tags($post['kode']);
    $harga = strip_tags($post['harga']);
    $telah_bayar = strip_tags($post['telah_bayar']);
    $sisa = strip_tags($post['sisa']);
    $status = strip_tags($post['status']);


    // Query tambah data
    $query = "UPDATE pemesanan SET status = '$status' WHERE id_pemesanan = '$id_pemesanan'";

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

// Tambah data pembayaran
function update_pembayaran($post)
{

    global $kon;

    $kode_pemb = strip_tags($post['kode_pemb']);
    $status_pembayaran = strip_tags($post['status']);


    // Query tambah data
    $query = "UPDATE pembayaran SET status_pembayaran = '$status_pembayaran' WHERE id_pembayaran = '$kode_pemb'";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

// Tambah Data Jamaah
function create_jamaah($post)
{
    global $kon;

    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    //Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $no_registrasi = strip_tags($post['no_registrasi']);
    $nama_lengkap = strip_tags($post['nama_lengkap']);
    $tempat_lahir = strip_tags($post['tempat_lahir']);
    $tanggal_lahir = strip_tags($post['tanggal_lahir']);
    $jk = strip_tags($post['jk']);
    $nik = strip_tags($post['nik']);
    $alamat = strip_tags($post['alamat']);
    $kota = strip_tags($post['kota']);
    $provinsi = strip_tags($post['provinsi']);
    $kode_pos = strip_tags($post['kode_pos']);
    $email = strip_tags($post['email']);
    $telpon_rumah = strip_tags($post['telpon_rumah']);
    $no_hp = strip_tags($post['no_hp']);
    $ukuran_pakaian = strip_tags($post['ukuran_pakaian']);
    $ahli_waris = strip_tags($post['ahli_waris']);
    $hubungan = strip_tags($post['hubungan']);
    $norekening = strip_tags($post['norekening']);
    $atas_nama = strip_tags($post['atas_nama']);
    $nama_bank = strip_tags($post['nama_bank']);
    $foto = upload_file();

    // Cek upload foto
    if (!$foto) {
        return false;
    }

    // Query tambah data
    $query = "INSERT INTO pendaftaran VALUES('', '$username', '$password', '$no_registrasi', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$jk', '$nik', '$alamat', '$kota', '$provinsi', '$kode_pos', '$email', '$telpon_rumah', '$no_hp', '$ukuran_pakaian', '$ahli_waris', '$hubungan', '$norekening', '$atas_nama', '$nama_bank', '$foto')";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}


// Ubah data jamaah
function update_jamaah($post)
{
    global $kon;

    $id_pend = strip_tags($post['id_pend']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    //Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $no_registrasi = strip_tags($post['no_registrasi']);
    $nama_lengkap = strip_tags($post['nama_lengkap']);
    $tempat_lahir = strip_tags($post['tempat_lahir']);
    $tanggal_lahir = strip_tags($post['tanggal_lahir']);
    $jk = strip_tags($post['jk']);
    $nik = strip_tags($post['nik']);
    $alamat = strip_tags($post['alamat']);
    $kota = strip_tags($post['kota']);
    $provinsi = strip_tags($post['provinsi']);
    $kode_pos = strip_tags($post['kode_pos']);
    $email = strip_tags($post['email']);
    $telpon_rumah = strip_tags($post['telpon_rumah']);
    $no_hp = strip_tags($post['no_hp']);
    $ukuran_pakaian = strip_tags($post['ukuran_pakaian']);
    $ahli_waris = strip_tags($post['ahli_waris']);
    $hubungan = strip_tags($post['hubungan']);
    $norekening = strip_tags($post['norekening']);
    $atas_nama = strip_tags($post['atas_nama']);
    $nama_bank = strip_tags($post['nama_bank']);
    $fotolama = strip_tags($post['fotolama']);

    // Cek upload foto baru atau tidak
    if ($_FILES['foto']['error'] == 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_file();
    }

    // Query tambah data
    // Jika password tidak diganti
    if (isset($password) or $password == '') {
        $query = "UPDATE pendaftaran SET nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jk = '$jk', nik = '$nik', alamat ='$alamat', kota = '$kota', provinsi = '$provinsi', kode_pos = '$kode_pos', email = '$email', telpon_rumah = '$telpon_rumah', no_hp = '$no_hp', ukuran_pakaian = '$ukuran_pakaian', ahli_waris = '$ahli_waris', hubungan = '$hubungan', norekening = '$norekening', atas_nama = '$atas_nama', nama_bank = '$nama_bank', foto = '$foto' WHERE id_pend = '$id_pend'";
    } else {
        $query = "UPDATE pendaftaran SET password = '$password', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jk = '$jk', nik = '$nik', alamat ='$alamat', kota = '$kota', provinsi = '$provinsi', kode_pos = '$kode_pos', email = '$email', telpon_rumah = '$telpon_rumah', no_hp = '$no_hp', ukuran_pakaian = '$ukuran_pakaian', ahli_waris = '$ahli_waris', hubungan = '$hubungan', norekening = '$norekening', atas_nama = '$atas_nama', nama_bank = '$nama_bank', foto = '$foto' WHERE id_pend = '$id_pend'";
    }
    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}

// Hapus data jamaah
function delete_jamaah($id_pend)
{
    global $kon;

    // Query hapus data jamaah
    $query = "DELETE FROM pendaftaran WHERE id_pend = $id_pend";

    mysqli_query($kon, $query);

    return mysqli_affected_rows($kon);
}