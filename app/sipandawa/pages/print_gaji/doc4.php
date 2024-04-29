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

date_default_timezone_set("Asia/Jakarta");
$yy = date("Y");
$mm = date("m");
$dd = date("d");

$yy2 = substr($yy, 2);

function tanggal_indo($tgl)
{
	$bulan = array(
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecah = explode('-', $tgl);


	return $pecah[2] . ' ' . $bulan[(int) $pecah[1]] . ' ' . $pecah[0];
}


#################################################################################################################################################################################### DATA PEGAWAI
$q_pegawai = "SELECT * FROM mst_pegawai WHERE nip = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_pegawai = $model->getDataQuery($q_pegawai);

$nip = $res_pegawai[0]['nip'];
$nama_pegawai = $res_pegawai[0]['nama_pegawai'];
$tanggal_lahir = $res_pegawai[0]['tanggal_lahir'];
$nama_jabatan = $res_pegawai[0]['nama_jabatan'];
$golongan = $res_pegawai[0]['golongan'];
$nmsatker = $res_pegawai[0]['nmsatker'];

#################################################################################################################################################################################### DATA PEGAWAI END

#################################################################################################################################################################################### TPP
$q_gaji = "SELECT * FROM mst_pegawai WHERE nip = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_gaji = $model->getDataQuery($q_gaji);

$bulan = 0;

$gaji_pokok = 0;
$tunjangan_istri = 0;
$tunjangan_anak = 0;
$tunjangan_tambahan_penghasilan = 0;
$tunjangan_struktural = 0;
$tunjangan_fungsional = 0;
$tunjangan_umum = 0;
$tunjangan_kemahalan = 0;
$tunjangan_terpencil = 0;
$tunjangan_beras = 0;
$tunjangan_pajak = 0;
$tunjangan_askes = 0;
$tunjangan_jkk = 0;
$tunjangan_jkm = 0;
$pembulatan = 0;

$jumlah_kotor = 0;

$potongan_iwp = 0;
$potongan_askes = 0;
$potongan_pajak = 0;
$potongan_taperum = 0;
$potongan_bulog = 0;
$potongan_sewa_rumah = 0;
$potongan_hutang = 0;
$potongan_jkk = 0;
$potongan_jkm = 0;

$jumlah_potongan = 0;

$jumlah_bersih = 0;

for ($i = 0; $i < sizeof($res_gaji); $i++) {
	$bulan += $res_gaji[$i]['bulan'];

	$gaji_pokok += $res_gaji[$i]['belanja_gaji_pokok'];
	$tunjangan_istri += $res_gaji[$i]['perhitungan_suami_istri'];
	$tunjangan_anak += $res_gaji[$i]['belanja_gaji_pokok'];
	$tunjangan_tambahan_penghasilan += $res_gaji[$i]['perhitungan_anak'];
	$tunjangan_struktural += $res_gaji[$i]['belanja_tunjangan_jabatan'];
	$tunjangan_fungsional += $res_gaji[$i]['belanja_tunjangan_fungsional'];
	$tunjangan_umum += $res_gaji[$i]['belanja_tunjangan_fungsional_umum'];
	// $tunjangan_kemahalan += $res_gaji[$i]['belanja_gaji_pokok'];
	// $tunjangan_terpencil += $res_gaji[$i]['belanja_gaji_pokok'];
	$tunjangan_beras += $res_gaji[$i]['belanja_tunjangan_beras'];
	// $tunjangan_pajak += $res_gaji[$i]['belanja_gaji_pokok'];
	// $tunjangan_askes += $res_gaji[$i]['belanja_gaji_pokok'];
	// $tunjangan_jkk += $res_gaji[$i]['belanja_gaji_pokok'];
	// $tunjangan_jkm += $res_gaji[$i]['belanja_gaji_pokok'];
	$pembulatan += $res_gaji[$i]['belanja_pembulatan_gaji'];

	$potongan_iwp += $res_gaji[$i]['iwp_1'];
	// $potongan_askes += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_pajak += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_taperum += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_bulog += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_sewa_rumah += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_hutang += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_jkk += $res_gaji[$i]['belanja_gaji_pokok'];
	// $potongan_jkm += $res_gaji[$i]['belanja_gaji_pokok'];
	$jumlah_potongan += $res_gaji[$i]['jumlah_potongan'];


}
#################################################################################################################################################################################### TPP END

#################################################################################################################################################################################### BENDAHARA
$query_kepala = "SELECT * FROM mst_kepala";
$response_kepala = $model->getDataQuery($query_kepala);

$nama_kepala = $response_kepala[0]['nama_kepala'];
$jabatan_kepala = $response_kepala[0]['jabatan_kepala'];
$nip_kepala = $response_kepala[0]['nip_kepala'];

#################################################################################################################################################################################### BENDAHARA END

#################################################################################################################################################################################### BENDAHARA
$query_bendahara = "SELECT * FROM mst_bendahara";
$response_bendahara = $model->getDataQuery($query_bendahara);

$nama_pemotong = $response_bendahara[0]['nama_pemotong'];
$nip_pemotong = $response_bendahara[0]['nip_pemotong'];
#################################################################################################################################################################################### BENDAHARA END

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
<html>

<head>
	<meta charset="utf-8" />
	<title>Surat Keterangan Penghasilan Pegawai</title>
	<link rel="stylesheet" href="style-gaji.css">
</head>

<body>
	<div id="print-head">
		<div class="informasi">
			<input type="button" value="Cetak" onclick="window.print();">
			<input type="button" value="Tutup" onclick="window.close();">
		</div>
	</div>
	<div id="print-content">
		<div class="invoice-box">
			<tr class="top">
				<td colspan="2">
					<table width="73%" cellpadding="3" style="width: 100%;">
						<tr style="height: 20px;">
							<td width="18%" rowspan="2" style="width: 20%; text-align: center; height: 60px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<img src="bpkad-jombang.png" class="img" />
								</span>
							</td>
							<td width="82%" rowspan="2" style="width: 80%; text-align: center; height: 64.3646px;">
								<div>
									<span>
										<strong>PEMERINTAH KABUPATEN JOMBANG</strong>
									</span>
								</div>

								<div>
									<span>
										<strong>BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH</strong>
									</span>
								</div>
								<div>
									Jl KH Wahid Hasyim No. 49 Jombang Jawa Timur Telp : (0321)861684 Fax : (0321) 851060
								</div>
							</td>
						</tr>
					</table>
					<hr>
				</td>
			</tr>

			<tr class="heading">
				<div>
					<span style="text-align: center">
						<h4>SURAT KETERANGAN PENGHASILAN</h4>
					</span>
				</div>
			</tr>

			<tr class="paragraph">
				<div>
					<span style="font-family: arial, helvetica, sans-serif;">
						Yang bertanda tangan di bawah ini :
					</span>
				</div>
			</tr>

			<tr class="kepala">
				<table style="width: 95%;" align="center">
					<tbody>
						<tr style="height: 10px;">
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Nama
								</span>
							</td>
							<td style="height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 100%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $nama_kepala ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Jabatan
								</span>
							</td>
							<td style="height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 100%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $jabatan_kepala ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 21%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									NIP
								</span>
							</td>
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 27%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $nip_kepala ?>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
			</tr>

			<tr class="paragraph">
				<div>
					<span style="font-family: arial, helvetica, sans-serif;">
						Dengan ini menerangkan bahwa pegawai tersebut :
					</span>
				</div>
			</tr>

			<tr class="pegawai">
				<table style="width: 95%;" align="center">
					<tbody>
						<tr style="height: 10px;">
							<td style="height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									NIP
								</span>
							</td>
							<td style="height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 100%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $nip ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 21%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Nama
								</span>
							</td>
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 27%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $nama_pegawai ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 21%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Tanggal Lahir
								</span>
							</td>
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 27%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $tanggal_lahir ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 21%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Jabatan
								</span>
							</td>
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 27%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $nama_jabatan ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 21%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Pangkat/Gol
								</span>
							</td>
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 27%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $golongan ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td style="width: 21%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Unit Kerja
								</span>
							</td>
							<td style="height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 27%; height: 1px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									&nbsp;
									<?= $nmsatker ?>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
			</tr>

			<tr class="paragraph">
				<div>
					<span style="font-family: arial, helvetica, sans-serif;">
						Adapun penghasilan gaji bulan
						<?= $mm ?> sebagai berikut :
					</span>
				</div>
			</tr>

			<tr class="total-gaji">
				<table style="width: 95%;" align="center">
					<tbody>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Gaji Pokok
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($gaji_pokok, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan IWP
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_iwp, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Istri
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_istri, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan Askes
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_askes, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Anak
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_anak, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan Pajak
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_pajak, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunj. Tambahan Penghasilan
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_tambahan_penghasilan, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan Taperum
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_taperum, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Struktural
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_struktural, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan Bulog
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_bulog, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Fungsional
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_fungsional, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan Sewa Rumah
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_sewa_rumah, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Umum
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_umum, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan Hutang/Lain2
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_hutang, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Kemahalan
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_kemahalan, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan JKK
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_jkk, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Terpencil
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_terpencil, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Potongan JKM
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($potongan_jkm, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Beras
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_beras, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Pajak
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_pajak, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan Askes
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_askes, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									Jumlah Potongan
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($jumlah_potongan, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan JKK
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_jkk, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Tunjangan JKM
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($tunjangan_jkm, 2)) ?>
								</span>
							</td>
						</tr>
						<tr style="height: 10px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									Pembulatan
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($pembulatan, 2)) ?>
								</span>
							</td>
						</tr>

						<tr style="height: 50px;">
							<td width="30%">
								<span style="font-family: arial, helvetica, sans-serif">
									<strong>Jumlah Kotor</strong>
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 20%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($jumlah_kotor, 2)) ?>
								</span>
							</td>
							<td style="width: 30%; height: 18px; text-align: left;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<strong>Jumlah Bersih</strong>
								</span>
							</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									:
								</span>
							</td>
							<td style="width: 30%; height: 10px;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<?= str_replace(".00", "", number_format($jumlah_bersih, 2)) ?>
								</span>
							</td>
						</tr>


					</tbody>
				</table>

			</tr>

			<div>
				<span style="font-family: arial, helvetica, sans-serif;">
					Demikian Surat Keterangan Penghasilan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
				</span>
			</div>
			</tr>
			</tr>

			<div>
				<table width="100%">
					<tbody>
						<tr>
							<td width="10%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="10%">
								<?= tanggal_indo(date('Y-m-d')); ?>
							</td>
						</tr>
						<tr>
							<td>BENDAHARA PENGELUARAN</td>
							<td>&nbsp;</td>
							<td>KEPALA BPKAD KABUPATEN JOMBANG</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td height="100"></td>
						</tr>
						<tr>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">

									<?= $nama_pemotong ?>
								</span>
							</td>
							<td>&nbsp;</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">

									<?= $nama_kepala ?>
								</span>
							</td>
						</tr>
						<tr>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									NIP:
									<?= $nip_pemotong ?>
								</span>
							</td>
							<td>&nbsp;</td>
							<td>
								<span style="font-family: arial, helvetica, sans-serif;">
									NIP:
									<?= $nip_kepala ?>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			</tr>
		</div>
	</div>
</body>

</html>