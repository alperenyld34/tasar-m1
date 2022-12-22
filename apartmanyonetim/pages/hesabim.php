<!DOCTYPE html>
<html lang="tr">
<?php
include '../connection.php';
if(!isset($_SESSION)) 
    { 
      session_start(); 
    } 
 $id = $_SESSION['tc'];
 $verilerQuery = $conn->query("select k.tckimlikno, k.adsoyad, d.blokad, d.daireno, d.id from tblkullanici k,tbldaire d where k.tckimlikno='$id' and k.daireid=d.id");
 $veriler = $verilerQuery->fetch(PDO::FETCH_ASSOC);
 $daireid = $veriler['id']; 
 //Ödenen Borçlar toplamı
 $odenenBorclarQuery = $conn->query("select sum(ucret) as 'ucret' from tblucret where odendimi=1 and daireid=$daireid");
 $odenenBorclar = $odenenBorclarQuery->fetch(PDO::FETCH_ASSOC);
  //Ödenmeyen Borçlar toplamı
 $odenmeyenBorclarQuery = $conn->query("select sum(ucret) as 'ucret' from tblucret where odendimi=0 and daireid=$daireid");
 $odenmeyenBorclar = $odenmeyenBorclarQuery->fetch(PDO::FETCH_ASSOC);
//ödenen borçların listesi
 $borclar = $conn->query("Select * from tblucret where daireid=$daireid and odendimi=0");
 //ödenmeyen borçların listesi
 $odenecekBorclar = $conn->query("Select * from tblucret where daireid=$daireid and (odendimi=1 or kismi>0) order by id desc LIMIT 5");
 //dairenin son eklenen borçları
 $sonIkiBorcQuery = $conn->query("Select * from tblucret where daireid=$daireid order by id desc LIMIT 2");
 $duyuruQuery = $conn->query("Select * from tblduyuru order by id desc limit 5");
