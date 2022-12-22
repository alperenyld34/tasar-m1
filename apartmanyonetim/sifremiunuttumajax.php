<?php 
include 'connection.php';

if($_POST['tc']!=NULL &&  $_POST['tc']!=NULL && $_POST['sifre']!=NULL && $_POST['blok']!=NULL && $_POST['daireno']!=NULL ) {
  if(!isset($_SESSION)) {
    session_start();
  }    
  $tc=$_POST['tc'];
  $tel=$_POST['tel'];
  $sifre=$_POST['sifre'];
  $blok=$_POST['blok'];
  $daireno=$_POST['daireno'];

  $daireidal = $conn->query("select * from tbldaire where blokad='$blok' and daireno='$daireno'");
  $daireidfetch = $daireidal->fetch(PDO::FETCH_ASSOC);
  if($daireidfetch==0) {
    echo "<script> $('#evyokButton').click(); </script>";
  } else {
  $daireid = $daireidfetch['id'];
  $kontrol = $conn->query("select * from tblkullanici where daireid='$daireid' and tckimlikno='$tc' and tel='$tel'");
  $kontrolFetch = $kontrol->fetch(PDO::FETCH_ASSOC);
   if($kontrolFetch>0 && $kontrolFetch['tckimlikno']==$tc && $kontrolFetch['tel']==$tel) {
    $conn->exec("update tblkullanici set sifre='$sifre' where daireid='$daireid'");
    echo "<script> $('#successButton').click(); </script>";
  } else {
    echo "<script> $('#dikkatButton').click(); </script>";
  }
  }
}

?>
