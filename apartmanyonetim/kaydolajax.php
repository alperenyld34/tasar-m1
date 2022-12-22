<?php 
include 'connection.php';

if($_POST['tc']!=NULL && $_POST['adsoyad']!=NULL && $_POST['sifre']!=NULL && $_POST['evsahibi']!=NULL && $_POST['adres']!=NULL && $_POST['blok']!=NULL && $_POST['daireno']!=NULL ) {
  if(!isset($_SESSION)) {
    session_start();
  }     
  $tc=$_POST['tc'];
  $adsoyad=$_POST['adsoyad'];
  $adres=ucwords($_POST['adres']);
  $tel=$_POST['tel'];
  $evsahibi = $_POST['evsahibi'];
  $sifre=$_POST['sifre'];
  $blok=$_POST['blok'];
  $daireno=$_POST['daireno'];
  $daireidal = $conn->query("select * from tbldaire where blokad='$blok' and daireno='$daireno'");
  $daireidfetch = $daireidal->fetch(PDO::FETCH_ASSOC);
  if($daireidfetch==0) {
    echo "<script> $('#evyokButton').click(); </script>";
  } else {
    $daireid = $daireidfetch['id'];
  
  $dairecheck = $conn->query("select * from tbldaire where blokad='$blok' and daireno='$daireno' and dolumu=1");
  $dairefetch = $dairecheck->fetch(PDO::FETCH_ASSOC);
  if($dairefetch>0) {
    echo "<script> $('#evdoluButton').click(); </script>";
  } else {
  $loginQuery = $conn->query("Select * from tblkullanici where tckimlikno='$tc'");
  $loginFetch = $loginQuery->fetch(PDO::FETCH_ASSOC);
  if($loginFetch>0) {
    echo "<script> $('#dikkatButton').click(); </script>";
  } 
  else {
   $conn->exec("insert into tblkullanici(`adsoyad`,`adres`,`tckimlikno`, `tel`, `evsahibi`, `sifre`, `daireid`) values ('$adsoyad','$adres','$tc','$tel','$evsahibi','$sifre',$daireid)");
   $conn->exec("update tbldaire set dolumu=1 where id=$daireid");
   echo "<script> $('#successButton').click(); </script>";
    }
  }
}
}
else {
  echo "<script> $('#dangerButton').click(); </script>";
}
?>