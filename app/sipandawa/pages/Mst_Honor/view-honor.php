<div class="page-inner">
	<div id="content">
		<section id="viewHonor">
			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							Formulir
							<?php echo $title ?> Pegawai
						</h4>
					</div>
					<div class="card-body collapse show" id="collapse1">
						<form id="form"> <input type="hidden" class="form-control" name="id_level" id="id_level"
								value='<?php echo $_SESSION['id_level'] ?>' /> <input type="hidden" class="form-control"
								name="id_user" id="id_user" value='<?php echo $_SESSION['id_user'] ?>' /> <input
								type="hidden" class="form-control" name="inp_sysdate" id="inp_sysdate"
								value='<?php echo $_SESSION['sysdate'] ?>' /> <input type="hidden" class="form-control"
								name="id" id="id" value='' />
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">No. SK</label>
								<div class="col-md-10"> <input class="form-control" type="text" id="sk_honor"
										name="sk_honor" required> </div>
							</div>
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">NIP</label>
								<div class="col-md-10"> <select class="form-control" data-toggle="select"
										id="selectPegawai" name="selectPegawai">
										<option value="0">-- Pilih Pegawai --</option>
									</select> </div>
							</div>
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Jabatan</label>
								<div class="col-md-10"> <input class="form-control" type="text" id="jabatan_honor"
										name="jabatan_honor"> </div>
							</div>
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Tanggal
									Pencairan</label>

								<div class="col-md-10">
									<input id="tgl_honor" type="text" name="tgl_honor"
										class="form-control datepicker-here" placeholder="Pilih Tanggal"
										data-date-format="dd-mm-yyyy">
								</div>

							</div>
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Nominal</label>
								<div class="col-md-10"> <input class="form-control autoNumeric" type="text"
										id="nominal_honor" name="nominal_honor"> </div>
							</div>
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Potongan PPh
									21</label>
								<div class="col-md-10"> <input class="form-control autoNumeric" type="text"
										id="potongan_honor" name="potongan_honor"> </div>
							</div>
							<div class="form-group row"> <label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Total</label>
								<div class="col-md-10"> <input class="form-control autoNumeric" type="text"
										id="total_honor" name="total_honor" readonly> </div>
							</div>
							<div class="form-group row"> <label for="example-text-input"
									class="col-md-2 col-form-label form-control-label"></label>
								<div class="col-md-10"> <button class="btn btn-icon btn-primary" type="button"
										id="btn_proses"> <span class="btn-inner--icon"> <i class="ni ni-bag-17"></i>
										</span> <span class="btn-inner--text">Simpan Data</span> </button> <button
										class="btn btn-icon btn-danger" type="button" id="btn_reset">
										<span class="btn-inner--icon"> <i class="ni ni-bag-17"></i>
										</span> <span class="btn-inner--text">Reset Data</span>
									</button> </div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							List Menu
						</h4>
					</div>
					<div class="card-body">
						<table class="table table-flush" id="datatable_honor">
							<thead class="thead-light">
								<tr>
									<th width="5%">No</th>
									<th> No. SK</th>
									<th>Jabatan</th>
									<th>Tanggal pencairan</th>
									<th width="10%">Nominal</th>
									<th>Potongan PPh</th>
									<th>Jumlah diterima</th>
									<th>User</th>
									<th width="15%">Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
		</section>
	</div>
</div>

<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/Mst_Honor/script-honor.js?n=1" type="text/javascript"></script>