<?php

include 'config/app.php';

// Menerima ID jamaah Yang Dipilih pengguna
$id_pend = (int)$_GET['id_pend'];

if (delete_jamaah($id_pend) > 0) {
    echo "<script>alert('Selamat! Data Jamaah Berhasil Dihapus. Terima Kasih.');window.location='tambah-jamaah'</script>";
} else {
    echo "<script>alert('Maaf! Data Jamaah Gagal Dihapus.');window.location='tambah-jamaah'</script>";
}
