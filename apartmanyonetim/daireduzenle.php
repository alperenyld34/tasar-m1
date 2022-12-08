<?php 
include 'header.php' ;

if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}

if (isset($_POST['daire_id'])) {
	$dairesor=$db->prepare("SELECT * FROM daire where daire_id=:id");
	$dairesor->execute(array(
		'id' => guvenlik($_POST['daire_id'])
	));
	$dairecek=$dairesor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:daireler");
} 
?>
<?php
$dairenindetaymetni=$dairecek['daire_detay'];
$dosyayolu=$dairecek['dosya_yolu']
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Daire Düzenleme   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if ($_GET['islem']=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif ($_GET['islem']=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>daire Başlık</label>
									<input required type="text" class="form-control" name="daire_sakini" value="<?php echo $dairecek['daire_sakini'] ?>">
								</div>
							</div>
							<div class="form-row">
							<div class="form-group col-md-6">
									<label>daire no</label>
									<input required type="text" class="form-control" name="daire_no" value="<?php echo $dairecek['daire_no'] ?>">
								</div>
							</div>
							
							<div class="form-row">
								
								<?php $durum=$dairecek['daire_durum']; ?>
								<div required class="form-group col-md-6">
									<label>daire Durumu</label>
									<select required="" name="daire_durum" class="form-control">
										<?php foreach (durum() as $key => $value): ?>
											<option <?php if($durum == $key){echo("selected");}?> value="<?php echo $key ?>"><?php echo $value ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							
							
							
							<div class="form-row justify-content-center">	
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="dairedosya" name="daire_dosya" >
									</div>
								</div>
							</div>					
							<div class="form-row">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="daire_detay" id="editor"><?php echo $dairenindetaymetni; ?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="daire_id" value="<?php echo $_POST['daire_id'] ?>">
							<button style="width: fit-content;" type="submit" name="daireguncelle" class="btn btn-success">Kaydet</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>

<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#dairedosya").fileinput({
				'theme': 'explorer-fas',
				'showUpload': false,
				'showCaption': true,
				'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="dosyalar/<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
			],
			initialPreviewConfig: [
			{downloadUrl: url1,
				showRemove: false,
			},
			],
		});

		});
	</script>
<?php } else { ?>
	<script>
		$(document).ready(function () {
			$("#dairedosya").fileinput({
				'theme': 'explorer-fas',
				'showUpload': false,
				'showCaption': true,
				'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
		});

		});
	</script>
<?php } ?>
