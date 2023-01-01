<?php 
require "../fpdf/fpdf.php";
include "../connection.php";


$id =$_GET['id']; 
$aciklama=$_GET['aciklama'];
$nereye= $_GET['nereye'];
$ucret = $_GET['ucret'];
$adsoyad = $_GET['adsoyad']; 
$tc = $_GET['tc'];

function turkce($k)
    {
        return iconv('utf-8','iso-8859-9',$k);
    }

date_default_timezone_set('Europe/Istanbul');

 $pdf = new FPDF();
 $pdf->AddPage ('L','A4'); 
 $pdf->AddFont('arial_tr','','arial_tr.php');
 $pdf->AddFont('arial_tr','B','arial_tr_bold.php');
 $pdf->SetFont('arial_tr','',18);
 $pdf->Cell(270,7,'Site Yonetim',0,1,'C');
 $pdf->SetFont('arial_tr','',13);
 $pdf->Cell (90, 7, turkce('Makbuz No:'), 1, 0, 'L'); 
 $pdf->Cell (45, 7, turkce($id), 1, 0, 'C'); 
 $pdf->Cell (45, 7, turkce('Tarih:'), 1, 0, 'L'); 
 $pdf->Cell (90, 7, date('d.m.Y'). " " .date('H:i'), 1, 1, 'C');
 $pdf->Line(10,37,280,37);
 $pdf->Ln(5);
 //Alt Sayfa Kısım
 $pdf->SetFont('arial_tr','',18);
 $pdf->Cell(270, 7, turkce('Ödeme Makbuzu'), 0, 1, 'C');
 $pdf->Ln(5);
 $pdf->SetFont('arial_tr','',13);
 //$pdf->Cell(150);
 $pdf->Cell (20, 7, turkce('Ödeme Tarihi:'), 0, 1, 'L');
 //$pdf->Cell(150);
 $pdf->Cell (20, 7,date('d.m.Y'), 0, 1, 'L');
 $pdf->Ln(3);
 $pdf->Cell (270, 14, turkce('Blok ve Daire No: '.  $nereye), 1, 1, 'L');   
 $pdf->Cell (200, 20, turkce('Ad Soyad: '. $adsoyad), 1, 0, 'L');
 $pdf->Cell (70, 20, turkce('TCKN: '.$tc), 1, 1, 'L');
 $pdf->Cell (270, 20, turkce('Ödenen Tutar: ' .$ucret . " TL"),1,1,'L');
 $pdf->MultiCell (270, 10, turkce('Açıklama: '.  $aciklama),1);
 //$pdf->Line(10,120,205,120);
 $pdf->Ln(2);
 $pdf->SetFont ('arial_tr', '', 13); 
 $pdf->Cell (5, 5, turkce('*Bu bilgilendirme makbuzu Site Yönetimi tarafından bilgilendirme amaçlı hazırlanmıştır.'), 0, 1, 'L');
 $pdf->Ln(2);
 $pdf->Cell (5,5, turkce('**Bu makbuzdaki veriler değiştirildiğinde ve/veya site yönetiminin kayıtlarıyla uyuşmadığı durumlarda site yönetimin kayıtları geçerlidir.'), 0, 1, 'L');
 $pdf->Output('makbuz.pdf','I');

?>