<!DOCTYPE html>
<?php
include '../connection.php';
if (!isset($_SESSION)) {
  session_start();
}
/*if($_SESSION['tc'] !=1){
  header('Location:../index.php');
  session_destroy();
}*/
$duyuruQuery = $conn->query("Select * from tblduyuru order by id desc");
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
                <h6 class="text-white text-capitalize ps-3"><?php if ($_SESSION['tc'] == 1) {
                                                              echo "Eklediğiniz Duyurular";
                                                            } else {
                                                              echo "Tüm Duyurular";
                                                            } ?> </h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mail Olarak Gönder</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Başlık</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">İçerik</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tip</th>
                      <?php if ($_SESSION['tc'] == 1) { ?>
                        <th class="text-center text-uppercase text-danger text-xxs font-weight-bolder opacity-7"> Sil </th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($duyurular = $duyuruQuery->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                      <tr>
                        <td class="align-middle text-center text-sm">
                          <button class="btn btn-success">Gönder</button>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $duyurular['baslik']; ?></h6>
                              <button class="btn btn-danger" id="dairebilgiac" data-toggle="modal" data-target="#daireblg" style="display:none;"></button>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <label for=""><?php echo $duyurular['icerik']; ?></label>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <i class="material-icons text-<?php echo $duyurular['tip']; ?> text-gradient">notifications</i>
                        </td>
                        <?php if ($_SESSION['tc'] == 1) { ?>
                          <td class="align-middle text-center text-sm">
                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="modal" data-target="#duyurusil<?php echo $duyurular['id']; ?>"> <span class="material-icons text-danger">delete_forever</span></a>
                          </td>
                        <?php } ?>
                      </tr>
                      <div class="modal fade" id="duyurusil<?php echo $duyurular['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title" id="exampleModalLabel">Silmek istediğinize emin misiniz?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">Bu işlem geri alınamaz. İşlemi onayladığınızda bu duyuru silinir.</div>
                            <div class="modal-footer">

                              <button class="btn btn-warning" type="button" id="kapat" data-dismiss="modal">İptal Et</button>

                              <a class="btn btn-danger" id="kapat" href="javascript:duyurusil(<?php echo $duyurular['id']; ?>)">Anladım. Yinede sil</a>
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
  function duyurusil(id) {
    var ajax_data = {
      id: id
    };
    $.ajax({
      url: 'duyurusil.php',
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