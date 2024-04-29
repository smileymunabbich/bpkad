<div class="page-inner">
	<div id="content">
		<section id="viewGantiPassword">
			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							Form
							<?php echo $title ?>
						</h4>
					</div>
					<div class="card-body collapse show" id="collapse1">
						<form id="formInput" class="form-horizontal iconAfterControl">
							<input type="hidden" id="levelUser" name="levelUser"
								value="<?php echo $_SESSION['id_level'] ?>">

							<div class="form-group">
								<div class="col-sm-3 to-right">
									<label for="sublabelEmail">Nama User</label>
									<span class="form-sublabel"></span>
								</div>
								<div class="col-sm-7">
									<input type="text" name="nama" id="nama" class="form-control"
										value="<?php echo $_SESSION['nama_user'] ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3 to-right">
									<label for="sublabelEmail">Username</label>
									<span class="form-sublabel"></span>
								</div>
								<div class="col-sm-7">
									<input type="text" name="user" id="user" class="form-control"
										value="<?php echo $_SESSION['id_user'] ?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3 to-right">
									<label for="sublabelEmail">Masukkan </label>
									<span class="form-sublabel">Password Baru</span>
								</div>
								<div class="col-sm-7">
									<input type="password" name="password1" id="password1" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3 to-right">
									<label for="sublabelEmail">Ulangi </label>
									<span class="form-sublabel">Password</span>
								</div>
								<div class="col-sm-7">
									<input type="password" name="password2" id="password2" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-7">
									<button class="btn btn-primary" type="submit">
										<i class="glyphicon glyphicon-save"></i>
										Simpan
									</button>
									<button class="btn btn-danger" type="reset" id="btnCancel">
										<i class="glyphicon glyphicon-remove"></i>
										Batal
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>


<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/W-GantiPassword/script-gantipassword.js" type="text/javascript"></script>