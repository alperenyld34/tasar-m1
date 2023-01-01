<?php

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
$mail->baslik = "Mail Deneme";
$mail->Body = "<p>Bu bir denemedir.</p>";

$mail->addAttachment("dosya.txt");

if ($mail->send())
    echo "Mail gonderimi basarili.";
else
    echo "Malesef olmadi.";


?>