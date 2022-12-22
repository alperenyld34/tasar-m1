<?php 
include '../connection.php'; 
$id= $_POST['id'];
$odemelerQuery = $conn->query("SELECT DISTINCT aciklama, sonodemetarihi,nereye FROM `tblucret` order by id desc");
$i = 0;
while($odemeler = $odemelerQuery->fetch(PDO::FETCH_ASSOC)) {
if($i == $id) {
  $aciklama = $odemeler['aciklama'];
  $sonodemetarihi = $odemeler['sonodemetarihi'];
  $nereye = $odemeler['nereye'];
} 
$i++;
}

  $odemesil = $conn->prepare("delete from tblucret where aciklama='$aciklama' and sonodemetarihi='$sonodemetarihi' and nereye='$nereye'");
  $odemesil->execute();
  if($odemesil->rowCount()>0) {
    echo "<script> $('#successButton').click(); </script>";
  }
  else {
    echo "<script> $('#warningButton').click(); </script>";
  }
  
?>