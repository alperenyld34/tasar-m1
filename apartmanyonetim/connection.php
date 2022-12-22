<?php 
 $dbuser = 'root'; //Kullanıcı Adı
 $dbpass = '';    //Şifre
 
 $conn = new PDO('mysql:host=localhost;dbname=dbsiteyonetim',$dbuser,$dbpass);
 $conn->exec("set names utf8");
 if(! $conn ) {               //Bağlantı Sağlanamazsa
  die('Could not connect: ' . mysqli_error()); //Ekrana Mesaj Ver
}

?>