<?php 

//error_log(0);

$host="localhost"; 
$veritabani_ismi="daire-id";
$kullanici_adi="root"; 
$sifre=""; 

try {
	$db=new PDO("mysql:host=$host;dbname=$veritabani_ismi;charset=utf8",$kullanici_adi,$sifre);
	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOExpception $e) {
	echo $e->getMessage();
}

?>
