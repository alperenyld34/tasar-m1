<?php 
include 'header.php' ;
if (isset($_POST['daire_bak'])) {
	if (is_numeric($_POST['daire_id'])) {

		$dairesor=$db->prepare("SELECT * FROM daire where daire_id=:id");
		$dairesor->execute(array(
			'id' => guvenlik($_POST['daire_id'])
		));
		$dairecek=$dairesor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:daireler?durum=hata");
	}

} else {
	header("location:daireler.php");
} 
?>

<?php
$dairenindetaymetni=$dairecek['daire_detay'];
$dosyayolu=$dairecek['dosya_yolu'];
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
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $dairecek['daire_sakini'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>daire Sakini</label>
								<input disabled type="text" class="form-control" name="daire_sakini" value="<?php echo $dairecek['daire_sakini'] ?>">
							</div>
							
							<div class="form-row">
							<div class="form-group col-md-6">
								<label>daire no</label>
								<input disabled type="text" class="form-control" name="daire_no" value="<?php echo $dairecek['daire_no'] ?>">
							</div>
							
						<div class="form-row">
							<div class="form-group col-md-12">
								<textarea disabled class="ckeditor" id="editor"><?php echo $dairenindetaymetni; ?></textarea>
							</div>
						</div>
						<?php if (strlen($dosyayolu)>10) { ?>
							<div class="form-row mt-2">
								<div class="col-md-6">
									<div class="file-loading">
										<input class="form-control" id="dairedosyalari" name="daire_dosya" type="file">
									</div>
								</div>
							</div>	
						<?php } ?>		
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace('editor');
</script>

<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#dairedosyalari").fileinput({
				'theme': 'explorer-fas',
				showBrowse: false,
				showUpload: false,
				showCaption: false,
				showClose: false,
				showCaption: false,
				//	'initialPreviewAsData': true,
				
				initialPreview: [
				'<img src="dosyalar/<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
				],
				initialPreviewConfig: [
				{downloadUrl: url1,
					showRemove: false},
					],
				});
		});
	</script>
<?php } ?>
