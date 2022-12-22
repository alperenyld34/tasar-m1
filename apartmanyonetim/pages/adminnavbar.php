<?php 
if(!isset($_SESSION)) {
  session_start();
}
$adsoyad = $_SESSION['ad'];
?>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-right">
            <div class="input-group input-group-outline">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-right">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?php echo $adsoyad; ?></span>
              </a>
            </li> 
            <?php if($_SESSION['tc']==1) { echo 
          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class=\"nav-item d-flex align-items-center\">
             <a class=\"nav-link text-body font-weight-bold px-0\" href=\"duyurular.php\">
              <i class=\"fa fa-bullhorn me-sm-1 text-warning\"></i>
            <span class=\"d-sm-inline d-none text-warning\">Duyurular</span>
          </a>
        </li>";
           } ?>
              <?php if($_SESSION['tc']==1) { echo 
          "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class=\"nav-item d-flex align-items-center\">
             <a class=\"nav-link text-body font-weight-bold px-0\" href=\"duyuruekle.php\">
              <i class=\"fa fa-bullhorn me-sm-1 text-info\"></i>
            <span class=\"d-sm-inline d-none text-info\">Duyuru Ekle</span>
          </a>
        </li>";
           } ?>
            </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item d-flex align-items-center">
             <a class="nav-link text-body font-weight-bold px-0" href="sifredegistir.php">
              <i class="fa fa-key me-sm-1 text-success"></i>
            <span class="d-sm-inline d-none text-success">Bilgileri Değiştir</span>
          </a>
        </li>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item d-flex align-items-center">
             <a class="nav-link text-body font-weight-bold px-0" href="cikis.php">
              <i class="fa fa-user me-sm-1 text-danger"></i>
            <span class="d-sm-inline d-none text-danger">Çıkış</span>
          </a>
        </li>
          </ul>
        </div>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
      </div>
    </nav>