?>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Site Yönetimi
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.1" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'adminsidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include 'adminnavbar.php'; ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-xl-6 mb-xl-0 mb-4">
              <div class="card bg-transparent shadow-xl">
                <div class="overflow-hidden position-relative border-radius-xl">
                  <img src="../assets/img/illustrations/pattern-tree.svg" class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                  <span class="mask bg-gradient-dark opacity-10"></span>
                  <div class="card-body position-relative z-index-1 p-3">
                    <i class="material-icons text-white p-2">person </i>
                    <h5 class="text-white mt-4 mb-5 pb-2"> Hoş Geldiniz</h5>
                    <div class="d-flex">
                      <div class="d-flex">
                        <div class="me-4">
                          <p class="text-white text-sm opacity-8 mb-0">Ad Soyad</p>
                          <h6 class="text-white mb-0"><?php echo mb_strtoupper($veriler['adsoyad'],"UTF-8"); ?></h6>
                        </div>
                        <div>
                          <p class="text-white text-sm opacity-8 mb-0">Blok/Numara</p>
                          <h6 class="text-white mb-0"><?php echo $veriler['blokad']. " Blok " . $veriler['daireno']. " Numara"  ?></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="row">
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="material-icons opacity-10">account_balance</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Ödedikleriniz</h6>
                      <span class="text-xs">Şimdiye Kadar Ödemeleriniz</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0"><?php 
                      if($odenenBorclar['ucret']>0) {
                        echo "<span class=\"text-success\">" .$odenenBorclar['ucret'] ." </span>";
                      } else {
                        echo  "<span class=\"text-danger\"> Ödemeniz yoktur. </span>";
                      }
                         ?></h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="material-icons opacity-10">account_balance_wallet</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Ödemedikleriniz</h6>
                      <span class="text-xs">Ödemesi Bekleyen Borçlarınız</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0"><?php 
                      if($odenmeyenBorclar['ucret']>0) {
                        echo  "<span class=\"text-danger\"> ". $odenmeyenBorclar['ucret']." </span>";
                      } else {
                        echo  "<span class=\"text-success\"> Borcunuz yoktur. </span>";
                      }
                      ?></h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header pb-0">
            <h6><i class="material-icons text-dark text-gradient">campaign</i> Duyurular</h6>
            </div>
            <div class="card-body p-3">
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <?php while($duyuru=$duyuruQuery->fetch(PDO::FETCH_ASSOC)) {  ?>
                  <span class="timeline-step">
                    <i class="material-icons text-<?php echo $duyuru['tip']; ?> text-gradient">notifications</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo $duyuru['baslik']; ?></h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo $duyuru['icerik']; ?></p>
                  </div>
                  <?php } ?>
                </div>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Bekleyen Ödemeleriniz</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <?php while($borc = $borclar->fetch(PDO::FETCH_ASSOC)) { ?>
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">Site Ödemesi     <?php  $tarih = date('Y-m-d');
                    $interval= (strtotime($borc['sonodemetarihi'])-strtotime($tarih))/86400;
                    if($interval>0) {
                      echo "<span class=\"badge badge-sm bg-gradient-info\">" . $interval . " Gün Kaldı.</span>"; 
                    } else if ($interval==0) {
                      echo "<span class=\"badge badge-sm bg-gradient-warning\">Bugün Son Gün Lütfen Ödemenizi Yapınız.</span>"; 
                    } else if($interval<0) {
                      echo "<span class=\"badge badge-sm bg-gradient-danger\">" . -$interval . " Gün Geçti. Lütfen Ödemenizi Yapınız.</span>"; 
                    }
                     ?></h6>
                    <span class="mb-2 text-xs">Borç Açıklaması: <span class="text-dark font-weight-bold ms-sm-2"><?php echo $borc['aciklama']; ?></span></span>
                    <span class="mb-2 text-xs">Ücreti: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $borc['ucret'] . " TL"; ?></span></span>
                    <span class="mb-2 text-xs">Kısmi Ödemeleriniz: <span class="text-dark ms-sm-2 font-weight-bold"><?php if($borc['kismi']!=NULL) {echo $borc['kismi'] . " TL   "; } else {echo "Yoktur";}?></span><?php if($borc['kismi']==$borc['ucret']) {echo "<span class=\"badge badge-sm bg-gradient-danger\">Onay Bekliyor</span>";}?></span> 
                    <span class="text-xs">Son Ödeme Tarihi: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $borc['sonodemetarihi']; ?></span></span>
                  </div>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-5 mt-4">
          <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Yaptığınız Ödemeler</h6>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Son 5 ödemeniz gösterilir.  <i class="material-icons text-danger p-2">warning </i><span class="text-danger"> Makbuz Almak İçin Ödemeler Sayfasına Gidiniz. </span></h6>
              <ul class="list-group">
                <?php while($odencekBorc = $odenecekBorclar->fetch(PDO::FETCH_ASSOC)) {
                  if($odencekBorc['odendimi']==1) { ?>
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">price_check</i></button>  
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm"><?php echo $odencekBorc['aciklama'];?></h6> 
                      <span class="text-xs"><?php echo $odencekBorc['sonodemetarihi']; ?></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-info text-gradient text-sm font-weight-bold">
                    <?php echo $odencekBorc['ucret']." TL"; ?>
                  </div>
                </li>
                <?php } else { ?>
                  <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">price_check</i></button>
                    <div class="d-flex flex-column">
                      <h6 class="mb-1 text-dark text-sm"><?php echo $odencekBorc['aciklama']. "    ";  ?><?php if($odencekBorc['kismi']==$odencekBorc['ucret']) {echo "<span class=\"badge badge-sm bg-gradient-danger\">Onay Bekliyor</span>";} ?></h6>
                      <span class="text-xs"><?php echo $odencekBorc['sonodemetarihi']; ?></span>
                      <span class="text-xs"><?php echo $odencekBorc['ucret'] . " TL borçtan."; ?></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                    <?php echo $odencekBorc['kismi']." TL (Kısmi Ödeme)"; ?>
                  </div>
                </li>
              <?php } ?>
            <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.1"></script>
</body>

</html>