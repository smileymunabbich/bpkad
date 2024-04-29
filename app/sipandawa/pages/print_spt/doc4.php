<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$nip = $_GET['nip'];

$start = $_GET['start'];
$arr_start = explode("-", $start);
$bulan_awal = $arr_start[0];
$tahun_awal = $arr_start[1];

$end = $_GET['end'];
$arr_end = explode("-", $end);
$bulan_akhir = $arr_end[0];
$tahun_akhir = $arr_end[1];

$strQuery = "SELECT * FROM mst_pegawai WHERE nip = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$response = $model->getDataQuery($strQuery);

date_default_timezone_set("Asia/Jakarta");
$yy = date("Y");
$mm = date("m");
$dd = date("d");

$yy2 = substr($yy, 2);

// var_dump(json_encode($response));
// var_dump($yy2);
// var_dump($mm);
// var_dump($dd);

$nip = $response[0]['nip'];
$no = $response[0]['no'];
$nama_pegawai = $response[0]['nama_pegawai'];
$npwp = $response[0]['npwp'];
$tipe_jabatan = $response[0]['tipe_jabatan'];
$nama_jabatan = $response[0]['nama_jabatan'];
$golongan = $response[0]['golongan'];
$alamat = $response[0]['alamat'];
$nik = $response[0]['nik'];
// $jk                     = $response[0]['jk'];
$sts_pegawai = $response[0]['sts_pegawai'];
$tipe_k = $response[0]['tipe_k'];
$tipe_k_ = preg_replace("/[^a-zA-Z]/", "", $tipe_k);
if ($tipe_k_ == "K") {
	$jumlah_tanggungan_k = $response[0]['jumlah_tanggungan'];
	$jumlah_tanggungan_tk = "____";
	$jumlah_tanggungan_hb = "____";
} else if ($tipe_k_ == "T") {
	$jumlah_tanggungan_k = "____";
	$jumlah_tanggungan_tk = $response[0]['jumlah_tanggungan'];
	$jumlah_tanggungan_hb = "____";
} else if ($tipe_k_ == "JD") {
	$jumlah_tanggungan_k = "____";
	$jumlah_tanggungan_tk = "____";
	$jumlah_tanggungan_hb = $response[0]['jumlah_tanggungan'];
}

$jk = substr($nip, 14, 1);
// var_dump($jk);

if ($jk == "1") {
	$cowok = "X";
	$cewek = "";
} else if ($jk == "2") {
	$cowok = "";
	$cewek = "X";
}

if ($golongan == "4B") {
	$pangkat = "Pembina Tk.I";
} else if ($golongan == "3D") {
	$pangkat = "Penata Tk.I";
} else if ($golongan == "3B") {
	$pangkat = "Penata Muda Tk.I";
} else if ($golongan == "3A") {
	$pangkat = "Penata Muda";
} else if ($golongan == "2D") {
	$pangkat = "Pengatur Tk.I";
} else if ($golongan == "2B") {
	$pangkat = "Pengatur Muda Tk.I";
} else if ($golongan == "2C") {
	$pangkat = "Pengatur";
}

$jiwa = $response[0]['jumlah_tanggungan'] + 1;
if ($jiwa == 1) {
	$spt_18 = 54000000;
} else if ($jiwa == 2) {
	$spt_18 = 58500000;
} else if ($jiwa == 3) {
	$spt_18 = 63000000;
} else if ($jiwa == 4) {
	$spt_18 = 67500000;
} else if ($jiwa > 5) {
	$spt_18 = 72000000;
}


$nomor_surat = str_pad($no, 7, '0', STR_PAD_LEFT);
// $nomor_surat = "1";

