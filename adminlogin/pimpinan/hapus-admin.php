<?php

include 'config/app.php';

// Menerima ID Admin Yang Dipilih pengguna
$id_user = (int)$_GET['id_user'];

if (delete_admin($id_user) > 0) {
    echo "<script>alert('Selamat! Data Admin Berhasil Dihapus. Terima Kasih.');window.location='tambah-admin'</script>";
} else {
    echo "<script>alert('Maaf! Data Admin Gagal Dihapus.');window.location='tambah-admin'</script>";
}
