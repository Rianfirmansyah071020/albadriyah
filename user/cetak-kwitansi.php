<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
session_start();
if (!isset($_SESSION["username"])) header("Location: ../login");
include "fpdf/fpdf.php";
include 'config/app.php';

$id_pemb = $_GET['id_pembayaran'];


$ambiladmin = "SELECT * FROM admin WHERE id_user";
$sql_admin = mysqli_query($kon, $ambiladmin);
$admin = mysqli_fetch_array($sql_admin);

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('P', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();

// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->image('assets/img/logo3.png', 15, 8, 17);
$pdf->SetFont('Arial', 'B', 20);
// judul
$pdf->Cell(215, 7, 'PT. ALBADRIYAH WISATA PADANG', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(215, 7, 'Jalan Profesor Dr. Hamka No. 61 Simpang GIA Kelurahan Parupuk Tabing', 0, 1, 'C');
$pdf->Cell(215, 2, 'Kec. Koto Tangah, Kota Padang Sumatera Barat', 0, 1, 'C');

$pdf->SetlineWidth(1);
$pdf->Line(10, 34, 200, 34);
$pdf->SetlineWidth(0);
$pdf->Line(10, 35, 200, 35);
$pdf->Ln(20);
$pdf->SetFont('Arial', 'U', 12);
$pdf->Cell(195, 7, 'KWITANSI PEMBAYARAN', 0, 1, 'C');
$pdf->Ln(4);

//set font to arial, bold, 14pt
$pdf->SetFont('Arial', 'B', 14);

//Cell(width , height , text , border , end line , [align] )
$no = 1;

$data_pembayaran = "SELECT * FROM pembayaran
INNER JOIN pemesanan ON pembayaran.id_pemesanan = pemesanan.id_pemesanan
INNER JOIN pendaftaran ON pembayaran.id_pend = pendaftaran.id_pend
INNER JOIN paket ON pembayaran.id_paket = paket.id_paket
WHERE id_pembayaran = $id_pemb
";
$sql_rm = mysqli_query($kon, $data_pembayaran) or die(mysqli_error($kon));
$hasil = mysqli_fetch_array($sql_rm);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(5);
$pdf->Cell(35, 6, 'No. Pemesanan', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->Cell(40, 6, $hasil['no_pemesanan'], 0, 0);
$pdf->Cell(25, 6, 'Nama Jamaah', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->Cell(10, 6, $hasil['nama_lengkap'], 0, 1);

$pdf->Cell(35, 6, 'Tgl. Pemesanan', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->Cell(40, 6, date('d-M-Y', strtotime($hasil['tanggal_pemesanan'])), 0, 0);
$pdf->Cell(25, 6, 'Alamat', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->Cell(10, 6, $hasil['alamat'], 0, 1); //end of line

$pdf->Cell(35, 6, 'Nama Paket', 0, 0);
$pdf->Cell(3, 6, ':', 0, 0);
$pdf->Cell(150, 6, $hasil['nama_paket'], 1, 1); //end of line
$pdf->Ln(5);

//invoice contents
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(35, 6, 'No. Pembayaran', 1, 0, 'C');
$pdf->Cell(80, 6, 'Tanggal Bayar', 1, 0, 'C');
$pdf->Cell(73, 6, 'Jumlah Bayar', 1, 1, 'C'); //end of line

$pdf->SetFont('Arial', '', 10);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(35, 6, $hasil['no_pembayaran'], 1, 0, 'C');
$pdf->Cell(80, 6, date('d-M-Y', strtotime($hasil['tanggal_bayar'])), 1, 0, 'C');
$pdf->Cell(73, 6, number_format($hasil['jumlah_bayar'], 0, ",", "."), 1, 1, 'R'); //end of line

//summary
$pdf->Cell(115, 6, '', 0, 0);
$pdf->Cell(35, 6, 'Total Bayar', 0, 0);
$pdf->Cell(8, 6, 'Rp.', 1, 0);
$pdf->Cell(30, 6, number_format($hasil['telah_bayar'], 0, ",", "."), 1, 1, 'R'); //end of line

$pdf->Cell(115, 6, '', 0, 0);
$pdf->Cell(35, 6, 'Harga Paket', 0, 0);
$pdf->Cell(8, 6, 'Rp.', 1, 0);
$pdf->Cell(30, 6, number_format($hasil['harga'], 0, ",", "."), 1, 1, 'R'); //end of line

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(115, 6, '', 0, 0);
$pdf->Cell(35, 6, 'Sisa Pembayaran', 0, 0);
$pdf->Cell(8, 6, 'Rp.', 1, 0);
$pdf->Cell(30, 6, number_format($hasil['sisa'], 0, ",", "."), 1, 1, 'R'); //end of line
$pdf->Ln(10);


//set font to arial, regular, 12pt
$pdf->SetFont('Arial', '', 10);
$currentdate = date("d-M-Y");
$pdf->Ln(5);
$pdf->Cell(138, 6, '', 0, 0);
$pdf->Cell(15, 6, 'Padang,', 0, 0);
$pdf->Cell(50, 6, $currentdate, 0, 1);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(35, 6, 'Jamaah', 0, 0, 'C');
$pdf->Cell(98, 6, '', 0, 0);
$pdf->Cell(30, 6, 'Admin', 0, 1, 'C');
$pdf->Ln(10);
$pdf->Cell(10, 6, '', 0, 0);
$pdf->Cell(35, 6, $hasil['nama_lengkap'], 0, 0, 'C');
$pdf->Cell(98, 6, '', 0, 0);
$pdf->Cell(30, 6, $admin['nama_lengkap'], 0, 1, 'C');

$pdf->Output("Kwitansi-Pembayaran.pdf", 'I');
