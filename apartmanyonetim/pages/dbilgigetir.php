<?php 
include '../connection.php';
if(isset($_POST['id'])) {
  $id= $_POST['id'];
    $bilgiGetir = $conn->prepare("Select * from tblucret where daireid=$id order by id desc");
    $bilgiGetir->execute();  
    if($bilgiGetir->rowCount()>0) { 
      $i=1;
      while($bilgiler = $bilgiGetir->fetch(PDO::FETCH_ASSOC)) {
        if($bilgiler['odendimi']==0) { $odendimi="Ödenmedi";} else {$odendimi="Ödendi";}
        if($bilgiler['kismi']==NULL) { $kismi="Ödeme Yok";} else {$kismi=$bilgiler['kismi'] . " TL";}
        echo 
         "<hr> <b>".  $i. ". Borç"."</b> <br />
              <b> Açıklama: </b> ".$bilgiler['aciklama']."<br />
              <b> Miktar:</b>" . $bilgiler['ucret']." TL <br />
              <b> Kısmi Ödeme:</b>" . $kismi."<br />
              <b>  Ödenme Durumu:</b>" . $odendimi."<br />
            <hr>";
      $i++;
      }
    }
    else {  
      echo "<script> $('#warningButton').click(); </script>";
    }
} else  {
      echo "<script> $('#warningButton').click(); </script>";
}

?>