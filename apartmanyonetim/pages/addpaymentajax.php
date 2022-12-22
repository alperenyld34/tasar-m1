<?php 
include '../connection.php';

if($_POST["ucret"] != NULL && $_POST["aciklama"]!=NULL && $_POST["date"]!=NULL)  {
$ucret = $_POST["ucret"];
$aciklama = $_POST["aciklama"];
$date = $_POST["date"];

$daireCountQuery = $conn->prepare("Select count(*) From tbldaire");
$daireCountQuery->execute();
$daireCount = $daireCountQuery->fetchColumn();
$totalUcret = $ucret/$daireCount; 

try {
  $conn->beginTransaction();
  $dairelerQuery = $conn-> query("Select id From tbldaire");
  while($daireler = $dairelerQuery->fetch(PDO::FETCH_ASSOC)) {
  $count = $daireler['id'];
  $conn->exec("INSERT INTO `tblucret`(`ucret`, `daireid`, `aciklama`, `odendimi`,`nereye`, `sonodemetarihi`) VALUES ('$totalUcret','$count','$aciklama','0','Tüm Dairelere','$date')");
  }
  $conn->commit();
  echo "<script> $('#successButton').click(); </script>";
}
  catch(PDOException $e) { 
    $conn->rollback();
    echo "<script> $('#warningButton').click(); </script>";
}
}
else {
  echo "<script> $('#dangerButton').click(); </script>";

}

?>