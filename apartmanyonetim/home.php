<?php
include 'connection.php';
session_start();

$duyuruQuery = $conn->query("Select * from tblduyuru order by id desc");
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Site Yönetimi
  </title>

  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><a href="/home.php">APARTMAN YÖNETİM</a></div>
          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="/index.php" class="nav-link"><span>GİRİŞ YAP</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>
    </header>

    <div class="intro-section" id="home-section">
      <div class="slide-1" style="background-image: url('images/hero_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="row align-items-center">
                <div class="col-lg-12 ml-auto" data-aos="fade-up" data-aos-delay="500">
                  <h1 style="text-align: center;">DUYURU PANOSU</h1>
                  <div class="slideshow-container">
                    <?php
                    while ($duyurular = $duyuruQuery->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                      <div class="mySlides fade" style="background: #738fa77a;">
                        <div class="numbertext" style="text-align: center; font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem;"><?php echo $duyurular['baslik']; ?>

                        </div>
                        <img style="width:100%; height:150px;">

                        <div class="text">
                          <hr color="#fff;"><?php echo $duyurular['icerik']; ?>
                        </div>
                      </div>
                    <?php  } ?>
                  </div>
                  <div style="text-align:center">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                  </div>
                  <br>
                  <style>
                    .fade:not(.show) {
                      opacity: unset;
                    }

                    * {
                      box-sizing: border-box
                    }

                    body {
                      font-family: Verdana, sans-serif;
                    }

                    .mySlides {
                      display: none
                    }

                    /* Slideshow container */
                    .slideshow-container {
                      max-width: 1000px;
                      position: relative;
                      margin: auto;
                    }

                    /* Caption text */
                    .text {
                      color: #f2f2f2;
                      font-size: 15px;
                      padding: 8px 12px;
                      position: absolute;
                      bottom: 8px;
                      width: 100%;
                      text-align: center;
                    }

                    /* Number text (1/3 etc) */
                    .numbertext {
                      color: #f2f2f2;
                      font-size: 12px;
                      padding: 8px 12px;
                      position: sticky;
                      top: 0;
                    }

                    /* The dots/bullets/indicators */
                    .dot {
                      height: 13px;
                      width: 13px;
                      margin: 0 2px;
                      background-color: #bbb;
                      border-radius: 50%;
                      display: inline-block;
                      transition: background-color 0.6s ease;
                    }

                    .active {
                      background-color: #717171;
                    }

                    /* Fading animation */
                    .fade {
                      -webkit-animation-name: fade;
                      -webkit-animation-duration: 1.5s;
                      animation-name: fade;
                      animation-duration: 1.5s;
                    }

                    @-webkit-keyframes fade {
                      from {
                        opacity: .4
                      }

                      to {
                        opacity: 1
                      }
                    }

                    @keyframes fade {
                      from {
                        opacity: .4
                      }

                      to {
                        opacity: 1
                      }
                    }

                    /* On smaller screens, decrease text size */
                    @media only screen and (max-width: 300px) {
                      .text {
                        font-size: 11px
                      }
                    }
                  </style>

                  <script>
                    var slideIndex = 0;
                    showSlides();

                    function showSlides() {
                      var i;
                      var slides = document.getElementsByClassName("mySlides");
                      var dots = document.getElementsByClassName("dot");
                      for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                      }
                      slideIndex++;
                      if (slideIndex > slides.length) {
                        slideIndex = 1
                      }
                      for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                      }
                      slides[slideIndex - 1].style.display = "block";
                      dots[slideIndex - 1].className += " active";
                      setTimeout(showSlides, 10000); // Bu alandan resimlerin geçiş süresini değiştirebilirsiniz.
                    }
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer-section bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h3>About OneSchool</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro consectetur ut hic ipsum et veritatis corrupti. Itaque eius soluta optio dolorum temporibus in, atque, quos fugit sunt sit quaerat dicta.</p>
          </div>

          <div class="col-md-3 ml-auto">
            <h3>Links</h3>
            <ul class="list-unstyled footer-links">
              <li><a href="#">Home</a></li>
              <li><a href="#">Courses</a></li>
              <li><a href="#">Programs</a></li>
              <li><a href="#">Teachers</a></li>
            </ul>
          </div>

          <div class="col-md-4">
            <h3>Subscribe</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt incidunt iure iusto architecto? Numquam, natus?</p>
            <form action="#" class="footer-subscribe">
              <div class="d-flex mb-5">
                <input type="text" class="form-control rounded-0" placeholder="Email">
                <input type="submit" class="btn btn-primary rounded-0" value="Subscribe">
              </div>
            </form>
          </div>
        </div>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div> <!-- .site-wrap -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>

</body>

</html>