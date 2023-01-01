<?php 
include '../connection.php';
if(isset($_POST['id'])) {
  $id= $_POST['id'];
    $bilgiGetir = $conn->prepare("Select k.adsoyad, k.tckimlikno, k.yetki, k.adres, k.tel, k.evsahibi, d.daireno, d.blokad from tblkullanici k, tbldaire d where k.daireid=d.id and k.id=$id");
    $bilgiGetir->execute();  
    if($bilgiGetir->rowCount()>0) { 
      $bilgiler = $bilgiGetir->fetch(PDO::FETCH_ASSOC);
      echo  
     "<div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
        <div class=\"modal-header\">
      <h5 class=\"modal-title\" id=\"exampleModalLabel\">Seçilen kişinin bilgileri</h5>
       <button class=\"close\" type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\">
          <span aria-hidden=\"true\">×</span>
      </button>
      </div>
      <div class=\"modal-body\">

        TC Kimlik No: " .$bilgiler['tckimlikno']. " <br />
        Onay Durumu: " .$bilgiler['yetki']. " <br />
        Adı Soyadı: " .$bilgiler['adsoyad']. "  <br />
        Adresi: " .$bilgiler['adres']. "  <br />
        Telefonu: 0" .$bilgiler['tel']. " <br />
        Durumu: " .$bilgiler['evsahibi']. " <br />
        Dairesi: "  .$bilgiler['blokad']. " Blok ". $bilgiler['daireno']. " Numara <br />
      
      </div>
      <div class=\"modal-footer\">
        <button class=\"btn btn-success\" type=\"button\" id=\"exit\"  data-dismiss=\"modal\">Kapat</button>
      </div>
    </div>
    </div>";  
    }
    else {
      echo "<script> $('#warningButton').click(); </script>";
    }
} else  {
      echo "<script> $('#warningButton').click(); </script>";
}

?>