$spt_01 = 0;
$spt_02 = 0;
$spt_03 = 0;
$spt_04 = 0;
$spt_05 = 0;
$spt_06 = 0;
$spt_06_a = 0;
$spt_06_b = 0;
$spt_07 = 0;
$spt_08 = 0;
$spt_08_pph = 0;
$spt_08_ah = 0;
$spt_08_ae = 0;
$spt_09 = 0;
$spt_10 = 0;
$spt_11 = 0;
$spt_12 = 0;
$spt_13 = 0;
$spt_14 = 0;
$spt_15 = 0;
$spt_16 = 0;
$spt_17 = 0;
// $spt_18 = 0;
$spt_19 = 0;
$spt_20 = 0;
$spt_21 = 0;
$spt_22 = 0;
$spt_23 = 0;
$spt_23_a = 0;
$spt_23_b = 0;
$spt_iwp = 0;


$tunjangan_perbaikan_penghasilan = 0;
$tunjangan_fungsional = 0;
$tunjangan_beras = 0;
$tunjangan_khusus = 0;
$tunjangan_lain_lain = 0;
$point_10 = 0;
$tunjangan_bruto = 0;

for ($i = 0; $i < sizeof($response); $i++) {
	$spt_01 += $response[$i]['belanja_gaji_pokok'];
	$spt_02 += $response[$i]['perhitungan_suami_istri'];
	$spt_03 += $response[$i]['perhitungan_anak'];
	$spt_06_a += $response[$i]['belanja_tunjangan_jabatan'];
	$spt_06_b += $response[$i]['belanja_tunjangan_fungsional_umum'];
	$spt_07 += $response[$i]['belanja_tunjangan_beras'];
	$spt_08_pph += $response[$i]['belanja_tunjangan_pph'];
	$spt_08_ah += $response[$i]['belanja_iuran_jaminan_kecelakaan_kerja'];
	$spt_08_ae += $response[$i]['belanja_iuran_jaminan_kematian'];
	$spt_09 += $response[$i]['belanja_pembulatan_gaji'];
	$spt_iwp += $response[$i]['iwp_1'];
	$spt_20 += $response[$i]['pph_21'];
}

$spt_04 = $spt_01 + $spt_02 + $spt_03;
$spt_06 = $spt_06_a + $spt_06_b;
$spt_08 = $spt_08_pph + $spt_08_ah + $spt_08_ae;
$spt_11 = $spt_04 + $spt_05 + $spt_06 + $spt_07 + $spt_08 + $spt_09 + $spt_10;

$spt_12 = 0.0475 * $spt_04;
$spt_13 = 0.0325 * $spt_04;
$spt_14 = $spt_12 + $spt_13; // pembulatan
$spt_15 = $spt_11 - $spt_14 - $spt_iwp;

$spt_17 = $spt_15;


if ($sts_pegawai == "1") {
	$dipindahkan = "X";
	$pindahan = "";
	$baru = "";
	$pensiun = "";
	$pensiun = "";
	$spt_17 = $spt_11 - $spt_14;
} else if ($sts_pegawai == "2") {
	$dipindahkan = "";
	$pindahan = "X";
	$baru = "";
	$pensiun = "";
	$spt_17 = $spt_11 - $spt_14;
} else if ($sts_pegawai == "3") {
	$dipindahkan = "";
	$pindahan = "";
	$baru = "X";
	$pensiun = "";
	$spt_17 = $spt_15 + $spt_16;
} else if ($sts_pegawai == "4") {
	$dipindahkan = "";
	$pindahan = "";
	$baru = "";
	$pensiun = "X";
	$spt_17 = $spt_15 + $spt_16;
}

// $spt_19 = $spt_17 - $spt_18 ;


// ========================================================================================================== BENDAHARA
$query_bendahara = "SELECT * FROM mst_bendahara";
$response_bendahara = $model->getDataQuery($query_bendahara);

$nama_instansi = $response_bendahara[0]['nama_instansi'];
$nama_bendahara = $response_bendahara[0]['nama_bendahara'];
$npwp_bendahara = $response_bendahara[0]['npwp_bendahara'];
$nama_pemotong = $response_bendahara[0]['nama_pemotong'];
$nip_pemotong = $response_bendahara[0]['nip_pemotong'];
$npwp_pemotong = $response_bendahara[0]['npwp_pemotong'];

