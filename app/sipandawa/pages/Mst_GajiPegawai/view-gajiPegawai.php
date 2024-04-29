<div class="page-inner">
	<div id="content">
		<section id="viewGajiPegawai">
			<div class="col-md-12 col-lg-12">
				<div class="card mb-4 shadow-1">
					<div class="card-header">
						<h4 class="card-header-title">
							Daftar
							<?php echo $title ?> Pegawai
						</h4>
					</div>
					<div class="card-body d-flex">
						<div class="table-responsive py-4">
							<input type="hidden" class="form-control" name="id" id="id" value="" />
							<input type="hidden" class="form-control" name="id_level" id="id_level"
								value='<?php echo $_SESSION['id_level'] ?>' />
							<input type="hidden" class="form-control" name="id_user" id="id_user"
								value='<?php echo $_SESSION['id_user'] ?>' />
							<input type="hidden" class="form-control" name="inp_sysdate" id="inp_sysdate"
								value='<?php echo $_SESSION['sysdate'] ?>' />
							<table class="table table-flush" id="datatable_gaji">
								<thead class="thead-light">
									<tr>
										<th width="5%">No</th>
										<th>NIP</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Golongan</th>
										<th>Gaji Diterima</th>
										<th>Bulan-Tahun</th>
										<th width="10%">Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!--End LIST-->
		</section>
	</div>
</div>

<script src="../pages/Mst_GajiPegawai/script-gajiPegawai.js?n=4" type="text/javascript"></script>