<?php 
include '../connection.php';
if(!isset($_SESSION)) {
  session_start();
}
if($_POST["tel"] != NULL && $_POST["tc"]!=NULL && $_POST["adsoyad"]!=NULL  && $_POST["sifre"]!=NULL && $_POST["evsahibi"]!=NULL)  {
  $eskitc = $_SESSION['tc'];
  $evsahibi = $_POST['evsahibi'];
  $tel =  $_POST['tel'];
  $tc = $_POST['tc'];
  $adsoyad = $_POST['adsoyad'];
  $sifre = $_POST['sifre'];

  try {
    $conn->exec("UPDATE `tblkullanici` SET tckimlikno='$tc', tel='$tel', adsoyad='$adsoyad',evsahibi='$evsahibi', sifre='$sifre' where tckimlikno='$eskitc'");
    echo "../index.php";
  }
    catch(PDOException $e) { 
      echo "<script> $('#warningButton').click(); </script>";
  }
  }
  else {
    echo "<script> $('#dangerButton').click(); </script>";
  }

?>