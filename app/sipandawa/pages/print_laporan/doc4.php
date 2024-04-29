<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$nip = $_GET['nip'];

$start = $_GET['start'];
$arr_start = explode("-",$start);
$bulan_awal = $arr_start[0];
$tahun_awal = $arr_start[1];

$end = $_GET['end'];
$arr_end = explode("-",$end);
$bulan_akhir = $arr_end[0];
$tahun_akhir = $arr_end[1];

date_default_timezone_set("Asia/Jakarta"); 
$yy = date("Y");
$mm = date("m");
$dd = date("d");

$yy2 = substr($yy, 2);


#################################################################################################################################################################################### DATA PEGAWAI
$q_pegawai = "SELECT * FROM mst_pegawai WHERE nip = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_pegawai = $model->getDataQuery($q_pegawai);

$nip                    = $res_pegawai[0]['nip'];
$nama_pegawai           = $res_pegawai[0]['nama_pegawai'];
$npwp                   = $res_pegawai[0]['npwp'];
$alamat                 = $res_pegawai[0]['alamat'];
$nik                    = $res_pegawai[0]['nik'];
$nama_jabatan           = $res_pegawai[0]['nama_jabatan'];
#################################################################################################################################################################################### DATA PEGAWAI END


#################################################################################################################################################################################### TPP
$q_tpp = "SELECT * FROM mst_tpp WHERE nip = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_tpp = $model->getDataQuery($q_tpp);


$bruto = 0;
$bebankerja_tpp = 0;
$bebankerja_pph = 0;
$bebankerja_netto = 0;
$prestasikerja_tpp = 0;
$prestasikerja_pph = 0;
$prestasikerja_netto = 0;
$kondisikerja_tpp = 0;
$kondisikerja_pph = 0;
$kondisikerja_netto = 0;

$jumlah = 0;
$potongan_pph = 0;
$jumlah_tpp = 0;
$potongan_iwp = 0;
$tpp_diterima = 0;

for($i=0; $i < sizeof($res_tpp); $i++) {
    $bruto += $res_tpp[$i]['bruto'];
    $bebankerja_tpp += $res_tpp[$i]['bebankerja_tpp'];
    $bebankerja_pph += $res_tpp[$i]['bebankerja_pph'];
    $bebankerja_netto += $res_tpp[$i]['bebankerja_netto'];
    $prestasikerja_tpp += $res_tpp[$i]['prestasikerja_tpp'];
    $prestasikerja_pph += $res_tpp[$i]['prestasikerja_pph'];
    $prestasikerja_netto += $res_tpp[$i]['prestasikerja_netto'];
    $kondisikerja_tpp += $res_tpp[$i]['kondisikerja_tpp'];
    $kondisikerja_pph += $res_tpp[$i]['kondisikerja_pph'];
    $kondisikerja_netto += $res_tpp[$i]['kondisikerja_netto'];
    $jumlah += $res_tpp[$i]['jumlah'];
    $potongan_pph += $res_tpp[$i]['potongan_pph'];
    $jumlah_tpp += $res_tpp[$i]['jumlah_tpp'];
    $potongan_iwp += $res_tpp[$i]['potongan_iwp'];
    $tpp_diterima += $res_tpp[$i]['tpp_diterima'];
}
#################################################################################################################################################################################### TPP END

#################################################################################################################################################################################### HONOR
$q_honor = "SELECT * FROM mst_honor WHERE create_by = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_honor = $model->getDataQuery($q_honor);

$nominal_honor = 0;
$potongan_honor = 0;
$total_honor = 0;

for($x=0; $x < sizeof($res_honor); $x++) {
    $nominal_honor += $res_honor[$x]['nominal_honor'];
    $potongan_honor += $res_honor[$x]['potongan_honor'];
    $total_honor += $res_honor[$x]['total_honor'];
}
#################################################################################################################################################################################### TPP HONOR

#################################################################################################################################################################################### SPPD
$q_sppd = "SELECT * FROM mst_sppd WHERE create_by = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_sppd = $model->getDataQuery($q_sppd);

$nominal_sppd = 0;

for($s=0; $s < sizeof($res_sppd); $s++) {
    $nominal_sppd += $res_sppd[$s]['nominal_sppd'];
}
#################################################################################################################################################################################### TPP SPPD

#################################################################################################################################################################################### LEMBUR
$q_lembur = "SELECT * FROM mst_lembur WHERE create_by = '$nip' AND bulan >= '$bulan_awal' AND bulan <='$bulan_akhir' AND tahun >= '$tahun_awal' AND tahun <= '$tahun_akhir'";
$res_lembur = $model->getDataQuery($q_lembur);

$nominal_lembur = 0;
$potongan_lembur = 0;
$total_lembur = 0;

