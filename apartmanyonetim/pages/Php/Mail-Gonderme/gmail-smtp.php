<?php 
$baslik = $_GET['baslik'];
$icerik = $_GET['icerik'];
$tip = $_GET['tip'];

if ($tip == "danger") {
$tip="ACİL";    
} else if ($tip == "warning"){
    $tip="ÖNEMLİ";
} else if ($tip == "info"){
    $tip="BİLGİLENDİRME";
} else if ($tip == "success"){
    $tip="BASİT";
}else {
    $tip="Durum Belirtilmemiş.";
}




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();


$mail->isSMTP();
$mail->SMTPKeepAlive = true;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //ssl

$mail->Port = 587; //25 , 465 , 587
$mail->Host = "smtp.gmail.com";

$mail->Username = "yalperenyld@gmail.com";
$mail->Password = "xxbdmpagfiygqaqc";
/* deryabayhal20@gmail.com:ikra#*.01 */

$mail->setFrom("yalperenyld@gmail.com");
$mail->addAddress("alperenyld@gmail.com");


$mail->isHTML(true);
$mail->Subject =  $baslik;
$mail->Body = 'Uyarı Tipi: '.$tip.'<br><hr>'.$icerik;


if ($mail->send())

   echo "<script> $('#successButton').click(); </script>";
else
    echo "Malesef olmadi.";


?>