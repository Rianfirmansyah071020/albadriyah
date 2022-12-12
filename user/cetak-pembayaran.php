<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
session_start();
if (!isset($_SESSION["username"])) header("Location: ../login");
include "fpdf/fpdf.php";
include 'config/app.php';


$ambiladmin = "SELECT * FROM admin WHERE id_user";
$sql_admin = mysqli_query($kon, $ambiladmin);
$admin = mysqli_fetch_array($sql_admin);

$noreg = $_SESSION['id_pend'];

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('L', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();

// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->image('assets/img/logo3.png', 50, 8, 17);
$pdf->SetFont('Arial', 'B', 24);
// judul
$pdf->Cell(290, 7, 'PT. ALBADRIYAH WISATA PADANG', 0, 1, 'C');
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(290, 7, 'Jalan Profesor Dr. Hamka No. 61 Simpang GIA Kelurahan Parupuk Tabing', 0, 1, 'C');
$pdf->Cell(290, 2, 'Kec. Koto Tangah, Kota Padang Sumatera Barat', 0, 1, 'C');

$pdf->SetlineWidth(1);
$pdf->Line(10, 34, 286, 34);
$pdf->SetlineWidth(0);
$pdf->Line(10, 35, 286, 35);
$pdf->Ln(20);
$pdf->SetFont('Arial', 'U', 15);
$pdf->Cell(290, 7, 'LAPORAN PEMBAYARAN', 0, 1, 'C');
$pdf->Ln(7);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(10, 9, 'No.', 1, 0, 'C', 0, 'C');
$pdf->Cell(40, 9, 'No. Pembayaran', 1, 0, 'C');
$pdf->Cell(40, 9, 'No. Pemesanan', 1, 0, 'C');
$pdf->Cell(35, 9, 'No. Registrasi', 1, 0, 'C');
$pdf->Cell(60, 9, 'Nama Jamaah', 1, 0, 'C');
$pdf->Cell(40, 9, 'Tanggal Bayar', 1, 0, 'C');
$pdf->Cell(50, 9, 'Jumlah Bayar', 1, 1, 'R');

$pdf->SetFont('Arial', '', 13);
$currentdate = date("d-M-Y");
$no = 1;

$data_pembayaran = "SELECT * FROM pembayaran
INNER JOIN pemesanan ON pembayaran.id_pemesanan = pemesanan.id_pemesanan
INNER JOIN pendaftaran ON pembayaran.id_pend = pendaftaran.id_pend
INNER JOIN paket ON pembayaran.id_paket = paket.id_paket
WHERE pembayaran.id_pend = $noreg
";
$sql_rm = mysqli_query($kon, $data_pembayaran) or die(mysqli_error($kon));
while ($hasil = mysqli_fetch_array($sql_rm)) {
    $pdf->Cell(10, 9, $no++, 1, 0, 'C');
    $pdf->Cell(40, 9, $hasil['no_pembayaran'], 1, 0, 'C');
    $pdf->Cell(40, 9, $hasil['no_pemesanan'], 1, 0, 'C');
    $pdf->Cell(35, 9, $hasil['no_registrasi'], 1, 0, 'C');
    $pdf->Cell(60, 9, $hasil['nama_lengkap'], 1, 0, 'C');
    $pdf->Cell(40, 9, date('d-M-Y', strtotime($hasil['tanggal_bayar'])), 1, 0, 'C');
    $pdf->Cell(50, 9, number_format($hasil['jumlah_bayar'], 0, ",", "."), 1, 1, 'R');
}

$pdf->Ln(15);
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(200, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Padang,', 0, 0, 'C');
$pdf->Cell(1, 5, $currentdate, 0, 0, 'C');
$pdf->Ln(7);
$pdf->Cell(200, 5, '', 0, 0);
$pdf->Cell(80, 5, 'Admin', 0, 0, 'C');
$pdf->Ln(20);
$pdf->Cell(200, 5, '', 0, 0);
$pdf->Cell(80, 5, $admin['nama_lengkap'], 0, 0, 'C');

$pdf->Output("Laporan-Pembayaran.pdf", 'I');
