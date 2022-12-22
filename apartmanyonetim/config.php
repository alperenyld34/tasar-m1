<?php include 'connection.php'; 
if(!isset($_SESSION)){
  session_start();
}
if($_SESSION['tc'] !=1){
  header('Location:pages/hesabim.php');
  session_destroy();
}
//Binadda oturanların sayısını alan sql kodları.
$binadaOturanlarQuery = $conn-> query("Select count(*) as 'sayi' From tbldaire where dolumu=1");
$binadaOturanlar = $binadaOturanlarQuery->fetch(PDO::FETCH_ASSOC);
//Ödemesi yapılan ücretlerin toplamını çeken sql kodları.
$bosDaireQuery = $conn-> query("Select count(*) as 'sayi' From tbldaire where dolumu=0");
$bosDaire = $bosDaireQuery->fetch(PDO::FETCH_ASSOC);
//Ödemesi yapılmayan ücretlerin toplamını çeken sql kodları.
$odemeToplamQuery = $conn-> query("Select sum(ucret) as 'ucret' from tblucret where odendimi=0");
$odemeToplam = $odemeToplamQuery->fetch(PDO::FETCH_ASSOC);
//Ödemesi yapılan ücretlerin toplamını çeken sql kodları.
$odenenMiktarQuery = $conn-> query("Select sum(ucret) as 'ucret' from tblucret where odendimi=1");
$odenenMiktar = $odenenMiktarQuery->fetch(PDO::FETCH_ASSOC);
//Ayrılanlardan kalan borçlar
$ayrilanBorcQuery = $conn-> query("Select sum(ucret) as 'ucret' from tblucret where odendimi=2");
$ayrilanBorc = $ayrilanBorcQuery->fetch(PDO::FETCH_ASSOC);
//Eklenen Borçlar
$borcQuery = $conn-> query("SELECT DISTINCT aciklama, sonodemetarihi,nereye FROM `tblucret` order by id desc LIMIT 8");
$enCokBorc = $conn->query("SELECT d.blokad, d.daireno, u.daireid,sum(u.ucret) as 'ucret' FROM tblucret u, tbldaire d where u.odendimi=0 and d.id = u.daireid GROUP BY u.daireid order by ucret desc LIMIT 7");
//duyurular
$duyuruQuery = $conn->query("Select * from tblduyuru order by id desc limit 5");


?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Site Yönetimi
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>
<body class="g-sidenav-show  bg-gray-200">
  <?php include 'adminsidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include 'adminnavbar.php'; ?>
    <!-- End Navbar -->
       <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">price_check</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Ödemesi Alınmayan</p>
                <h4 class="mb-0"><?php echo $odemeToplam['ucret']; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0">Şimdiye kadar alınmayan toplam ücret.</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">price_check</i>
              </div>
              <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Toplam alınan ücret</p>
              <h4 class="mb-0"><?php echo $odenenMiktar['ucret']; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0">Şimdiye kadar alınan topla ödeme.</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Ayrılanlardan Kalan Borç</p>
                <h4 class="mb-0"><?php echo $ayrilanBorc['ucret']; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0">Ayrılan Dairelerden Kalan Alacaklar.</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Sitede boş daireler</p>
              <h4 class="mb-0"><?php echo $bosDaire['sayi']; ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0">Sitede oturulmayan daireler.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">     
      </div>
      <div class="row mb-4">
        <div class="col-lg-6 col-md-12 mb-md-4 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-6">
                  <h6>Son Eklenen Ödemeler</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    Son eklenen<span class="font-weight-bold ms-1">8 </span> borç görüntülenir.
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Açıklama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nereye</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Son Ödeme Tarihi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($borc = $borcQuery->fetch(PDO::FETCH_ASSOC)) {  ?>
                    <tr>
                      <td>
                      <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $borc['aciklama'] ?></h6>
                          </div>
                        </div>
                        </div>
                      </td>
                      <td>
                      <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $borc['nereye']; ?></h6>
                          </div>
                        </div>
                      </td>
                      <td>
                      <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $borc['sonodemetarihi']; ?></h6>
                          </div>
                        </div>
                      </td>
                      <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 md-4 mb-4">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>En Çok Borcu Olanlar</h6>
            </div>
            <div class="card-body p-3">
              <?php $x=0;  while($cokborc = $enCokBorc->fetch(PDO::FETCH_ASSOC)) { ?>
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <?php if($x == 0 ) { ?>
                    <i class="material-icons text-danger text-gradient">credit_card</i>
                    <?php  } else if  ($x == 1 ) {  ?>
                    <i class="material-icons text-warning text-gradient">notifications</i>
                    <?php  } else if  ($x == 2 ) {  ?>
                    <i class="material-icons text-info text-gradient">code</i>
                    <?php  } else if  ($x == 3 ) {  ?>
                    <i class="material-icons text-success text-gradient">payments</i>
                    <?php  } else if  ($x >= 4 ) {  ?>
                    <i class="material-icons text-success text-gradient">notifications</i>
                    <?php  } ?>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo $cokborc['blokad']. " Blok " . $cokborc['daireno']. " Numara"; ?></h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo $cokborc['ucret']. " TL"; ?></p>
                  </div>
                </div>
            </div>
                <?php $x++; } ?>
              </div>
            </div>
            </div> 
            <div class="col-lg-3 col-md-6 md-4 mb-4">
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
            </div> 
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
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
  <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>