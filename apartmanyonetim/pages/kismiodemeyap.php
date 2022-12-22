<?php 
include '../connection.php';
if(isset($_POST['id'])) {
  $id= $_POST['id'];
  $ucret = $_POST['ucret'];
  $kQuery = $conn->query("select kismi,ucret from tblucret where id='$id'");
  $kismi = $kQuery->fetch(PDO::FETCH_ASSOC); 
  if($kismi['kismi']!=NULL)
  { $ucret = $ucret + $kismi['kismi']; 
    if($ucret<=$kismi['ucret']) {
      $odemeYap = $conn->prepare("update tblucret set kismi=$ucret where id='$id'");
      $odemeYap->execute();
      if($odemeYap->rowCount()>0) {
        echo "<script> $('#successButton').click(); </script>";
      }
      else {
        echo "<script> $('#dangerButton').click(); </script>";
      }
    }
    else{
      echo "<script> $('#warningButton').click(); </script>";
    }  
  }
  else {
      if($ucret<=$kismi['ucret']) {
      $odemeYap = $conn->prepare("update tblucret set kismi=$ucret where id='$id'");
      $odemeYap->execute();
        if($odemeYap->rowCount()>0) {
          echo "<script> $('#successButton').click(); </script>";
          }
        else {
          echo "<script> $('#warningButton').click(); </script>";
          }    
  }
}
 
}

?>