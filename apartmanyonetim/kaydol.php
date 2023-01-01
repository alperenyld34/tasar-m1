<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
   Kaydol
  </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.1" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url(assets/img/site.jpeg); background-size:cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Kaydol</h4>
                  <p class="mb-0">Apartman Yönetim Sistemine kaydolmak için bilgilerinizi giriniz.</p>
                  <i class="material-icons text-danger p-2">warning </i><span class="text-danger"> Telefon numaranızı başında 0 olmadan giriniz. </span>
                </div>
                <div class="card-body">
                <form role="form" id="gidenForm" class="text-start">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">TC Kimlik Numaranız</label>
                    <input type="number"  maxlength="11" class="form-control" id="tc" required>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Adınız ve Soyadınız</label>
                    <input type="text" class="form-control" id="adsoyad"> 
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Adresiniz</label>
                    <input type="text" class="form-control" id="adres">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Cep Telefonu Numaranız</label>
                    <input type="number" pattern="\d*" required maxlength="10" class="form-control"  id="tel" maxlength="10">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Şifreniz</label>
                    <input type="password" class="form-control" id="sifre">
                  </div>
                  <div class="input-group input-group-outline my-3 focused is-focused">
                    <label class="form-label">Blok (Seçiniz)</label>
                     <select class="form-control" id="blok">
                      <option value="A">A</option>
                      <option value="B">B</option>
                    </select>
                  </div>
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Daire No</label>
                    <input type="number" class="form-control" id="daireno">
                  </div>
                  <div id="RadioArea">
                    Ev Sahibi <input type="radio" name="rd" value="Ev Sahibi" />
                    Kiracı <input type="radio" name="rd" value="Kiracı" />
                </div>
                  <div class="text-left">
                  <input type="checkbox" id="kvkk" value="kvkk"> <a href="kvkk.php" target="_blank"> <b> Kişisel verilere dair aydınlatma metnini </b> </a> okudum, kabul ediyorum. 
                  </div>
                  <div class="text-center">
                    <input id="send" class="btn bg-gradient-primary w-100 my-4 mb-2" value="Kaydol">
                  </div>
                </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                   Hesabınız var mı? 
                    <a href="index.php" class="text-primary text-gradient font-weight-bold">Giriş Yapın</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="sonuc"></div>
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
                <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
                  <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" id="dikkatButton" data-target="dikkatToast">Danger</button>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
                  <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" id="evdoluButton" data-target="evdoluToast">Danger</button>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 mt-lg-0 mt-2">
                  <button class="btn bg-gradient-danger w-100 mb-0 toast-btn" type="button" id="evyokButton" data-target="evyoktoast">Danger</button>
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
            Kayıt Eklendi. Giriş Yapabilirsiniz.
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
            Kayıt olmanız için KVKK aydınlatma metnini okuyup, onaylamanız gerekmektedir.
          </div>
        </div>
        <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dikkatToast" aria-atomic="true">
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
            Bu kullanıcı kayıtlı. Lütfen yöneticiniz ile iletişime geçiniz.
          </div>
        </div>
        <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="evyoktoast" aria-atomic="true">
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
            Böyle bir blok ya da daire bulunamamaktadır.
          </div>
        </div>
        <div class="toast fade hide p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="evdoluToast" aria-atomic="true">
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
            Bu daire dolu görünüyor. Lütfen yönetici ile iletişime geçiniz.
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
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="assets/js/material-dashboard.min.js?v=3.0.1"></script>
</body>
</html>
<script>

 $('#send').click(
  function(){
    var rdbutton = $("#RadioArea input[type='radio']:checked").val();
  if(document.getElementById("kvkk").checked){    
    var data = 'blok='+$('#blok').val() + '&tc='+$('#tc').val() + '&adsoyad='+$('#adsoyad').val() + '&evsahibi='+rdbutton + '&adres='+$('#adres').val() + '&tel='+$('#tel').val()+ '&sifre='+$('#sifre').val()+ '&daireno='+$('#daireno').val();
    $.ajax({
      type: 'POST',
      url: 'kaydolajax.php',
      data: data,
      success:function(cevap){
        $('#sonuc').html(cevap);
        //gidenForm.reset();
      }
    });
  } else if (!document.getElementById("kvkk").checked) {
    $('#warningButton').click();
  }

})
</script>