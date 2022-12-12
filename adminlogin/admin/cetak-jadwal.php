<?php
//menyertakan file fpdf, file fpdf.php di dalam folder FPDF yang diekstrak
session_start();
if(!isset($_SESSION["username"])) header("Location: ../login");
include "fpdf/fpdf.php";
include 'config/app.php';

$id_user = $_SESSION['id_user'];

$ambiladmin = "SELECT * FROM admin WHERE id_user = $id_user";
$sql_admin = mysqli_query($kon, $ambiladmin);
$admin = mysqli_fetch_array($sql_admin);

//membuat objek baru bernama pdf dari class FPDF
//dan melakukan setting kertas l : landscape, A5 : ukuran kertas
$pdf = new FPDF('L','mm','A4');
// membuat halaman baru
$pdf->AddPage();

// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->image('assets/img/logo3.png',50,8,17);
$pdf->SetFont('Arial','B',24);
// judul
$pdf->Cell(290,7,'PT. ALBADRIYAH WISATA PADANG',0,1,'C');
$pdf->SetFont('Arial','',13);
$pdf->Cell(290,7,'Jalan Profesor Dr. Hamka No. 61 Simpang GIA Kelurahan Parupuk Tabing',0,1,'C');
$pdf->Cell(290,2,'Kec. Koto Tangah, Kota Padang Sumatera Barat',0,1,'C');

$pdf->SetlineWidth(1);
$pdf->Line(10,34,286,34);
$pdf->SetlineWidth(0);
$pdf->Line(10,35,286,35);
$pdf->Ln(20);
$pdf->SetFont('Arial','U',15);
$pdf->Cell(290,7,'LAPORAN JADWAL KEBERANGKATAN',0,1,'C');
$pdf->Ln(7);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(10,9,'No.',1,0,'C',0,'C');
$pdf->Cell(45,9,'Tgl. Keberangkatan',1,0,'C');
$pdf->Cell(40,9,'Tgl. Kepulangan',1,0,'C');
$pdf->Cell(35,9,'Nama Paket',1,0,'C');
$pdf->Cell(60,9,'Pesawat',1,0,'C');
$pdf->Cell(40,9,'No. Pesawat',1,0,'C');
$pdf->Cell(47,9,'Jumlah Jamaah',1,1,'C');

$pdf->SetFont('Arial','',13);
$currentdate = date("d-M-Y");
$no = 1;

$data_jadwal = "SELECT * FROM jadwal
INNER JOIN paket ON jadwal.id_paket = paket.id_paket
ORDER BY id_jadwal
";
$sql_rm = mysqli_query($kon, $data_jadwal) or die(mysqli_error($kon));
while ($hasil = mysqli_fetch_array($sql_rm)){
    $pdf->Cell(10,9,$no++,1,0,'C');
    $pdf->Cell(45,9,date('d-M-Y', strtotime($hasil['tanggal_keberangkatan'])),1,0,'C');
    $pdf->Cell(40,9,date('d-M-Y', strtotime($hasil['tanggal_kepulangan'])),1,0,'C');
    $pdf->Cell(35,9,$hasil['nama_paket'],1,0,'C');
    $pdf->Cell(60,9,$hasil['pesawat'],1,0,'C');
    $pdf->Cell(40,9,$hasil['nopesawat'],1,0,'C');
    $pdf->Cell(47,9,$hasil['kuota_pendaftaran'],1,1,'C');
    
}

$pdf->Ln(15);
$pdf->SetFont('Arial','',13);
$pdf->Cell(200	,5,'',0,0);
$pdf->Cell(50	,5,'Padang,',0,0,'C');
$pdf->Cell(1	,5,$currentdate,0,0,'C');
$pdf->Ln(7);
$pdf->Cell(200	,5,'',0,0);
$pdf->Cell(80	,5,'Admin',0,0,'C');
$pdf->Ln(20);
$pdf->Cell(200	,5,'',0,0);
$pdf->Cell(80	,5,$admin['nama_lengkap'],0,0,'C');

$pdf->Output("Laporan-Jadwal-Keberangakatan.pdf", 'I');


?>