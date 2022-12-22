<?php 
include '../connection.php';

if($_POST["ucret"] != NULL && $_POST["aciklama"]!=NULL && $_POST["date"]!=NULL && $_POST["blok"]!=NULL && $_POST["daireno"]!=NULL)  {
$ucret = $_POST["ucret"];
$aciklama = $_POST["aciklama"];
$date = $_POST["date"];
$blok = $_POST["blok"];
$daireno = $_POST["daireno"];
$dairesql = $blok." Blok " . $daireno . " Numara";

$dairenumara = $conn->prepare("Select id From tbldaire where blokad='$blok' and daireno='$daireno'");
$dairenumara->execute();
while($daireler = $dairenumara->fetch(PDO::FETCH_ASSOC)) {
  $daire = $daireler["id"];
}

try {
  $conn->exec("INSERT INTO `tblucret`(`ucret`, `daireid`, `aciklama`, `odendimi`,`nereye`, `sonodemetarihi`) VALUES ('$ucret','$daire','$aciklama','0','$dairesql','$date')");
  echo "<script> $('#successButton').click(); </script>";
}
  catch(PDOException $e) { 
    echo "<script> $('#warningButton').click(); </script>";
}
}
else {
  echo "<script> $('#dangerButton').click(); </script>";
}
?>