for($p=0; $p < sizeof($res_lembur); $p++) {
    $nominal_lembur += $res_lembur[$p]['nominal_lembur'];
    $potongan_lembur += $res_lembur[$p]['potongan_lembur'];
    $total_lembur += $res_lembur[$p]['total_lembur'];
}
#################################################################################################################################################################################### TPP LEMBUR

#################################################################################################################################################################################### BENDAHARA
$query_bendahara = "SELECT * FROM mst_bendahara";
$response_bendahara = $model->getDataQuery($query_bendahara);

$nama_instansi   = $response_bendahara[0]['nama_instansi']; 
$nama_bendahara  = $response_bendahara[0]['nama_bendahara'];
$npwp_bendahara  = $response_bendahara[0]['npwp_bendahara'];
$nama_pemotong   = $response_bendahara[0]['nama_pemotong'];
$nip_pemotong    = $response_bendahara[0]['nip_pemotong'];
$npwp_pemotong   = $response_bendahara[0]['npwp_pemotong'];
#################################################################################################################################################################################### BENDAHARA END

function terbilang($angka) {
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
					<tr style="height: 20px;">
						<td style="width: 26.8137%; text-align: center; height: 64.3646px;" rowspan="4">
							<span style="font-family: arial, helvetica, sans-serif;">
								<img style="width: 120px;" src="bpkad-jombang.png" alt="">
							</span>
						</td>
						<td style="width: 80%; text-align: center; height: 64.3646px;" rowspan="4">
							<span style="font-family: arial, helvetica, sans-serif;">
								<strong>PEMERINTAH KABUPATEN JOMBANG</strong><br>
								
								<strong>BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH</strong><br>
								<strong>Jl. K.H. Wahid Hasyim No. 49 Jombang61411</strong><br>
								<strong>Telp. (0321) 861684, Fax. -,  e-mail: bpkad@jombangkab.go.id</strong>
							</span>
						</td>
					</tr>
					
				</tbody>
			</table>
			<hr>
			
			<table style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;" cellpadding="2">
				<tbody>
				    <tr style="height: 1.17709px;">
						<td style="width: 21%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">NIP</span>
						</td>
						<td style="width: 4%; height: 1.17709px;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">
								<span style="font-size: 8pt;">:</span>
							</span>
						</td>
						<td style="width: 27%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?= $nip ?></span>
						</td>
					</tr>
					<tr style="height: 1.17709px;">
						<td style="width: 21%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">NAMA</span>
						</td>
						<td style="width: 4%; height: 1.17709px;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">
								<span style="font-size: 8pt;">:</span>
							</span>
						</td>
						<td style="width: 27%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?= $nama_pegawai ?></span>
						</td>
					</tr>
					
					<tr style="height: 1.17709px;">
						<td style="width: 21%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">NIK</span>
						</td>
						<td style="width: 4%; height: 1.17709px;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">
								<span style="font-size: 8pt;">:</span>
							</span>
						</td>
						<td style="width: 27%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?= $nik ?></span>
						</td>
					</tr>
					
					<tr style="height: 1.17709px;">
						<td style="width: 21%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">Jabatan</span>
						</td>
						<td style="width: 4%; height: 1.17709px;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">
								<span style="font-size: 8pt;">:</span>
							</span>
						</td>
						<td style="width: 27%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?= $nama_jabatan ?></span>
						</td>
					</tr>
					
					<tr style="height: 1.17709px;">
						<td style="width: 21%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">Alamat</span>
						</td>
						<td style="width: 4%; height: 1.17709px;">
							<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">
								<span style="font-size: 8pt;">:</span>
							</span>
						</td>
						<td style="width: 27%; height: 1.17709px;">
							<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?= $alamat ?></span>
						</td>
					</tr>
				</tbody>
			</table>
			<div>
				<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
			</div>
			<div>
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp; A. RINCIAN PENGHASILAN TPP</strong>
				</span>
			</div>
			<div>
				<table style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;" cellpadding="2">
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
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;1.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TPP BRUTO</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($bruto, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						
						<!--############################################################################################################################-->
						<tr style="height: 18px;">
							<td style="width: 2%; height: 18px; text-align: left;" colspan="2">
								<span style="font-family: arial, helvetica, sans-serif;">
									<strong>BEBAN KERJA</strong>
								</span>
							</td>
							<td style="width: 22.18%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;2.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TPP</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($bebankerja_tpp, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;3.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">PPH</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($bebankerja_pph, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;4.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">NETTO</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($bebankerja_netto, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						<!--############################################################################################################################-->
						
						<!--############################################################################################################################-->
						<tr style="height: 18px;">
							<td style="width: 2%; height: 18px; text-align: left;" colspan="2">
								<span style="font-family: arial, helvetica, sans-serif;">
									<strong>PRESTASI KERJA</strong>
								</span>
							</td>
							<td style="width: 22.18%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;5.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TPP</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($prestasikerja_tpp, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;6.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">PPH</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($prestasikerja_pph, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;7.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">NETTO</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($prestasikerja_netto, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						<!--############################################################################################################################-->
						
						<!--############################################################################################################################-->
						<tr style="height: 18px;">
							<td style="width: 2%; height: 18px; text-align: left;" colspan="2">
								<span style="font-family: arial, helvetica, sans-serif;">
									<strong>KONDISI KERJA</strong>
								</span>
							</td>
							<td style="width: 22.18%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;</span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;8.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TPP</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($kondisikerja_tpp, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;9.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">PPH</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($kondisikerja_pph, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;10.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">NETTO</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($kondisikerja_netto, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						<!--############################################################################################################################-->
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;11.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">JUMLAH</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($jumlah, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;12.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">POTONGAN PPH</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($potongan_pph, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;13.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">JUMLAH TPP DITERIMA</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($jumlah_tpp, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;14.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">POTONGAN IWP 1%</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($potongan_iwp, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;12.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TPP DITERIMA</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($tpp_diterima, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
					</tbody>
				</table>
				
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp;</strong>
				</span>
			</div>
			
			<!--################################################################################################################################################################################# HONOR-->
			
			<div>
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp; B. HONORARIUM</strong>
				</span>
			</div>
			<div>
				<table style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;" cellpadding="2">
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
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;1.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">NOMINAL</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($nominal_honor, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;2.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">POTONGAN</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($potongan_honor, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;3.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TOTAL</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($total_honor, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
					</tbody>
				</table>
				
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp;</strong>
				</span>
			</div>
			
			<!--################################################################################################################################################################################# HONOR END -->
			
			<!--################################################################################################################################################################################# SPPD-->
			
			<div>
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp; C. SPPD</strong>
				</span>
			</div>
			<div>
				<table style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;" cellpadding="2">
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
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;1.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">NOMINAL</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($nominal_sppd, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
					</tbody>
				</table>
				
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp;</strong>
				</span>
			</div>
			
			<!--################################################################################################################################################################################# SPPD END -->
			
			<!--################################################################################################################################################################################# LEMBUR-->
			
			<div>
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp; D. LEMBUR</strong>
				</span>
			</div>
			<div>
				<table style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;" cellpadding="2">
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
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;1.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">NOMINAL</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($nominal_lembur, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;2.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">POTONGAN</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($potongan_lembur, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
						<tr style="height: 18px;">
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;&nbsp;3.</span>
							</td>
							<td style="width: 58.82%; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;">TOTAL</span>
							</td>
							<td style="width: 22.18%; height: 18px; text-align: right;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?=  str_replace(".00", "", number_format($total_lembur, 2)) ?></span>
							</td>
							<td style="width: 2%; text-align: center; height: 18px;">
								<span style="font-family: arial, helvetica, sans-serif;"></span>
							</td>
						</tr>
						
					</tbody>
				</table>
				
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp;</strong>
				</span>
			</div>
			
			<!--################################################################################################################################################################################# LEMBUR END -->
			
			<div>
				<span style="font-family: arial, helvetica, sans-serif;">
					<strong>&nbsp; E. TANDA TANGAN BENDAHARA</strong>
				</span>
			</div>
			<div>
				<table style="width: 100%;border-right: 0.5px solid black;border-top: 0.5px solid black;border-left: 0.5px solid black;border-bottom: 0.5px solid black;" cellpadding="2">
					<tbody>
						<tr>
							<td style="width: 20%;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<strong>1. NPWP</strong>
								</span>
							</td>
							<td style="width: 4.50841%;">
								<span style="font-family: arial, helvetica, sans-serif;">: <span style="font-size: 8pt;">D.01</span>
								</span>
							</td>
							<td style="width: 19.4916%;">
								<span style="font-family: arial, helvetica, sans-serif;"><?= $npwp_pemotong ?></span>
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
								<span style="font-family: arial, helvetica, sans-serif;">: <span style="font-size: 8pt;">D.02</span>
								</span>
							</td>
							<td style="width: 19.4916%;">
								<span style="font-family: arial, helvetica, sans-serif;"><?= $nama_pemotong ?>I</span>
							</td>
							<td style="width: 4%; text-align: center;">
								<span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">D.04</span>
							</td>
							<td style="width: 25%; text-align: center;">
								<span style="font-family: arial, helvetica, sans-serif;">&nbsp;<?= $dd ."  -  ". $mm ."  -  ". $yy ?></span>
							</td>
						</tr>
						<tr>
							<td style="width: 20%;">
								<span style="font-family: arial, helvetica, sans-serif;">
									<strong>3. NIP/NRP</strong>
								</span>
							</td>
							<td style="width: 4.50841%;">
								<span style="font-family: arial, helvetica, sans-serif;">: <span style="font-size: 8pt;">D.03</span>
								</span>
							</td>
							<td style="width: 19.4916%;">
								<span style="font-family: arial, helvetica, sans-serif;"><?= $nip_pemotong ?></span>
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