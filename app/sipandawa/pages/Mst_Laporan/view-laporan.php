<div id="content">
	<section id="viewLaporan">
		<div class="col-md-12 col-lg-12">
			<div class="card mb-4 shadow-1">
				<input type="hidden" class="form-control" name="id_level" id="id_level"
					value='<?php echo $_SESSION['id_level'] ?>' />
				<input type="hidden" class="form-control" name="id_user" id="id_user"
					value='<?php echo $_SESSION['id_user'] ?>' />
				<input type="hidden" class="form-control" name="inp_sysdate" id="inp_sysdate"
					value='<?php echo $_SESSION['sysdate'] ?>' />
				<input type="hidden" class="form-control" name="id" id="id" value='' />
				<div class="card-header">
					<h4 class="card-header-title">
						Menu Cetak Laporan
					</h4>
				</div>
				<div class="card-body collapse show" id="collapse4">
					<div class="row">
						<div class="row-left ">
							<div class="col-sm-6 col-xl-10" id="btn_spt">
								<div class="card mb- bg-teal text-light shadow-1 ">
									<div class="card-body card-img">
										<h4><i class="icon-wallet"></i> Laporan SPT</h4>
										<p class="mg-0">Klik untuk mencetak</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xl-10" id="btn_laporan">
								<div class="card mb-4 bg-danger text-light shadow-1">
									<div class="card-body card-img">
										<h4><i class="icon-wallet"></i> Laporan Tetap & Teratur</h4>
										<p class="mg-0">Klik untuk mencetak</p>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-xl-10" id="btn_gaji">
								<div class="card bg-primary text-light mb-4 shadow-1">
									<div class="card-body card-img">
										<h4><i class="icon-wallet"></i> Laporan Gaji</h4>
										<p class="mg-0">Klik untuk mencetak</p>
									</div>
								</div>
							</div>
						</div>
						<!-- col-6 -->
						<div class="col-xl-7 mg-t-20 mg-xl-t-0">
							<div class="form-layout form-layout-5">
								<div class="form-group row">
									<label for="example-number-input"
										class="col-md-1 col-form-label form-control-label">NIP</label>
									<div class="col-md-10">
										<select class="form-control" data-toggle="select" id="selectPegawai"
											name="selectPegawai">
											<option value="0">-- Pilih Pegawai --</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-number-input"
										class="col-md-1 col-form-label form-control-label">Mulai</label>
									<div class="col-md-4">
										<input class="form-control datepicker-here" placeholder="Pilih Bulan"
											type="text" id="tgl_start" name="tgl_start" data-date-format="mm-yyyy">
									</div>
									<label for="example-number-input"
										class="col-md-1 col-form-label form-control-label">s/d</label>
									<div class="col-md-4">
										<input class="form-control datepicker-here" placeholder="Pilih Bulan"
											type="text" id="tgl_end" name="tgl_end" data-date-format="mm-yyyy">
									</div>
								</div>
							</div>
							<!-- form-layout -->
						</div>
						<!-- col-6 -->
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/Mst_Laporan/script-laporan.js?n=1" type="text/javascript"></script>