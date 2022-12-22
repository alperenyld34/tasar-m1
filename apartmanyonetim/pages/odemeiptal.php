<?php 
include '../connection.php';
if(isset($_POST['id'])) {
  $id= $_POST['id'];
    $odemeYap = $conn->prepare("update tblucret set odendimi=0 where id='$id'");
    $odemeYap->execute();
    if($odemeYap->rowCount()>0) {
      echo "<script> $('#successButton').click(); </script>";
    }
    else {
      echo "<script> $('#warningButton').click(); </script>";
    }
} else  {
      echo "<script> $('#warningButton').click(); </script>";
}

?>