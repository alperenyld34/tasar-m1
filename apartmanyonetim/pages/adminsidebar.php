<?php  

$url= 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if($_SESSION['tc'] == 1) {
 ?>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" ../index.php" target="_self">
        <span class="ms-1 font-weight-bold text-white" style="font-size:18px;"> <i class="material-icons opacity-10" style="font-size:30px;">apartment</i> Site Yönetim</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 ps ps--scrolling-y" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"anasayfa")){echo "active bg-gradient-primary";} ?>" href="../anasayfa.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Ana Sayfa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"oturanlar")){echo "active bg-gradient-primary";} ?>" href="oturanlar.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">maps_home_work</i>
            </div>
            <span class="nav-link-text ms-1">Dairelerde Oturanlar</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"odemeyapmayanlar")){echo "active bg-gradient-primary";} ?>" href="odemeyapmayanlar.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">block</i>
            </div>
            <span class="nav-link-text ms-1">Ödeme Yapmayanlar</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"yapilan")){echo "active bg-gradient-primary";} ?>" href="yapilanodeme.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">price_check</i>
            </div>
            <span class="nav-link-text ms-1">Yapılan Ödemeler</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"ayrilanlar")){echo "active bg-gradient-primary";} ?>" href="ayrilanlar.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">airport_shuttle</i>
            </div>
            <span class="nav-link-text ms-1">Ayrılanlar</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Ödemeler</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"tumdairelere")){echo "active bg-gradient-primary";} ?>" href="tumdairelereodemeekle.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Tüm Dairelere Ödeme Ekle</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"tekblok")){echo "active bg-gradient-primary";} ?>" href="tekblokodemeekle.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Tek Blok Ödeme Ekle</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"tekdaire")){echo "active bg-gradient-primary";} ?>" href="tekdaireodemeekle.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Tek Daire Ödeme Ekle</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"odemeler")){echo "active bg-gradient-primary";} ?>" href="odemeler.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">price_check</i>
            </div>
            <span class="nav-link-text ms-1">Tüm Ödemeler</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <?php } else { ?>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" ../index.php" target="_self">
        <span class="ms-1 font-weight-bold text-white" style="font-size:18px;"> <i class="material-icons opacity-10" style="font-size:30px;">apartment</i> Site Yönetim</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"hesabim")){echo "active bg-gradient-primary";} ?>" href="hesabim.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1"> Hesabım </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"odemelerim")){echo "active bg-gradient-primary";} ?>" href="odemelerim.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">price_check</i>
            </div>
            <span class="nav-link-text ms-1"> Ödemelerim </span>
          </a>
        </li>
        <li class="nav-item">
      <a class="nav-link text-white <?php if(strstr($url,"duyurular")){echo "active bg-gradient-primary";} ?>" href="duyurular.php">
        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
          <i class="material-icons opacity-10">campaign</i>
        </div>
        <span class="nav-link-text ms-1">Tüm Duyurular</span>
      </a>
    </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if(strstr($url,"sifre")){echo "active bg-gradient-primary";} ?>" href="sifredegistir.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">password</i>
            </div>
            <span class="nav-link-text ms-1">Şifre Değiştir</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10 text-success">whatsapp</i>
            </div>
            <span class="nav-link-text ms-1">Yöneticiye Yazın</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <?php } ?>