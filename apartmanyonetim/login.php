<?php 
include 'connection.php';

if($_POST['tc']!=NULL && $_POST['sifre']!=NULL) {
  session_start();
  $tc=$_POST['tc'];
  $sifre=$_POST['sifre'];
  $loginQuery = $conn->query("Select * from tblkullanici where tckimlikno='$tc' and sifre='$sifre'");
  $loginFetch = $loginQuery->fetch(PDO::FETCH_ASSOC);
  if($loginFetch>0) {
    $_SESSION['ad'] = $loginFetch['adsoyad'];
    $_SESSION['id'] = $loginFetch['id'];
    $_SESSION['tc'] = $loginFetch['tckimlikno'];
    if( $_SESSION['tc'] == 1) {
      echo "anasayfa.php";
    }
    else {
      echo "pages/hesabim.php";
    }
  } 
  else {
   echo "<script> $('#warningButton').click(); </script>";
  }

}
else {
  echo "<script> $('#dangerButton').click(); </script>";
}
?>