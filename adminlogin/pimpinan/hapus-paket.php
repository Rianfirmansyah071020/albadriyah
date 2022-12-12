<?php

include 'config/app.php';

// Menerima ID Admin Yang Dipilih pengguna
$id_paket = (int)$_GET['id_paket'];

if (delete_paket($id_paket) > 0) {
    echo "<script>alert('Selamat! Data Paket Berhasil Dihapus. Terima Kasih.');window.location='paket'</script>";
} else {
    echo "<script>alert('Maaf! Data Paket Gagal Dihapus.');window.location='paket'</script>";
}
