<?php 
require_once 'header.php';
require_once 'islemler/baglan.php';
?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css" media="screen">
	@media only screen and (max-width: 700px) {
		.mobilgizle {
			display: none;
		}
		.mobilgizleexport {
			display: none;
		}
		.mobilgoster {
			display: block;
		}
	}
	@media only screen and (min-width: 700px) {
		.mobilgizleexport {
			display: flex;
		}
		.mobilgizle {
			display: block;
		}
		.mobilgoster {
			display: none;
		}
	}
</style>
<script type="text/javascript">
	var genislik = $(window).width()   
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>
<div class="container-fluid p-2">
	<div class="row" style="margin-bottom: -20px;">

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$dairesayisor=$db->prepare("SELECT daire_no FROM daire");
		$dairesayisor->execute();
		$dairesayisi = $dairesayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Toplam <b>daire</b> Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $dairesayisi; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$daire_biten_sayi_sor=$db->prepare("SELECT daire_no FROM daire WHERE daire_durum='Bitti'");
		$daire_biten_sayi_sor->execute();
		$daire_biten_sayi_cek = $daire_biten_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ödenen Kira Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $daire_biten_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		$dairesayisor=$db->prepare("SELECT daire_no FROM daire WHERE daire_aciliyet='Acil'");
		$dairesayisor->execute();
		$dairesayisi = $dairesayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ödenmeyen Kira Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $dairesayisi; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$dairesayisor=$db->prepare("SELECT daire_no FROM daire WHERE daire_aciliyet='Acelesi Yok'");
		$dairesayisor->execute();
		$dairesayicek = $dairesayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mesaj Sayısı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $dairesayicek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<hr style="margin-bottom: 15px !important;">



	<!--daireler Giriş-->
	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Daireler</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr> 
									<th>Başlık</th>
									<th>Bitiş Tarihi</th>
									<th>Aciliyet</th>

								</tr>
							</thead>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
							<tbody>
								<?php 
								$say=0;
								$dairesor=$db->prepare("SELECT * FROM daire ORDER BY daire_no DESC");
								$dairesor->execute();
								while ($dairecek=$dairesor->fetch(PDO::FETCH_ASSOC)) { $say++?>

									<tr>
										<td><?php echo $dairecek['daire_no']; ?></td>
										<td><?php echo $dairecek['daire_teslim_tarihi']; ?></td>
										<td><?php 
										if ($dairecek['daire_aciliyet']=="Acil") {
											echo '<span class="badge badge-danger" style="font-size:1rem">Acil</span>';
										} else {
											echo $dairecek['daire_aciliyet'];
										}
										?></td>

									</tr>
								<?php } ?>
							</tbody>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3 text-center">
					<h5 class="m-0 font-weight-bold text-primary">Kiralar</h5>
				</div>
				<div class="card-body" style="width: 100%">

					<div class="table-responsive">
						<table class="table table-bordered" id="siparistablosu" width="100%" cellspacing="0">
							<thead>
								<tr> 
								<th>No</th>
			 <th>Daire No</th>
            <th>Daire Sakini</th>
			<th>Kira Ücreti</th>
			<th>Kira Durumu</th>
            <th>İşlem</th>

								</tr>
							</thead>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
							<?php 
       			  $say=0;
       			  $dairesor=$db->prepare("SELECT * FROM daire ORDER BY daire_id DESC");
        		 $dairesor->execute();
       			  while ($dairecek=$dairesor->fetch(PDO::FETCH_ASSOC)) { $say++?>

           <tr>
            <td><?php echo $say; ?></td>
            <td><?php echo $dairecek['daire_no']; ?></td>
			<td><?php echo $dairecek['daire_sakini']; ?></td>
			<td><?php echo $dairecek['daire_kira']; ?></td>
			 <td><?php 
            if ($dairecek['kira_durum']=="1") {
              echo '<span class="badge badge-danger" style="font-size:1rem">Ödenmedi</span>';
            } else {
              echo 'Ödendi';
            }
            ?></td>
			
           
           
          <td>
								<?php }
								?>
							</tbody>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>
<!--daireler Çıkış-->

</div>


<?php 
include 'footer.php';
?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script> 
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>
<script type="text/javascript">
	$("#aktarmagizleme").click(function(){
		$(".dt-buttons").toggle();
	});
</script>
<script type="text/javascript">
	$(".mobilgoster").click(function(){
		$(".gizlemeyiac").toggle();
	});
</script>

<script>
	var dataTables = $('#dataTable').DataTable({
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<script>
	var dataTables = $('#siparistablosu').DataTable({
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

