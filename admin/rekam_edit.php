<?php
if($_GET["aksi"] && $_GET["nmr"]){
include_once("../library/koneksi.php");
$edit = mysqli_query($koneksi,"select * from rekam_medis, pasien where rekam_medis.no_pasien=pasien.no_pasien and no_rm='".$_GET["nmr"]."'");
$editDb = mysqli_fetch_assoc($edit);
	if($_POST["rm"]){
			include_once("../library/koneksi.php");
			mysqli_query($koneksi,"update rekam_medis set kd_tindakan='".$_POST["tdk"]."', kd_obat='".$_POST["obt"]."', kd_user='".$_POST["pn"]."', no_pasien='".$_POST["pas"]."', diagnosa='".$_POST["diag"]."', resep='".$_POST["res"]."', keluhan='".$_POST["kel"]."', ket='".$_POST["ket"]."', tgl_pemeriksaan='".date("Y-m-d")."' where no_rm='".$_GET["nmr"]."'");
			echo "<meta http-equiv='refresh' content='0; url=?menu=rekam'>";
			echo "<center><div class='alert alert-success alert-dismissable'>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<b>Berhasil mengedit data!!</b>
			</div><center>";
	}
?>
<div class="span9">
	<div class="well" style="fixed:center;">
		<b>SIRS - Guthul Developer</b>
		<p style="margin-top:10px;">
			<form action="" method="post" class="form-horizontal">
						<div class="form-group">
							<label class="control-label col-lg-4">Tindakan</label>
							<?php
								include_once("../library/koneksi.php");
								$tdk = "SELECT * FROM tindakan";
								$tdkDb = mysqli_query($koneksi,$tdk) or die(mysql_error());
								$tdkR = mysqli_fetch_assoc($tdkDb);
							?>
							<div class="col-lg-4">
								<select name="tdk" class="form-control">
							<?php
							do {
								if($tdkR['kd_tindakan']== $editDb['kd_tindakan']){
							?>
									<option value="<?php echo $tdkR['kd_tindakan'];?>" selected><?php echo $tdkR['nm_tindakan'];?></option>
							<?php
								}else{
							?>
									<option value="<?php echo $tdkR['kd_tindakan'];?>"><?php echo $tdkR['nm_tindakan'];?></option>
							<?php
								}
							} while($tdkR=mysqli_fetch_assoc($tdkDb));
							?>	
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Obat</label>
							<?php
								include_once("../library/koneksi.php");
								$obt = "SELECT * FROM obat";
								$obtDb = mysqli_query($koneksi,$obt) or die(mysql_error());
								$obtR = mysqli_fetch_assoc($obtDb);
							?>
							<div class="col-lg-4">
								<select name="obt" class="form-control">
							<?php
							do {
								if($obtR['kd_obat']== $editDb['kd_obat']){
							?>
									<option value="<?php echo $obtR['kd_obat'];?>" selected><?php echo $obtR['nm_obat'];?></option>
							<?php
								}else{
							?>
									<option value="<?php echo $obtR['kd_obat'];?>"><?php echo $obtR['nm_obat'];?></option>
							<?php
								}
							} while($obtR=mysqli_fetch_assoc($obtDb));
							?>	
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Pengentri</label>
							<?php
								include_once("../library/koneksi.php");
								$pn = "SELECT * FROM login";
								$pnDb = mysqli_query($koneksi, $pn) or die(mysql_error());
								$pnR = mysqli_fetch_assoc($pnDb);
							?>
							<div class="col-lg-4">
								<select name="pn" class="form-control">
							<?php
							do {
								if($pnR['kd_user']== $editDb['kd_user']){
							?>
									<option value="<?php echo $pnR['kd_user'];?>" selected><?php echo $pnR['nama'];?></option>
							<?php
								}else{
							?>
									<option value="<?php echo $pnR['kd_user'];?>" ><?php echo $pnR['nama'];?></option>
							<?php
								}
							} while($pnR=mysqli_fetch_assoc($pnDb));
							?>	
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Pasien</label>
							<?php
								include_once("../library/koneksi.php");
								$pas = "SELECT * FROM pasien";
								$pasDb = mysqli_query($koneksi,$pas) or die(mysql_error());
								$pasR = mysqli_fetch_assoc($pasDb);
							?>
							<div class="col-lg-4">
								<select name="nama" class="form-control">
							<?php
							do {
								if($pasR['no_pasien']== $editDb['no_pasien']){
							?>
									<option value="<?php echo $pasR['no_pasien'];?>" selected><?php echo $pasR['nm_pasien'];?></option>
							<?php
								}else{
							?>
									<option value="<?php echo $pasR['no_pasien'];?>" ><?php echo $pasR['nm_pasien'];?></option>
							<?php
								}
							} while($pasR=mysqli_fetch_assoc($pasDb));
							?>		
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Diagnosa</label>
							<div class="col-lg-4">
								<select name="diag" class="form-control">
									<option value="gejala">Gejala</option>
									<option value="terjangkit">Terjangkit</option>
									<option value="stadium">Stadium</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Resep</label>
							<div class="col-lg-4">
								<input type="text" value="<?php echo $editDb["resep"];?>" required name="res" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Keluhan</label>
							<div class="col-lg-4">
								<textarea type="text" required  name="kel" class="form-control"><?php echo $editDb["keluhan"];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Keterangan</label>
							<div class="col-lg-4">
								<textarea type="text" required name="ket" class="form-control"><?php echo $editDb["ket"];?></textarea>
							</div>
						</div>
						<div class="form-actions no-margin-bottom" style="text-align:center;">
							<input type="submit" name="rm" value="Simpan" class="btn btn-primary" />
						</div>

					</form>
	</div>
</div>
<?php } ?>