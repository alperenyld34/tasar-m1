<?php

ob_start();
session_start();
include 'islemler/baglan.php';
include 'fonksiyonlar.php';

oturumkontrol();

$ayarsor = $db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);

$kullanici = $db->prepare("SELECT * FROM kullanicilar where session_mail=:mail");
$kullanici->execute(array(
	'mail' => $_SESSION['kul_mail']
));

$say = $kullanici->rowcount();
$kullanicicek = $kullanici->fetch(PDO::FETCH_ASSOC);
if ($say == 0) {
	header("location:login?durum=izinsiz");
	exit;
};



?>
<!DOCTYPE html>
<html lang="tr">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $ayarcek['site_aciklama'] ?>">
	<meta name="author" content="<?php echo $ayarcek['site_sahibi'] ?>">
	<link rel="shortcut icon" type="image/png" href="dosyalar/<?php echo $ayarcek['site_logo'] ?>">

	<title><?php echo $ayarcek['site_baslik'] ?></title>

	<!-- Custom fonts for this template-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<style type="text/css" media="screen">
		.file-details-cell {
			display: none
		}

		.kv-file-remove {
			display: none
		}

		.br-1 {
			border-radius: 1rem;
		}
		.container-fluid {
			text-align: center;
		}
		.nav-item {
			border-left: 1px solid red!important;
    margin: 10px;
		}
		.nav-link {
			color:aliceblue;
		}
	</style>

</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<nav style="background-color: #4e73df!important;" class="navbar navbar-expand-lg mb-5">
					<?php

					if (empty($ayarcek['site_logo'])) {
						echo '<h1 style="text-align: center; color:black; font-size: 1.5rem;">APARTMAN <br>YÖNETİM</h1>';
					} else {


					?>
						<a class="navbar-brand" href="/"><img style="width: 50%; height: auto;" src="dosyalar/<?php echo $ayarcek['site_logo'] ?>" alt="<?php echo $ayarcek['site_baslik'] ?>"></a>
					<?php } ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNavDropdown">
						<ul class="navbar-nav">
							<li class="nav-item active">
								<a class="nav-link" style="margin-left: 50px;" href="/"><i class="fas fa-home"></i> ANASAYFA <span class="sr-only">(current)</span></a>
							</li>

							<!--EDit-->


							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tasks"></i>
									Daireler</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="daireler">Tüm Daireler</a>
									<?php
									if (yetkikontrol() == "yetkili") { ?>
										<a class="dropdown-item" href="daireekle">Daire Ekle</a>
									<?php } ?>
								</div>
							</li>

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tasks"></i>
									Kiralar</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="kiralar">Kiralar</a>
									<?php
									if (yetkikontrol() == "yetkili") { ?>
										<a class="dropdown-item" href="kiraekle">Kira Ekle</a>
									<?php } ?>
								</div>
							</li>

							<li class="nav-item">
								<a class="nav-link" href="profil"><i class="fas fa-user-circle"></i>Profil</a>
							</li>
							<?php
							if (yetkikontrol() == "yetkili") { ?>
								<li class="nav-item">
									<a class="nav-link" href="ayarlar"><i class="fas fas fa-fw fa-cog"></i>Ayarlar</a>
								</li>
							<?php } ?>

							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
									<span>Oturumu Kapat</span>
								</a>
							</li>

							</div>
							<!--Edit-->

							<!-- Topbar Navbar -->
							<ul class="navbar-nav ml-auto">
								<!-- Nav Item - User Information -->
								<li class="nav-item dropdown no-arrow">
									<a class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown">
										<span style="color:black !important" class="mr-2 d-none d-lg-inline text-gray-600 small ">
											<?php echo $kullanicicek['kul_isim']; ?>
										</span>
										<i class="fas fa-user img-profile rounded-circle"></i>
									</a>
									<!-- Dropdown - User Information -->
									<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
										<a class="dropdown-item" href="profil">
											<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
											Profil
										</a>

										<?php
										if (yetkikontrol() == "yetkili") { ?>
											<a class="dropdown-item" href="ayarlar">
												<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
												Ayarlar
											</a>
										<?php } ?>

										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
											<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
											Oturumu Kapat
										</a>
									</div>
								</li>
							</ul>


					
				</nav>


				<!-- Logout Modal-->
				<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Oturum Kapatma</h5>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">Oturumu kapatmak istediğinize emin misiniz?</div>
							<div class="modal-footer">
								<button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
								<a class="btn btn-primary" href="islemler/cikis">Çıkış Yap</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Topbar -->
				<script type="text/javascript">
					var genislik = $(window).width()
					if (genislik < 768) {
						function gizle() {
							$('#sidebarToggleTop').trigger('click');
						}
						setTimeout("gizle()", 1);
					}
				</script>