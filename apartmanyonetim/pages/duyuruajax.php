<?php 
include '../connection.php';
if($_POST["baslik"] != NULL && $_POST["icerik"]!=NULL && $_POST["tip"]!=NULL) {
  $baslik=$_POST['baslik'];
  $icerik=$_POST['icerik'];
  $tip=$_POST['tip'];
  try {
    $conn->exec("INSERT INTO `tblduyuru`(`baslik`, `icerik`, `tip`) VALUES ('$baslik','$icerik','$tip')");
    echo "<script> $('#successButton').click(); </script>";
  }
    catch(PDOException $e) { 
      echo "<script> $('#warningButton').click(); </script>";
  }
}

?>