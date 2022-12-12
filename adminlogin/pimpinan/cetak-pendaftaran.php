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
$pdf = new FPDF('L','mm','legal');
// membuat halaman baru
$pdf->AddPage();

// menyetel font yang digunakan, font yang digunakan adalah arial, bold dengan ukuran 16
$pdf->image('assets/img/logo3.png',85,8,17);
$pdf->SetFont('Arial','B',24);
// judul
$pdf->Cell(350,7,'PT. ALBADRIYAH WISATA PADANG',0,1,'C');
$pdf->SetFont('Arial','',13);
$pdf->Cell(350,7,'Jalan Profesor Dr. Hamka No. 61 Simpang GIA Kelurahan Parupuk Tabing',0,1,'C');
$pdf->Cell(350,2,'Kec. Koto Tangah, Kota Padang Sumatera Barat',0,1,'C');

$pdf->SetlineWidth(1);
$pdf->Line(10,34,345,34);
$pdf->SetlineWidth(0);
$pdf->Line(10,35,345,35);
$pdf->Ln(20);
$pdf->SetFont('Arial','U',13);
$pdf->Cell(350,7,'LAPORAN PENDAFTARAN JEMAAH HAJI DAN UMRAH',0,1,'C');
$pdf->Ln(7);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No.',1,0,'C',0);
$pdf->Cell(28,6,'No. Registrasi',1,0);
$pdf->Cell(35,6,'Nik',1,0);
$pdf->Cell(35,6,'Nama Jamaah',1,0);
$pdf->Cell(35,6,'Tempat Lahir',1,0);
$pdf->Cell(30,6,'Tanggal Lahir',1,0);
$pdf->Cell(20,6,'Jekel',1,0);
$pdf->Cell(28,6,'No. Hp',1,0);
$pdf->Cell(110,6,'Alamat',1,1);

$pdf->SetFont('Arial','',10);
$currentdate = date("d-M-Y");
//koneksi ke database
$mysqli = new mysqli("localhost","root","","db_albadriyah");
$no = 1;
$tampil = mysqli_query($mysqli, "select * from pendaftaran");
while ($hasil = mysqli_fetch_array($tampil)){
    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(28,6,$hasil['no_registrasi'],1,0);
    $pdf->Cell(35,6,$hasil['nik'],1,0);
    $pdf->Cell(35,6,$hasil['nama_lengkap'],1,0);
    $pdf->Cell(35,6,$hasil['tempat_lahir'],1,0); 
    $pdf->Cell(30,6,date('d-M-Y', strtotime($hasil['tanggal_lahir'])),1,0); 
    $pdf->Cell(20,6,$hasil['jk'],1,0);
    $pdf->Cell(28,6,$hasil['no_hp'],1,0);  
    $pdf->Cell(110,6,$hasil['alamat'],1,1);  
}

$pdf->SetFont('Arial','',13);
$pdf->Ln(10);
$pdf->Cell(250	,5,'',0,0);
$pdf->Cell(50	,5,'Padang,',0,0,'C');
$pdf->Cell(1	,5,$currentdate,0,0,'C');
$pdf->Ln(7);
$pdf->Cell(250	,5,'',0,0);
$pdf->Cell(80	,5,'Pimpinan',0,0,'C');
$pdf->Ln(20);
$pdf->Cell(250	,5,'',0,0);
$pdf->Cell(80	,5,$admin['nama_lengkap'],0,0,'C');

$pdf->Output("Laporan-Pendaftaran.pdf", 'I');


?>