<?php 
include '../connection.php'; 
$id= $_POST['id'];
  $evquery = $conn->query("Select id from tblkullanici where daireid=$id");
  $ev = $evquery->fetch(PDO::FETCH_ASSOC);
  $evBorc = $ev['id'];
  $borcTopla = $conn->query("Select sum(ucret) as 'ucret' from tblucret where odendimi=0 and daireid=$id");
  $borc = $borcTopla->fetch(PDO::FETCH_ASSOC);
  $toplanacakborc = $borc['ucret'];
  $daireSil = $conn->prepare("delete from tblkullanici where daireid=$id");
  $daireSil->execute();
  if($daireSil->rowCount()>0) { 
    $conn->exec("update tbldaire set dolumu='0' where id=$id");
    $conn->exec("update tblpasif set kalanborc='$toplanacakborc' where kullaniciid=$evBorc");
    echo "<script> $('#successButton').click(); </script>";
  }
  else {
    echo "<script> $('#warningButton').click(); </script>";
  }
  
?>