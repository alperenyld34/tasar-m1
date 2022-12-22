<?php
 if(!isset($_SESSION)){
  session_start();
}
if($_SESSION['tc'] !=1){
  header('Location:../index.php');
  session_destroy();
}
 ?>
<!DOCTYPE html>
<html lang="tr"> 
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.1" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  <?php include 'adminsidebar.php'; ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <?php include 'adminnavbar.php'; ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-3">
              <h5 class="mb-0">Duyuru Ekle</h5>
              <p class="text-sm mb-0">
                Tüm site sakinlerinin görebileceği bir duyuru ekle.
              </p>
            </div>
            <div class="card-body">
                <form role="form" id="gidenForm" class="text-start">
                  <label class="form-label">Duyuru Tipini Seçiniz (Kullanıcı panelinde gözükecektir.)</label> <br >
                <div id="RadioArea">
                    <i class="material-icons text-danger text-gradient">notifications</i> Acil <input  type="radio" name="rd" value="danger" /> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="material-icons text-warning text-gradient">notifications</i> Önemli <input type="radio" name="rd" value="warning" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="material-icons text-info text-gradient">notifications</i> Bilgilendirme <input type="radio" name="rd" value="info" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="material-icons text-success text-gradient">notifications</i> Basit <input type="radio" name="rd" value="success" />
                </div>
                    <div class="input-group input-group-outline my-3">
                    <label class="form-label">Başlık</label>
                    <input type="text" class="form-control" id="baslik">
                  </div>
                  <div class="input-group input-group-outline my-3 focus is-focused">
                    <label class="form-label">Duyuru</label>
                    <textarea class="form-control" id="icerik" rows="5"></textarea>
                  </div>
                  <div class="text-center">
                    <input id="send" class="btn bg-gradient-primary w-100 my-4 mb-2" value="Ekle">
                  </div>
                </form>
                <div id="sonuc"></div>
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
        <div class="toast fade hide p-2 bg-white" role="alert" aria-live="assertive"  id="successToast" aria-atomic="false">
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
            Duyuru Eklendi.
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

<script>
$('#send').click(
  function(){
  var rdbutton = $("#RadioArea input[type='radio']:checked").val();
  var data = 'baslik='+$('#baslik').val() +'&icerik='+$('#icerik').val() + '&tip='+rdbutton;
  $.ajax({
    type: 'POST',
    url: 'duyuruajax.php',
    data: data,
    success:function(cevap){
      console.log(cevap);
      $('#sonuc').html(cevap);
     // $('#kapat').click();
      gidenForm.reset();
    }
  });
})
</script>