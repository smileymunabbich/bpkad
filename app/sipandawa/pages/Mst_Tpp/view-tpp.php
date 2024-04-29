<div class="page-inner">
	<div id="content">
		<section id="viewTpp">
			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							Formulir Unggah File
							<?php echo $title ?>
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

							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Bulan -
									Tahun</label>
								<div class="col-md-10">
									<input class="form-control datepicker-here" placeholder="Pilih Bulan" type="text"
										data-min-view="months" data-view="months" id="bulan_tahun" name="bulan_tahun"
										data-date-format="mm-yyyy">
								</div>
							</div>

							<input type="hidden" class="form-control" name="id" id="id" value='' />
							<div class="form-group row">
								<label for="example-number-input"
									class="col-md-2 col-form-label form-control-label">Upload
									CSV</label>
								<div class="col-md-10">
									<input id="file_data" name="file_data" type="file" required>
								</div>
							</div>
							<div class="form-group row">
								<label for="example-text-input"
									class="col-md-2 col-form-label form-control-label"></label>
								<div class="col-md-10">
									<button class="btn btn-icon btn-success" type="button" id="btn_input">
										<span class="btn-inner--icon">
											<i class="ni ni-bag-17"></i>
										</span>
										<span class="btn-inner--text">Save Data</span>
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
							Daftar
							<?php echo $title ?>
						</h4>
					</div>
					<div class="card-body d-flex">
						<div class="table-responsive py-4">
							<table class="table table-flush" id="datatable_tpp" width="100%">
								<thead class="thead-light">
									<tr>
										<th width="10%">No</th>
										<th>NIP</th>
										<th>Nama</th>
										<th>Jabatan</th>
										<th>Unit Kerja</th>
										<th>Gol. Ruang</th>
										<th>Kelas</th>
										<th>Bruto</th>
										<th>Beban Kerja TPP</th>
										<th>Beban Kerja PPh</th>
										<th>Beban Kerja Netto</th>
										<th>Prestasi Kerja TPP</th>
										<th>Prestasi Kerja PPh</th>
										<th>Prestasi Kerja Netto</th>
										<th>Kondisi Kerja TPP</th>
										<th>Kondisi Kerja PPh</th>
										<th>Kondisi Kerja Netto</th>
										<th>Jumlah</th>
										<th>Potongan PPh</th>
										<th>Jumlah TPP</th>
										<th>Potongan Iwp</th>
										<th>TPP Diterima</th>
										<th>No. Rekening</th>
										<th>bulan_tahun</th>
										<th width="10%">Aksi</th>
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
<script src="../pages/Mst_Tpp/script-tpp.js?n=1" type="text/javascript"></script>