<?php require 'config/auth.php'; ?>


<?php $title = 'Data Jadwal';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_pendaftaran = select("SELECT * FROM pendaftaran");
?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (update_jamaah($_POST) > 0) {
        echo "<script>alert('Selamat! Data Jamaah Berhasil Di Update. Terima Kasih.');window.location='tambah-jamaah'</script>";
    } else {
        echo "<script>alert('Maaf! Data Jamaah Gagal Di Update.');window.location='tambah-jamaah'</script>";
    }
}

// Ambil id pendaftaran dari url
$id_pend = (int)$_GET['id_pend'];

// Query ambil data user
$daftarid = select("SELECT * FROM pendaftaran WHERE id_pend = $id_pend")[0];

?>

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mb-3 mt-3">
                    <h1>Data Jamaah</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Jamaah Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <?php

                    $ambil = mysqli_query($kon, "SELECT max(no_registrasi) as kodeTerbesar FROM pendaftaran");
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
                    $huruf = "REG";
                    $kodereg = $huruf . sprintf("%03s", $urutan);

                    ?>
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">

                              <div class="row mb-3">
                                   <input type="hidden" name="id_pend" id="id_pend"
                                        value="<?= $daftarid['id_pend']; ?>">
                                   <input type="hidden" name="fotolama" id="fotolama" value="<?= $daftarid['foto']; ?>">
                                   <label for="no_registrasi" class="col-sm-2 col-form-label">Nomor Registrasi</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="no_registrasi" id="no_registrasi" class="form-control"
                                             value="<?= $daftarid['no_registrasi']; ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                             value="<?= $daftarid['nama_lengkap']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                             value="<?= $daftarid['tempat_lahir']; ?>">
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                             value="<?= $daftarid['tanggal_lahir']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                   <div class="col-sm-10">
                                        <select name="jk" id="jk" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <?php $jekel = $daftarid['jk']; ?>
                                             <option value="Pria" <?= $jekel == 'Pria' ? 'selected' : null ?>>Pria
                                             </option>
                                             <option value="Wanita" <?= $jekel == 'Wanita' ? 'selected' : null ?>>Wanita
                                             </option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nik" id="nik" class="form-control"
                                             value="<?= $daftarid['nik']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                   <div class="col-sm-10">
                                        <textarea class="form-control" id="alamat"
                                             name="alamat"><?= $daftarid['alamat']; ?></textarea>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="kota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kota" name="kota"
                                             value="<?= $daftarid['kota']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                   <div class="col-sm-10">
                                        <select name="provinsi" id="provinsi" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih Provinsi</option>
                                             <?php $pilprov = $daftarid['provinsi']; ?>
                                             <option value="Nanggroe Aceh Darussalam"
                                                  <?= $pilprov == 'Nanggroe Aceh Darussalam' ? 'selected' : null ?>>
                                                  Nanggroe Aceh Darussalam</option>
                                             <option value="Sumatera Utara"
                                                  <?= $pilprov == 'Sumatera Utara' ? 'selected' : null ?>>Sumatera Utara
                                             </option>
                                             <option value="Sumatera Selatan"
                                                  <?= $pilprov == 'Sumatera Selatan' ? 'selected' : null ?>>Sumatera
                                                  Selatan</option>
                                             <option value="Sumatera Barat"
                                                  <?= $pilprov == 'Sumatera Barat' ? 'selected' : null ?>>Sumatera Barat
                                             </option>
                                             <option value="Bengkulu" <?= $pilprov == 'Bengkulu' ? 'selected' : null ?>>
                                                  Bengkulu</option>
                                             <option value="Riau" <?= $pilprov == 'Riau' ? 'selected' : null ?>>Riau
                                             </option>
                                             <option value="Kepulauan Riau"
                                                  <?= $pilprov == 'Kepulauan Riau' ? 'selected' : null ?>>Kepulauan Riau
                                             </option>
                                             <option value="Jambi" <?= $pilprov == 'Jambi' ? 'selected' : null ?>>Jambi
                                             </option>
                                             <option value="Lampung" <?= $pilprov == 'Lampung' ? 'selected' : null ?>>
                                                  Lampung</option>
                                             <option value="Bangka Belitung"
                                                  <?= $pilprov == 'Bangka Belitung' ? 'selected' : null ?>>Bangka
                                                  Belitung</option>
                                             <option value="Kalimantan Timur"
                                                  <?= $pilprov == 'Kalimantan Timur' ? 'selected' : null ?>>Kalimantan
                                                  Timur</option>
                                             <option value="Kalimantan Barat"
                                                  <?= $pilprov == 'Kalimantan Barat' ? 'selected' : null ?>>Kalimantan
                                                  Barat</option>
                                             <option value="Kalimantan Tengah"
                                                  <?= $pilprov == 'Kalimantan Tengah' ? 'selected' : null ?>>Kalimantan
                                                  Tengah</option>
                                             <option value="Kalimantan Selatan"
                                                  <?= $pilprov == 'Kalimantan Selatan' ? 'selected' : null ?>>Kalimantan
                                                  Selatan</option>
                                             <option value="Kalimantan Utara"
                                                  <?= $pilprov == 'Kalimantan Utara' ? 'selected' : null ?>>Kalimantan
                                                  Utara</option>
                                             <option value="DKI Jakarta"
                                                  <?= $pilprov == 'DKI Jakarta' ? 'selected' : null ?>>DKI Jakarta
                                             </option>
                                             <option value="Banten" <?= $pilprov == 'Banten' ? 'selected' : null ?>>
                                                  Banten</option>
                                             <option value="Jawa Barat"
                                                  <?= $pilprov == 'Jawa Barat' ? 'selected' : null ?>>Jawa Barat
                                             </option>
                                             <option value="Jawa Tengah"
                                                  <?= $pilprov == 'Jawa Tengah' ? 'selected' : null ?>>Jawa Tengah
                                             </option>
                                             <option value="DI Yogyakarta"
                                                  <?= $pilprov == 'DI Yogyakarta' ? 'selected' : null ?>>DI Yogyakarta
                                             </option>
                                             <option value="Jawa Timur"
                                                  <?= $pilprov == 'Jawa Timur' ? 'selected' : null ?>>Jawa Timur
                                             </option>
                                             <option value="Bali" <?= $pilprov == 'Bali' ? 'selected' : null ?>>Bali
                                             </option>
                                             <option value="Nusa Tenggara Barat"
                                                  <?= $pilprov == 'Nusa Tenggara Barat' ? 'selected' : null ?>>Nusa
                                                  Tenggara Barat</option>
                                             <option value="Nusa Tenggara Timur"
                                                  <?= $pilprov == 'Nusa Tenggara Timur' ? 'selected' : null ?>>Nusa
                                                  Tenggara Timur</option>
                                             <option value="Sulawesi Utara"
                                                  <?= $pilprov == 'Sulawesi Utara' ? 'selected' : null ?>>Sulawesi Utara
                                             </option>
                                             <option value="Sulawesi Barat"
                                                  <?= $pilprov == 'Sulawesi Barat' ? 'selected' : null ?>>Sulawesi Barat
                                             </option>
                                             <option value="Sulawesi Tengah"
                                                  <?= $pilprov == 'Sulawesi Tengah' ? 'selected' : null ?>>Sulawesi
                                                  Tengah</option>
                                             <option value="Gorontalo"
                                                  <?= $pilprov == 'Gorontalo"' ? 'selected' : null ?>>Gorontalo</option>
                                             <option value="Sulawesi Tenggara"
                                                  <?= $pilprov == 'Sulawesi Tenggara' ? 'selected' : null ?>>Sulawesi
                                                  Tenggara</option>
                                             <option value="Sulawesi Selatan"
                                                  <?= $pilprov == 'Sulawesi Selatan' ? 'selected' : null ?>>Sulawesi
                                                  Selatan</option>
                                             <option value="Maluku" <?= $pilprov == 'Maluku' ? 'selected' : null ?>>
                                                  Maluku</option>
                                             <option value="Maluku Utara"
                                                  <?= $pilprov == 'Maluku Utara' ? 'selected' : null ?>>Maluku Utara
                                             </option>
                                             <option value="Papua" <?= $pilprov == 'Papua' ? 'selected' : null ?>>Papua
                                             </option>
                                             <option value="Papua Barat"
                                                  <?= $pilprov == 'Papua Barat' ? 'selected' : null ?>>Papua Barat
                                             </option>
                                             <option value="Papua Selatan"
                                                  <?= $pilprov == 'Papua Selatan' ? 'selected' : null ?>>Papua Selatan
                                             </option>
                                             <option value="Papua Tengah"
                                                  <?= $pilprov == 'Papua Tengah' ? 'selected' : null ?>>Papua Tengah
                                             </option>
                                             <option value="Papua Pegunungan"
                                                  <?= $pilprov == 'Papua Pegunungan' ? 'selected' : null ?>>Papua
                                                  Pegunungan</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                             value="<?= $daftarid['kode_pos']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="email" class="col-sm-2 col-form-label">Email</label>
                                   <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                             value="<?= $daftarid['email']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="telpon_rumah" class="col-sm-2 col-form-label">Telpon Rumah</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="telpon_rumah" name="telpon_rumah"
                                             value="<?= $daftarid['telpon_rumah']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="no_hp" class="col-sm-2 col-form-label">No Handphone</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                             value="<?= $daftarid['no_hp']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="ukuran_pakaian" class="col-sm-2 col-form-label">Ukuran Pakaian</label>
                                   <div class="col-sm-10">
                                        <select name="ukuran_pakaian" id="ukuran_pakaian" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <?php $ukuranp = $daftarid['ukuran_pakaian']; ?>
                                             <option value="S" <?= $ukuranp == 'S' ? 'selected' : null ?>>S</option>
                                             <option value="M" <?= $ukuranp == 'M' ? 'selected' : null ?>>M</option>
                                             <option value="L" <?= $ukuranp == 'L' ? 'selected' : null ?>>L</option>
                                             <option value="XL" <?= $ukuranp == 'XL' ? 'selected' : null ?>>XL</option>
                                             <option value="XXL" <?= $ukuranp == 'XXL' ? 'selected' : null ?>>XXL
                                             </option>
                                             <option value="XXXL" <?= $ukuranp == 'XXXL' ? 'selected' : null ?>>XXXL
                                             </option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="ahli_waris" class="col-sm-2 col-form-label">Ahli Waris</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ahli_waris" name="ahli_waris"
                                             value="<?= $daftarid['ahli_waris']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="hubungan" class="col-sm-2 col-form-label">Hubungan</label>
                                   <div class="col-sm-10">
                                        <select name="hubungan" id="hubungan" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <?php $hubung = $daftarid['hubungan']; ?>
                                             <option value="Ayah Kandung"
                                                  <?= $hubung == 'Ayah Kandung' ? 'selected' : null ?>>Ayah Kandung
                                             </option>
                                             <option value="Ibu Kandung"
                                                  <?= $hubung == 'Ibu Kandung' ? 'selected' : null ?>>Ibu Kandung
                                             </option>
                                             <option value="Suami" <?= $hubung == 'Suami' ? 'selected' : null ?>>Suami
                                             </option>
                                             <option value="Istri" <?= $hubung == 'Istri' ? 'selected' : null ?>>Istri
                                             </option>
                                             <option value="Saudara" <?= $hubung == 'Saudara' ? 'selected' : null ?>>
                                                  Saudara</option>
                                             <option value="Kerabat" <?= $hubung == 'Kerabat' ? 'selected' : null ?>>
                                                  Kerabat</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="norekening" class="col-sm-2 col-form-label">No. Rekening</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="norekening" name="norekening"
                                             value="<?= $daftarid['norekening']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="atas_nama" class="col-sm-2 col-form-label">Atas Nama</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="atas_nama" name="atas_nama"
                                             value="<?= $daftarid['atas_nama']; ?>">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nama_bank" class="col-sm-2 col-form-label">Nama Bank</label>
                                   <div class="col-sm-10">
                                        <select name="nama_bank" id="nama_bank" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih Bank</option>
                                             <?php $nbank = $daftarid['nama_bank']; ?>
                                             <option value="Bank Indonesia (BI)"
                                                  <?= $nbank == 'Bank Indonesia (BI)' ? 'selected' : null ?>>Bank
                                                  Indonesia (BI)</option>
                                             <option value="Bank Nagari"
                                                  <?= $nbank == 'Bank Nagari' ? 'selected' : null ?>>Bank Nagari
                                             </option>
                                             <option value="Bank Mandiri"
                                                  <?= $nbank == 'Bank Mandiri' ? 'selected' : null ?>>Bank Mandiri
                                             </option>
                                             <option value="Bank Negara Indonesia (BNI)"
                                                  <?= $nbank == 'Bank Negara Indonesia (BNI)' ? 'selected' : null ?>>
                                                  Bank Negara Indonesia (BNI)</option>
                                             <option value="Bank Rakyat Indonesia (BRI)"
                                                  <?= $nbank == 'Bank Rakyat Indonesia (BRI)' ? 'selected' : null ?>>
                                                  Bank Rakyat Indonesia (BRI)</option>
                                             <option value="Bank Tabungan Negara (BTN)"
                                                  <?= $nbank == 'Bank Tabungan Negara (BTN)' ? 'selected' : null ?>>Bank
                                                  Tabungan Negara (BTN)</option>
                                             <option value="Bank BRI Agroniaga"
                                                  <?= $nbank == 'Bank BRI Agroniaga' ? 'selected' : null ?>>Bank BRI
                                                  Agroniaga</option>
                                             <option value="Bank Central Asia (BCA)"
                                                  <?= $nbank == 'Bank Central Asia (BCA)' ? 'selected' : null ?>>Bank
                                                  Central Asia (BCA)</option>
                                             <option value="Bank CIMB Niaga"
                                                  <?= $nbank == 'Bank CIMB Niaga' ? 'selected' : null ?>>Bank CIMB Niaga
                                             </option>
                                             <option value="Bank Danamon Indonesia"
                                                  <?= $nbank == 'Bank Danamon Indonesia' ? 'selected' : null ?>>Bank
                                                  Danamon Indonesia</option>
                                             <option value="Bank Maybank Indonesia"
                                                  <?= $nbank == 'Bank Maybank Indonesia' ? 'selected' : null ?>>Bank
                                                  Maybank Indonesia</option>
                                             <option value="Bank Mayapada"
                                                  <?= $nbank == 'Bank Mayapada' ? 'selected' : null ?>>Bank Mayapada
                                             </option>
                                             <option value="Bank Mega" <?= $nbank == 'Bank Mega' ? 'selected' : null ?>>
                                                  Bank Mega</option>
                                             <option value="Panin Bank"
                                                  <?= $nbank == 'Panin Bank' ? 'selected' : null ?>>Panin Bank</option>
                                             <option value="Bank Permata"
                                                  <?= $nbank == 'Bank Permata' ? 'selected' : null ?>>Bank Permata
                                             </option>
                                             <option value="Bank BNI Syariah"
                                                  <?= $nbank == 'Bank BNI Syariah' ? 'selected' : null ?>>Bank BNI
                                                  Syariah</option>
                                             <option value="Bank Mega Syariah"
                                                  <?= $nbank == 'Bank Mega Syariah' ? 'selected' : null ?>>Bank Mega
                                                  Syariah</option>
                                             <option value="Bank Muamalat Indonesia"
                                                  <?= $nbank == 'Bank Muamalat Indonesia' ? 'selected' : null ?>>Bank
                                                  Muamalat Indonesia</option>
                                             <option value="Bank Syariah Mandiri"
                                                  <?= $nbank == 'Bank Syariah Mandiri' ? 'selected' : null ?>>Bank
                                                  Syariah Mandiri</option>
                                             <option value="BCA Syariah"
                                                  <?= $nbank == 'BCA Syariah' ? 'selected' : null ?>>BCA Syariah
                                             </option>
                                             <option value="Bank BJB Syariah"
                                                  <?= $nbank == 'Bank BJB Syariah' ? 'selected' : null ?>>Bank BJB
                                                  Syariah</option>
                                             <option value="Bank BRI Syariah"
                                                  <?= $nbank == 'Bank BRI Syariah' ? 'selected' : null ?>>Bank BRI
                                                  Syariah</option>
                                             <option value="Panin Bank Syariah"
                                                  <?= $nbank == 'Panin Bank Syariah' ? 'selected' : null ?>>Panin Bank
                                                  Syariah</option>
                                             <option value="Bank Syariah Bukopin"
                                                  <?= $nbank == 'Bank Syariah Bukopin' ? 'selected' : null ?>>Bank
                                                  Syariah Bukopin</option>
                                             <option value="Bank Victoria Syariah"
                                                  <?= $nbank == 'Bank Victoria Syariah' ? 'selected' : null ?>>Bank
                                                  Victoria Syariah</option>
                                             <option value="BTPN Syariah"
                                                  <?= $nbank == 'BTPN Syariah' ? 'selected' : null ?>>BTPN Syariah
                                             </option>
                                             <option value="Bank Maybank Syariah Indonesia"
                                                  <?= $nbank == 'Bank Maybank Syariah Indonesia' ? 'selected' : null ?>>
                                                  Bank Maybank Syariah Indonesia</option>
                                             <option value="Bank BTN Syariah"
                                                  <?= $nbank == 'Bank BTN Syariah' ? 'selected' : null ?>>Bank BTN
                                                  Syariah</option>
                                             <option value="Bank Danamon Syariah"
                                                  <?= $nbank == 'Bank Danamon Syariah' ? 'selected' : null ?>>Bank
                                                  Danamon Syariah</option>
                                             <option value="CIMB Niaga Syariah"
                                                  <?= $nbank == 'CIMB Niaga Syariah' ? 'selected' : null ?>>CIMB Niaga
                                                  Syariah</option>
                                             <option value="Bank Nagari Syariah"
                                                  <?= $nbank == 'Bank Nagari Syariah' ? 'selected' : null ?>>Bank Nagari
                                                  Syariah</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="username" class="col-sm-2 col-form-label">Username</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username"
                                             value="<?= $daftarid['username']; ?>" readonly>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="password" class="col-sm-2 col-form-label">Password</label>
                                   <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password">
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                   <div class="col-sm-10">
                                        <input type="file" name="foto" id="foto" class="form-control">
                                        <p>
                                             <small>Gambar Sebelumnya</small>
                                        </p>
                                        <a href="../../assets/img/upload/<?= $daftarid['foto']; ?>" target="_blank">
                                             <img src="../../assets/img/upload/<?= $daftarid['foto']; ?>" alt="foto"
                                                  width="100px"></a>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Update Jamaah</button>
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