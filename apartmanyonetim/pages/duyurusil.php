<?php 
include '../connection.php'; 
$id= $_POST['id'];
    try {
      $conn->exec("delete from tblduyuru where id=$id");
      echo "<script> $('#successButton').click(); </script>";
    }
      catch(PDOException $e) { 
        echo "<script> $('#warningButton').click(); </script>";
    }
  
?>