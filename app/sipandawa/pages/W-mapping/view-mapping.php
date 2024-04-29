<div id="content">
	<section id="viewMapping">
		<!--================================-->
		<!-- Label Alignment Form Start -->
		<!--================================-->
		<div class="col-md-12 col-lg-12">
			<div class="card mb-4 shadow-1">
				<div class="card-header">
					<h4 class="card-header-title">
						Mapping Menu
					</h4>
				</div>
				<div class="card-body collapse show" id="collapse4">
					<div class="row">
						<div class="col-xl-5">
							<div class="form-layout form-layout-4">
								<h6 class="tx-gray-800 tx-uppercase tx-bold tx-13 mg-b-10">List Level</h6>
								<div class="row">
									<table id="tabelData" class="table table-striped table-hover dt-responsive">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nama</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
							<!-- form-layout -->
						</div>
						<!-- col-6 -->
						<div class="col-xl-4 mg-t-20 mg-xl-t-0">
							<div class="form-layout form-layout-5">
								<h6 class="tx-gray-800 tx-uppercase tx-bold tx-13 mg-b-10">List Mapping</h6>
								<div class="row">
									<form id="formInput" class="form-horizontal iconAfterControl">
										<input type="hidden" id="idLevel" />
										<table id="tabelForm" class="table table-striped table-hover dt-responsive"											>
											<thead>
												<tr>
													<th class="hidden">ID Menu</th>
													<th>Menu Parent</th>
													<th>Menu Child</th>
													<th>Pilih</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</form>
								</div>
								<!-- row -->
								<div class="row mg-t-30">
									<div class="col-sm-8 mg-l-auto">
									<button class="btn btn-sm btn-primary" type="button" id="btnSimpan">
								Simpan
							</button>
									</div>
									<!-- col-8 -->
								</div>
							</div>
							<!-- form-layout -->
						</div>
						<!-- col-6 -->
					</div>
				</div>
			</div>
		</div>
		<!--/ Label Alignment Form End -->
		<!--================================-->
	</section>
</div>

<!-- TARUH SCRIPT MODUL MAHASISWA DI SINI -->
<script src="../pages/W-mapping/script-mapping.js" type="text/javascript"></script>