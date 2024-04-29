<div class="page-inner">
	<div id="content">
		<section id="viewLembur">
			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							Formulir
							<?php echo $title ?> Pegawai
						</h4>
					</div>
					<div class="card-body collapse show" id="collapse1">
						<form id="form">

							<input type="hidden" class="form-control" name="id_level" id="id_level"
								value='<?php echo $_SESSION['id_level'] ?>' />
							<input type="hidden" class="form-control" name="id_user" id="id_user"
								value='<?php echo $_SESSION['id_user'] ?>' />
							<input type="hidden" class="form-control" name="inp_sysdate" id="inp_sysdate"
								value='<?php echo $_SESSION['sysdate'] ?>' />
							<input type="hidden" class="form-control" name="id" id="id" value='' />

							<div class="form-group row">
								<label for="example-number-input" class="col-md-2 col-form-label form-control-label">No.
									SPT</label>
								<div class="col-md-10">
									<input class="form-control" type="text" id="sk_lembur" name="sk_lembur" required>
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">NIP</label>
								<div class="col-md-10">
									<select class="form-control" data-toggle="select" id="selectPegawai"
										name="selectPegawai">
										<option value="0">-- Pilih Pegawai --</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Kegiatan</label>
								<div class="col-md-10">
									<input class="form-control" type="text" id="kegiatan_lembur" name="kegiatan_lembur">
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Tanggal
									Lembur</label>
								<div class="col-md-10">
									<input id="tgl_lembur" type="text" name="tgl_lembur"
										class="form-control datepicker-here" placeholder="Pilih Tanggal"
										data-date-format="dd-mm-yyyy">
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Total Jam
									Lembur</label>
								<div class="col-md-10">
									<input class="form-control" type="text" id="jam_lembur" name="jam_lembur">
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Nominal
									Lembur</label>
								<div class="col-md-10">
									<input class="form-control autoNumeric" type="text" id="nominal_lembur"
										name="nominal_lembur">
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Potongan PPh
									21</label>
								<div class="col-md-10">
									<input class="form-control autoNumeric" type="text" id="potongan_lembur"
										name="potongan_lembur">
								</div>
							</div>

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Total</label>
								<div class="col-md-10">
									<input class="form-control autoNumeric" type="text" id="total_lembur"
										name="total_lembur" readonly>
								</div>
							</div>

							<div class="form-group row">
								<label for="example-text-input"
									class="col-md-2 col-form-label form-control-label"></label>
								<div class="col-md-10">
									<button class="btn btn-icon btn-primary" type="button" id="btn_proses">
										<span class="btn-inner--icon">
											<i class="ni ni-bag-17"></i>
										</span>
										<span class="btn-inner--text">Simpan Data</span>
									</button>
									<button class="btn btn-icon btn-danger" type="button" id="btn_reset">
										<span class="btn-inner--icon">
											<i class="ni ni-bag-17"></i>
										</span>
										<span class="btn-inner--text">Reset Form</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							Daftar <?php echo $title ?> Pegawai
						</h4>
					</div>
					<div class="card-body">
						<table class="table table-flush" id="datatable_lembur">
							<thead class="thead-light">
								<tr>
									<th width="5%">No</th>
									<th>No. SPT</th>
									<th>Kegiatan</th>
									<th>Tanggal lembur</th>
									<th>Total jam </th>
									<th>Nominal lembur</th>
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
			</div>
		</section>
	</div>
</div>

<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/Mst_Lembur/script-lembur.js?n=1" type="text/javascript"></script>