function terbilang($angka)
{
	$angka = (float) $angka;
	$bilangan = array(
		'',
		'satu',
		'dua',
		'tiga',
		'empat',
		'lima',
		'enam',
		'tujuh',
		'delapan',
		'sembilan',
		'sepuluh',
		'sebelas'
	);

	if ($angka < 12) {
		return $bilangan[$angka];
	} else if ($angka < 20) {
		return $bilangan[$angka - 10] . ' belas';
	} else if ($angka < 100) {
		$hasil_bagi = (int) ($angka / 10);
		$hasil_mod = $angka % 10;
		return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
	} else if ($angka < 200) {
		return sprintf('seratus %s', terbilang($angka - 100));
	} else if ($angka < 1000) {
		$hasil_bagi = (int) ($angka / 100);
		$hasil_mod = $angka % 100;
		return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
	} else if ($angka < 2000) {
		return trim(sprintf('seribu %s', terbilang($angka - 1000)));
	} else if ($angka < 1000000) {
		$hasil_bagi = (int) ($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
		$hasil_mod = $angka % 1000;
		return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
	} else if ($angka < 1000000000) {

		// hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
		$hasil_bagi = (int) ($angka / 1000000);
		$hasil_mod = $angka % 1000000;
		return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
	} else if ($angka < 1000000000000) {
		// bilangan 'milyaran'
		$hasil_bagi = (int) ($angka / 1000000000);
		$hasil_mod = fmod($angka, 1000000000);
		return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
	} else if ($angka < 1000000000000000) {
		// bilangan 'triliun'                           
		$hasil_bagi = $angka / 1000000000000;
		$hasil_mod = fmod($angka, 1000000000000);
		return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
	} else {
		return 'Wow...';
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!--<meta charset="utf-8">-->
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Print Invoice</title>
	<link rel="stylesheet" href="style4.css?n=1">
	<!--<style>-->
	<!--    #border-table, th, td {-->
	<!--            border: 0.5px solid black;-->
	<!--          }-->
	<!--</style>-->
</head>

<body>
	<!--==============START HEADER==============-->
	<div id="print-head">
		<div style="color: red; font-weight: bolder;background-color: white;" class="informasi">
			<input type="button" value="Print" onclick="window.print();">
			<input type="button" value="Close" onclick="window.close();">
		</div>
	</div>
	<!--==============END HEADER==============-->
	<!--==============START CONTENT==============-->
	<div id="print-content">
		<table style="width: 100%;" cellpadding="3">
			<tbody>
				<tr style="height: 18px;">
					<td style="width: 26.8137%; text-align: center; height: 64.3646px;border-right: 0.5px solid black;"
						rowspan="4">
						<span style="font-family: arial, helvetica, sans-serif;">
							<img style="width: 120px;" src="jombang.png" alt="">
						</span>
					</td>
					<td style="width: 43%; text-align: center; height: 64.3646px;border-right: 0.5px solid black;"
						colspan="3" rowspan="4">
						<span style="font-family: arial, helvetica, sans-serif;">
							<strong>BUKTI PEMOTONGAN PAJAK PENGHASILAN</strong>
							<strong>PASAL 21 BAGI PEGAWAI NEGERI SIPIL ATAU</strong>
							<strong>ANGGOTA TENTARA NASIONAL INDONESIA </strong>
							<strong>ATAU ANGGOTA POLISI REPUBLIK INDONESIA </strong>
							<strong>ATAU PEJABAT NEGARA ATAU PENSIUNANNYA</strong>
						</span>
					</td>
					<td style="width: 142%; height: 18px;" colspan="5">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
					</td>
				</tr>
				<tr style="height: 18px;">
					<td style="width: 142%; text-align: right; height: 18px;" colspan="5">
						<span style="font-family: arial, helvetica, sans-serif;">
							<strong>FORMULIR 1721 - A2</strong>
						</span>
					</td>
				</tr>
				<tr style="height: 19px;">
					<td style="width: 142%; height: 19px;" colspan="5">
						<span style="font-family: arial, helvetica, sans-serif;">Lembar ke-1 : untuk Penerima
							Penghasilan</span>
					</td>
				</tr>
				<tr style="height: 9.36459px;">
					<td style="width: 142%; height: 9.36459px;" colspan="5">
						<span style="font-family: arial, helvetica, sans-serif;">Lembar ke-2 : untuk Pemotong</span>
					</td>
				</tr>
				<tr style="height: 54px;">
					<td style="width: 26.8137%; height: 61px;border-right: 0.5px solid black;" rowspan="2">
						<div style="text-align: center;">
							<span style="font-family: arial, helvetica, sans-serif; font-size: 10pt;">
								<strong>KEMENTERIAN KEUANGAN RI</strong>
							</span>
						</div>
						<div style="text-align: center;">
							<span style="font-family: arial, helvetica, sans-serif; font-size: 10pt;">
								<strong>DIREKTORAT JENDERAL PAJAK</strong>
							</span>
						</div>
					</td>
					<td style="width: 53%; text-align: center; height: 61px;border-top: 0.5px solid black; border-right: 0.5px solid black;"
						colspan="4" rowspan="2">
						<span style="font-family: arial, helvetica, sans-serif;">
							<strong>NOMOR :</strong>
							<span style="font-size: 8pt;">H.01</span>&nbsp; &nbsp; <strong>1 . 2 -&nbsp; <span
									style="text-decoration: underline;">12</span> . <span
									style="text-decoration: underline;">
									<?= $yy2 ?>
								</span>. - <span style="text-decoration: underline;">
									<?= $nomor_surat ?>
								</span>
							</strong>
						</span>
					</td>
					<td style="width: 132%; text-align: center; height: 54px;" colspan="4">
						<div>
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>MASA PEROLEHAN</strong>
							</span>
						</div>
						<div>
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>PENGHASILAN [mm - mm]</strong>
							</span>
						</div>
					</td>
				</tr>
				<tr style="height: 7px;">
					<td style="width: 14%; text-align: center; height: 7px;">
						<span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">H.02</span>
					</td>
					<td style="width: 11%; text-align: center; height: 7px;">
						<span style="text-decoration: underline; font-family: arial, helvetica, sans-serif;">01</span>
					</td>
					<td style="width: 28%; text-align: center; height: 7px;">
						<span style="font-family: arial, helvetica, sans-serif;">-</span>
					</td>
					<td style="width: 79%; text-align: center; height: 7px;">
						<span style="text-decoration: underline; font-family: arial, helvetica, sans-serif;">12</span>
					</td>
				</tr>
			</tbody>
		</table>
		<table
			style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;"
			cellpadding="3">
			<tbody>
				<tr>
					<td style="width: 16%;">
						<span style="font-family: arial, helvetica, sans-serif;">NAMA INSTANSI / BADAN LAIN</span>
					</td>
					<td style="width: 2%;">
						<span style="font-family: arial, helvetica, sans-serif;">:</span>
					</td>
					<td style="width: 3%;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">H.03</span>
					</td>
					<td style="width: 37%;">
						<span style="font-family: arial, helvetica, sans-serif;">
							<?= $nama_instansi ?>
						</span>
					</td>
					<td style="width: 16%;">
						<span style="font-family: arial, helvetica, sans-serif;">NPWP BENDAHARA&nbsp;</span>
					</td>
					<td style="width: 10%;">
						<span style="font-family: arial, helvetica, sans-serif;">:&nbsp; <span
								style="font-size: 8pt;">H.05</span>
						</span>
					</td>
				</tr>
				<tr>
					<td style="width: 16%;">
						<span style="font-family: arial, helvetica, sans-serif;">NAMA BENDAHARA</span>
					</td>
					<td style="width: 2%;">
						<span style="font-family: arial, helvetica, sans-serif;">:</span>
					</td>
					<td style="width: 3%;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">H.04</span>
					</td>
					<td style="width: 37%;">
						<span style="font-family: arial, helvetica, sans-serif;">
							<?= $nama_bendahara ?>
						</span>
					</td>
					<td style="width: 26%; text-align: center;" colspan="2">
						<span style="font-family: arial, helvetica, sans-serif;">
							<!--<span style="text-decoration: underline;">00.120.561.6</span> - <span style="text-decoration: underline;">649</span> .&nbsp; <span style="text-decoration: underline;">000</span>-->
							<span style="text-decoration: underline;">
								<?= $npwp_pemotong ?>
							</span>
						</span>
					</td>
				</tr>
			</tbody>
		</table>
		<div>
			<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
		</div>
		<div>
			<span style="font-family: arial, helvetica, sans-serif;">
				<strong>&nbsp; A. IDENTITAS PENERIMA PENGHASILAN YANG DIPOTONG</strong>
			</span>
		</div>
		<table
			style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;"
			cellpadding="2">
			<tbody>
				<tr style="height: 1.17709px;">
					<td style="width: 21%; height: 1.17709px;">
						<span style="font-family: arial, helvetica, sans-serif;">1. NPWP</span>
					</td>
					<td style="width: 4%; height: 1.17709px;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">
							<span style="font-size: 8pt;">: A.01</span>
						</span>
					</td>
					<td style="width: 27%; height: 1.17709px;">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
							<?= $npwp ?>
						</span>
					</td>
					<td style="width: 18%; height: 1.17709px;">
						<span style="font-family: arial, helvetica, sans-serif;">6. Jenis Kelamin</span>
					</td>
					<td style="width: 2%; height: 1.17709px;">
						<span style="font-family: arial, helvetica, sans-serif;">:&nbsp; <span
								style="font-size: 8pt;">A.07</span>
						</span>
					</td>
					<td style="width: 176%; height: 1.17709px;">
						<table style="width: 100%;">
							<tbody>
								<tr>
									<td style="width: 14.5334%;">
										<table border="1">
											<tbody>
												<tr>
													<td>
														<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
															<?= $cowok ?>&nbsp;
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
									<td style="width: 64.4666%;">
										<span style="font-family: arial, helvetica, sans-serif;">LAKI - LAKI</span>
									</td>
									<td style="width: 2%;">
										<span
											style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">A.09</span>
									</td>
									<td style="width: 7%;">
										<table border="1">
											<tbody>
												<tr>
													<td>
														<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
															<?= $cewek ?>&nbsp;
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
									<td style="width: 7%;">
										<span style="font-family: arial, helvetica, sans-serif;">PEREMPUAN</span>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr style="height: 18px;">
					<td style="width: 21%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">2. NIP / NRP</span>
					</td>
					<td style="width: 4%; height: 18px;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">: A.02</span>
					</td>
					<td style="width: 27%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
							<?= $nip ?>
						</span>
					</td>
					<td style="width: 18%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">7. NIK</span>
					</td>
					<td style="width: 2%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">: <span style="font-size: 8pt;">
								A.09</span>
						</span>
					</td>
					<td style="width: 176%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">3517090506690004</span>
					</td>
				</tr>
				<tr style="height: 18px;">
					<td style="width: 21%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">3. NAMA</span>
					</td>
					<td style="width: 4%; height: 18px;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">: A.03</span>
					</td>
					<td style="width: 27%; height: 18px;">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
							<?= $nama_pegawai ?>
						</span>
					</td>
					<td style="width: 204%; height: 18px;" colspan="3">
						<span style="font-family: arial, helvetica, sans-serif;">8. STATUS / JUMLAH TANGGUNGAN KELUARGA
							UNTUK PTKP&nbsp;&nbsp;</span>
					</td>
				</tr>
				<tr style="height: 26px;">
					<td style="width: 21%; height: 26px;">
						<span style="font-family: arial, helvetica, sans-serif;">4. PANGKAT / GOLONGAN</span>
					</td>
					<td style="width: 4%; height: 26px;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">: A.04</span>
					</td>
					<td style="width: 27%; height: 26px;">
						<table style="width: 100%;">
							<tbody>
								<tr>
									<td style="width: 33.9054%;">
										<span style="font-family: arial, helvetica, sans-serif;">
											<?= $pangkat ?>
										</span>
									</td>
									<td style="width: 7.09461%;">
										<span style="font-family: arial, helvetica, sans-serif;">/ <span
												style="font-size: 8pt;">A.05</span>
										</span>
									</td>
									<td style="text-align: center; width: 21%;">
										<span style="font-family: arial, helvetica, sans-serif;">
											<?= $golongan ?>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="width: 204%; height: 26px; text-align: center;" colspan="3">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;K /
							<?= $jumlah_tanggungan_k ?>
							<span style="font-size: 8pt;">A.10&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp;</span>TK /
							<?= $jumlah_tanggungan_tk ?>
							<span style="font-size: 8pt;">A.11&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp;</span>HB /
							<?= $jumlah_tanggungan_hb ?>
							<span style="font-size: 8pt;">A.12</span>
						</span>
					</td>
				</tr>
				<tr style="height: 19px;">
					<td style="width: 21%; height: 19px;">
						<span style="font-family: arial, helvetica, sans-serif;">5. ALAMAT</span>
					</td>
					<td style="width: 4%; height: 19px;">
						<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">: A.06</span>
					</td>
					<td style="width: 27%; height: 19px;">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
							<?= $alamat ?>
						</span>
					</td>
					<td style="width: 18%; height: 19px;">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;9. NAMA JABATAN</span>
					</td>
					<td style="width: 2%; height: 19px;">
						<span style="font-family: arial, helvetica, sans-serif;">: <span
								style="font-size: 8pt;">A.13</span>
						</span>
					</td>
					<td style="width: 176%; height: 19px;">
						<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
							<?= $nama_jabatan ?>
						</span>
					</td>
				</tr>
			</tbody>
		</table>
		<div>
			<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
		</div>
		<div>
			<span style="font-family: arial, helvetica, sans-serif;">
				<strong>&nbsp; B. RINCIAN PENGHASILAN DAN PENGHITUNGAN PPh PASAL 21</strong>
			</span>
		</div>
		<div>
			<table
				style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;"
				cellpadding="2">
				<tbody>
					<tr style="height: 18px;">
						<td style="text-align: center; width: 60.82%; height: 18px;" colspan="2">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>URAIAN</strong>
							</span>
						</td>
						<td style="text-align: center; width: 22.18%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>JUMLAH (Rp)</strong>
							</span>
						</td>
					</tr>
					<tr style="height: 20.1597px;">
						<td style="width: 60.82%; text-align: center; height: 20.1597px;" colspan="2">
							<table style="width: 100%;">
								<tbody>
									<tr>
										<td style="width: 41%; text-align: left;">
											<span style="font-family: arial, helvetica, sans-serif;">
												<strong>KODE OBJEK PAJAK :</strong>
											</span>
										</td>
										<td style="width: 10%; text-align: right;">
											<table border="1">
												<tbody>
													<tr>
														<td>
															<span style="font-family: arial, helvetica, sans-serif;">
																<strong>&nbsp;X&nbsp;</strong>
															</span>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td style="width: 19%; text-align: left;">
											<span style="font-family: arial, helvetica, sans-serif;">
												<strong>21-100-01</strong>
											</span>
										</td>
										<td style="width: 10%;">
											<table border="1">
												<tbody>
													<tr>
														<td>
															<span style="font-family: arial, helvetica, sans-serif;">
																<strong>&nbsp; &nbsp;&nbsp;</strong>
															</span>
														</td>
													</tr>
												</tbody>
											</table>
										</td>
										<td style="width: 86%; text-align: left;">
											<span style="font-family: arial, helvetica, sans-serif;">
												<strong>21-100-02</strong>
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width: 22.18%; height: 20.1597px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 60.82%; height: 18px; text-align: left;" colspan="2">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>&nbsp;PENGHASILAN BRUTO :&nbsp;</strong>
							</span>
						</td>
						<td style="width: 22.18%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">1.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;GAJI POKOK / PENSIUN</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_01, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">2.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN ISTERI/SUAMI</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_02, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">3.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN ANAK</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_03, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">4.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">JUMLAH GAJI DAN TUNJANGAN KELUARGA
								(1 S.D. 3)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_04, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">5.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN PERBAIKAN
								PENGHASILAN</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_05, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">6.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN
								STRUKTURAL/FUNGSIONAL</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_06, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">7.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN BERAS</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_07, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">8.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN KHUSUS</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_08, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">9.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">TUNJANGAN LAIN-LAIN</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_09, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">10.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PENGHASILAN TETAP DAN TERATUR
								LAINNYA YANG PEMBAYARANNYA TERPISAH DARI PEMBAYARAN GAJI</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_10, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">11.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">JUMLAH PENGHASILAN BRUTO (4 S.D.
								10)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_11, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; height: 18px; text-align: left;" colspan="2">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>PENGURANGAN</strong>
							</span>
						</td>
						<td style="width: 22.18%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">12.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;BIAYA JABATAN/ BIAYA
								PENSIUN</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_12, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">13.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">IURAN PENSIUN ATAU IURAN THT</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_13, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">14.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">JUMLAH PENGURANGAN (12 S.D
								14)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_14, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; height: 18px; text-align: left;" colspan="2">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>PENGHITUNGAN PPh PASAL 21 :</strong>
							</span>
						</td>
						<td style="width: 22.18%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">15.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">JUMLAH PENGHASILAN NETO (11 -
								14)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_15, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">16.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">JUMLAH PENGHASILAN NETO MASA
								SEBELUMNYA</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_16, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">17.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">JUMLAH PENGHASILAN NETO UNTUK
								PENGHITUNGAN PPh PASAL 21 (SETAHUN/DISETAHUNKAN)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_17, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">18.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PENGHASILAN TIDAK KENA PAJAK
								(PTKP)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_18, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">19.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PENGHASILAN KENA PAJAK
								SETAHUN/DISETAHUNKAN (17 - 18)</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_19, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">20.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PPh PASAL 21 ATAS PENGHASILAN KENA
								PAJAK SETAHUN/DISETAHUNKAN</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_20, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">21.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PPh PASAL 21 YANG TELAH DIPOTONG
								MASA SEBELUMNYA</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_21, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">22.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PPh PASAL 21 TERUTANG</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_22, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">23.</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">PPh PASAL 21 YANG TELAH DIPOTONG
								DAN DILUNASI</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_23, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">23A.&nbsp;ATAS GAJI DAN
								TUNJANGAN</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_23_a, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
					<tr style="height: 18px;">
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
						<td style="width: 58.82%; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;">23B.&nbsp;ATAS PENGHASILAN TETAP
								DAN TERATUR LAINNYA YANG PEMBAYARANNYA TERPISAH DARI PEMBAYARAN GAJI</span>
						</td>
						<td style="width: 22.18%; height: 18px; text-align: right;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= str_replace(".00", "", number_format($spt_23_b, 2)) ?>
							</span>
						</td>
						<td style="width: 2%; text-align: center; height: 18px;">
							<span style="font-family: arial, helvetica, sans-serif;"></span>
						</td>
					</tr>
				</tbody>
			</table>
			<table style="width: 100%; padding-top: 15px;" cellpadding="3">
				<tbody>
					<tr>
						<td style="width: 56%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>C. PEGAWAI TERSEBUT :</strong>
							</span>
						</td>
						<td style="width: 10%;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">C.01</span>
						</td>
						<td style="width: 10%;">
							<table border="1">
								<tbody>
									<tr>
										<td>
											<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width: 2%;">
							<span style="font-family: arial, helvetica, sans-serif;">DIPINDAHKAN</span>
						</td>
						<td style="width: 1%;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
						<td style="width: 10%;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">C.02</span>
						</td>
						<td style="width: 3%;">
							<table border="">
								<tbody>
									<tr>
										<td>
											<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width: 10%;">
							<span style="font-family: arial, helvetica, sans-serif;">PINDAHAN</span>
						</td>
						<td style="width: 1%;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
						<td style="width: 1%;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">C.03</span>
						</td>
						<td style="width: 1%;">
							<table border="1">
								<tbody>
									<tr>
										<td>
											<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width: 1%;">
							<span style="font-family: arial, helvetica, sans-serif;">BARU</span>
						</td>
						<td style="width: 1%;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
						</td>
						<td style="width: 1%;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">C.04</span>
						</td>
						<td style="width: 1%;">
							<table border="1">
								<tbody>
									<tr>
										<td>
											<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
						<td style="width: 1%;">
							<span style="font-family: arial, helvetica, sans-serif;">PENSIUN</span>
						</td>
					</tr>
				</tbody>
			</table>
			<span style="font-family: arial, helvetica, sans-serif;">
				<strong>&nbsp;</strong>
			</span>
		</div>
		<div>
			<span style="font-family: arial, helvetica, sans-serif;">
				<strong>&nbsp; D. TANDA TANGAN BENDAHARA</strong>
			</span>
		</div>
		<div>
			<table
				style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;"
				cellpadding="2">
				<tbody>
					<tr>
						<td style="width: 20%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>1. NPWP</strong>
							</span>
						</td>
						<td style="width: 4.50841%;">
							<span style="font-family: arial, helvetica, sans-serif;">: <span
									style="font-size: 8pt;">D.01</span>
							</span>
						</td>
						<td style="width: 19.4916%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<?= $npwp_pemotong ?>
							</span>
						</td>
						<td style="width: 4%;">&nbsp;</td>
						<td style="width: 25%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>4. TANGGAL &amp; TANDA TANGAN</strong>
							</span>
						</td>
						<td style="width: 59%;" rowspan="3">
							<table style="width: 100%;" border="1">
								<tbody>
									<tr>
										<td style="text-align: center;">
											<p>
												<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
											</p>
											<p>
												<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
											</p>
											<p>
												<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
											</p>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>2. NAMA</strong>
							</span>
						</td>
						<td style="width: 4.50841%;">
							<span style="font-family: arial, helvetica, sans-serif;">: <span
									style="font-size: 8pt;">D.02</span>
							</span>
						</td>
						<td style="width: 19.4916%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<?= $nama_pemotong ?>
							</span>
						</td>
						<td style="width: 4%; text-align: center;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">D.04</span>
						</td>
						<td style="width: 25%; text-align: center;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;
								<?= $dd . "  -  " . $mm . "  -  " . $yy ?>
							</span>
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>3. NIP/NRP</strong>
							</span>
						</td>
						<td style="width: 4.50841%;">
							<span style="font-family: arial, helvetica, sans-serif;">: <span
									style="font-size: 8pt;">D.03</span>
							</span>
						</td>
						<td style="width: 19.4916%;">
							<span style="font-family: arial, helvetica, sans-serif;">
								<?= $nip_pemotong ?>
							</span>
						</td>
						<td style="width: 4%;">&nbsp;</td>
						<td style="width: 25%; text-align: center;">
							<span style="font-family: arial, helvetica, sans-serif;">[dd-mm-yyyy]</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--==============END CONTENT==============-->
</body>

</html>