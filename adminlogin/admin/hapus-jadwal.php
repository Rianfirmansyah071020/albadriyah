<?php

include 'config/app.php';

// Menerima ID Admin Yang Dipilih pengguna
$id_jadwal = (int)$_GET['id_jadwal'];

if (delete_jadwal($id_jadwal) > 0) {
    echo "<script>alert('Selamat! Data Jadwal Berhasil Dihapus.');window.location='jadwal'</script>";
} else {
    echo "<script>alert('Maaf! Data Jadwal Gagal Dihapus.');window.location='jadwal'</script>";
}
