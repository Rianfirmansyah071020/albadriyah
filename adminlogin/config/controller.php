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
    $query = "UPDATE admin SET username = '$username', password = '$password', level='$lvl', nama_lengkap = '$nmlkp', tempat_lahir = '$tmplhr', tanggal_lahir = '$tgllhr', alamat = '$alamat', nohp ='$nohp', foto = '$foto' WHERE id_user = $id_user";

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
        echo "<script>alert('Maaf! Format File Tidak Valid');window.location='data_admin'</script>";

        die();
    }

    // Cek ukuran file
    if ($ukuranfile > 2048000) {
        // Pesan Gagal
        echo "<script>alert('Ukuran File Max 2 MB');window.location='data_admin'</script>";

        die();
    }    

    // Pindahkan ke folder
    move_uploaded_file($tmpname, 'assets/img/' . $namafile);
    return $namafile;
}

?>