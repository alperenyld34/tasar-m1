<!DOCTYPE html>
<?php
include '../connection.php';
if (!isset($_SESSION)) {
  session_start();
}
if ($_SESSION['tc'] != 1) {
  header('Location:../index.php');
  session_destroy();
}
$daireSakinleriQuery = $conn->query("Select * from tbldaire order by blokad, daireno asc");
?>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Site Yönetimi
  </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-info shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Dairelerde Oturanlar </h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kat Maliği</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TC Kimlik No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Onay Durumu</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cep Telefonu</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Toplam Borç</th>
                      <th class="text-center text-uppercase text-danger text-xxs font-weight-bolder opacity-7"> Taşındı/Ayrıldı </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($daireSakinleri = $daireSakinleriQuery->fetch(PDO::FETCH_ASSOC)) {
                      $borc = $daireSakinleri['id'];
                      //if($daireSakinleri['adsoyad']=="Yönetici") {continue;}
                    ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php
                                                        if ($daireSakinleri['dolumu'] == 1) {
                                                          $oturanlar = $conn->query("select * from tblkullanici where daireid=$borc");
                                                          $oturanlarAd = $oturanlar->fetch(PDO::FETCH_ASSOC);
                                                          echo "<a href=\"javascript:bilgiGetir(" . $oturanlarAd['id'] . ")\">" . $oturanlarAd['adsoyad'] . "</a>";
                                                        ?>
                                  <button id="ac" class="btn btn-danger" data-toggle="modal" data-target="#bilgi" style="display:none;"></button>
                                <?php } else {
                                                          echo "Ev Sahibi";
                                                        }

                                ?>
                              </h6>
                              <a href="javascript:dairebilgiGetir(<?php echo $daireSakinleri['id']; ?>)">
                                <p class="text-xs text-secondary mb-0">
                                  <?php if ($daireSakinleri['dolumu'] == 1) {
                                    echo $daireSakinleri['blokad'] . " Blok " . $daireSakinleri['daireno'] . " Numara" . " Durum: " . $oturanlarAd['evsahibi'];
                                  } else {
                                    echo $daireSakinleri['blokad'] . " Blok " . $daireSakinleri['daireno'] . " Numara" . " Durum: Daire Boş";
                                  }  ?>
                                </p>
                              </a>
                              <button class="btn btn-danger" id="dairebilgiac" data-toggle="modal" data-target="#daireblg" style="display:none;"></button>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-warning"><?php if ($daireSakinleri['dolumu'] == 1) {
                                                                              echo $oturanlarAd['tckimlikno'];
                                                                            } else  echo "Oturan Yok"; ?></span>
                        </td>
                        
                        <td class="align-middle text-center text-sm">
                          <?php if ($daireSakinleri['dolumu'] == 1) {
                                                                              if ($oturanlarAd['yetki'] == 1){
                                                                                echo "<span class='badge badge-sm bg-gradient-success'>ONAYLI</span>";
                                                                              } else {
                                                                                echo "<span class='badge badge-sm bg-gradient-danger'>ONAYSIZ</span>";
                                                                              }
                                                                            } else  echo "<span class='badge badge-sm bg-gradient-warning'>Oturan Yok</span>"; ?>
                        </td>


                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-info"><?php if ($daireSakinleri['dolumu'] == 1) {
                                                                          $arr = str_split($oturanlarAd['tel']);
                                                                          if (count($arr) == 10) {
                                                                            echo "0" . $arr[0] . $arr[1] . $arr[2] . " " . $arr[3] . $arr[4] . $arr[5] . " " . $arr[6] . $arr[7] . " " . $arr[8] . $arr[9];
                                                                          } else  echo "Numara yanlış ya da eksik";
                                                                        } else {
                                                                          echo "Oturan Yok";
                                                                        } ?></span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-secondary text-xs font-weight-bold"><?php
                                                                                $daireSakinleriBorc = $conn->query("Select sum(ucret) as 'ucret' from tblucret where daireid='$borc' and odendimi=0");
                                                                                $daireSakinleriBorclari = $daireSakinleriBorc->fetch(PDO::FETCH_ASSOC);
                                                                                if ($daireSakinleriBorclari["ucret"] > 0) {
                                                                                  echo $daireSakinleriBorclari["ucret"] . " TL";
                                                                                } else {
                                                                                  echo "<span class=\"badge badge-sm bg-gradient-success\">Yoktur</span>";
                                                                                }
                                                                                ?></span>
                        </td>
                        <td class="align-middle text-center">
                          <?php if ($daireSakinleri['dolumu'] == 1) { ?>
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="modal" data-target="#oturansil<?php echo $daireSakinleri['id']; ?>"> <i class="material-icons text-sm me-2">airport_shuttle</i>Taşındı</a>
                          <?php } else echo "<span class=\"badge badge-sm bg-gradient-success\">Oturan Yoktur</span>"; ?>
                        </td>
                      </tr>
                      <div class="modal fade" id="oturansil<?php echo $daireSakinleri['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title" id="exampleModalLabel">Silmek istediğinize emin misiniz?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Bu işlem geri alınamaz. İşlemi onayladığınızda bu kullanıcı silinir.</div>
                            <div class="modal-footer">

                              <button class="btn btn-warning" type="button" id="kapat" data-dismiss="modal">İptal Et</button>

                              <a class="btn btn-danger" id="kapat" href="javascript:oturanSil(<?php echo $daireSakinleri['id']; ?>)">Anladım. Yinede sil</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="yeni"></div>
      <div class="modal fade" id="bilgi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      </div>

      <div class="modal fade" id="daireblg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="overflow-y: initial !important" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Seçilen Dairenin Borçları <br>
                <font color="red"> (Aşağı Doğru Sürükleyiniz) </font>
              </h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body" id="dairebilgi" style="height: 80vh; overflow-y: auto;">

            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="button" id="exit" data-dismiss="modal">Kapat</button>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-4" style="display: none;">
        <div class="card-header p-3">
          <h5 class="mb-0">Notifications</h5>
          <p class="text-sm mb-0">
            Notifications on this page use Toasts from Bootstrap. Read more details <a href="https://getbootstrap.com/docs/5.0/components/toasts/" target="
          ">here</a>.
          </p>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <button class="btn bg-gradient-success w-100 mb-0 toast-btn" id="successButton" type="hidden" data-target="successToast">Success</button>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mt-sm-0 mt-2">
              <button class="btn bg-gradient-info w-100 mb-0 toast-btn" type="button" data-target="infoToast">Info</button>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
              <button class="btn bg-gradient-warning w-100 mb-0 toast-btn" type="button" id="warningButton" data-target="warningToast">Warning</button>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
              <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" id="dangerButton" data-target="dangerToast">Danger</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="position-fixed bottom-1 end-1 z-index-2">
      <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="false">
        <div class="toast-header border-0">
          <i class="material-icons text-success me-2">
            check
          </i>
          <span class="me-auto font-weight-bold">Site Yönetimi </span>
          <small class="text-body">Şimdi</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          Kayıt başarıyla silindi.
        </div>
      </div>
      <div class="toast fade hide p-2 mt-2 bg-gradient-info" role="alert" aria-live="assertive" id="infoToast" aria-atomic="true">
        <div class="toast-header bg-transparent border-0">
          <i class="material-icons text-white me-2">
            notifications
          </i>
          <span class="me-auto text-white font-weight-bold">Material Dashboard </span>
          <small class="text-white">11 mins ago</small>
          <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal light m-0">
        <div class="toast-body text-white">
          Hello, world! This is a notification message.
        </div>
      </div>
      <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="warningToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-warning me-2">
            travel_explore
          </i>
          <span class="me-auto font-weight-bold">Site Yönetimi </span>
          <small class="text-body">Şimdi</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          Bir hata oluştu. daha sonra tekrar deneyiniz.
        </div>
      </div>
      <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-danger me-2">
            campaign
          </i>
          <span class="me-auto text-gradient text-danger font-weight-bold">Site Yönetimi </span>
          <small class="text-body">Şimdi</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          Lütfen tüm bilgileri eksiksiz giriniz.
        </div>
      </div>
    </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <!-- Ajax için jquery kütüphanesi. -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
<script>
  function oturanSil(id) {
    var ajax_data = {
      id: id
    };
    $.ajax({
      url: 'oturansil.php',
      method: "POST",
      data: ajax_data,
      success: function(cevap) {
        $('#yeni').html(cevap);
        $(".modal .close").click();
        setTimeout(function() {
          window.location.reload();
        }, 1000);
      }
    });
  }

  function bilgiGetir(id) {
    var data = {
      id: id
    };
    $.ajax({
      url: 'bilgigetir.php',
      method: "POST",
      data: data,
      success: function(gelen) {
        $('#bilgi').html(gelen);
        $('#ac').click();
      }
    });
  }

  function dairebilgiGetir(id) {
    var dairedata = {
      id: id
    };
    $.ajax({
      url: 'dbilgigetir.php',
      method: "POST",
      data: dairedata,
      success: function(cvp) {
        $('#dairebilgi').html(cvp);
        $('#dairebilgiac').click();
      }
    });
  }
</script>

</html>