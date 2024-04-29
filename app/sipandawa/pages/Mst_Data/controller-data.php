<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_POST['action'];
switch ($ACTION) {

    case "listTable":
        $id_user = trim($_POST['id_user']);
        $id_level = trim($_POST['id_level']);

        $response = $model->getAllData("mst_pegawai");
        echo json_encode($response);
        break;


    case "commit_data";
        $bulan = trim($_POST['bulan']);
        $tahun = trim($_POST['tahun']);
        $myArray = json_decode($_POST['jsonArr'], true);

        $urut = 0;
        for ($i = 0; $i < count($myArray); $i++) {

            $nip = trim($myArray[$i]['nip']);
            $no = trim($urut++);
            $nama_pegawai = trim($myArray[$i]['nama_pegawai']);
            $nik = trim($myArray[$i]['nik']);
            // $jk                             =  trim($myArray[$i]['jk']);
            // $sts_pegawai                    =  trim($myArray[$i]['sts_pegawai']);
            $tanggal_lahir = trim($myArray[$i]['tanggal_lahir']);
            $alamat = trim($myArray[$i]['alamat']);
            $tipe_jabatan = trim($myArray[$i]['tipe_jabatan']);
            $eselon = trim($myArray[$i]['eselon']);
            $golongan = trim($myArray[$i]['golongan']);
            $pppk_pns = trim($myArray[$i]['pppk_pns']);
            $nama_jabatan = trim($myArray[$i]['nama_jabatan']);
            $status_pernikahan = trim($myArray[$i]['status_pernikahan']);
            $nip_pasangan = trim($myArray[$i]['nip_pasangan']);
            $is_pasangan_pns = trim($myArray[$i]['is_pasangan_pns']);
            $kode_bank = trim($myArray[$i]['kode_bank']);
            $nama_bank = trim($myArray[$i]['nama_bank']);
            $npwp = trim($myArray[$i]['npwp']);
            $nomor_rekening_bank_pegawai = trim($myArray[$i]['nomor_rekening_bank_pegawai']);
            $tipe_k = trim($myArray[$i]['tipe_k']);
            $jumlah_anak = trim($myArray[$i]['jumlah_anak']);
            $jumlah_istri_suami = trim($myArray[$i]['jumlah_istri_suami']);
            $jumlah_tanggungan = trim($myArray[$i]['jumlah_tanggungan']);
            $belanja_gaji_pokok = trim($myArray[$i]['belanja_gaji_pokok']);
            $perhitungan_suami_istri = trim($myArray[$i]['perhitungan_suami_istri']);
            $perhitungan_anak = trim($myArray[$i]['perhitungan_anak']);
            $belanja_tunjangan_keluarga = trim($myArray[$i]['belanja_tunjangan_keluarga']);
            $belanja_tunjangan_jabatan = trim($myArray[$i]['belanja_tunjangan_jabatan']);
            $belanja_tunjangan_fungsional = trim($myArray[$i]['belanja_tunjangan_fungsional']);
            $jumlah_gaji_tunjangan = trim($myArray[$i]['jumlah_gaji_tunjangan']);
            $belanja_tunjangan_fungsional_umum = trim($myArray[$i]['belanja_tunjangan_fungsional_umum']);
            $belanja_tunjangan_beras = trim($myArray[$i]['belanja_tunjangan_beras']);
            $belanja_tunjangan_pph = trim($myArray[$i]['belanja_tunjangan_pph']);
            $belanja_pembulatan_gaji = trim($myArray[$i]['belanja_pembulatan_gaji']);
            $belanja_iuran_jaminan_kesehatan = trim($myArray[$i]['belanja_iuran_jaminan_kesehatan']);
            $belanja_iuran_jaminan_kecelakaan_kerja = trim($myArray[$i]['belanja_iuran_jaminan_kecelakaan_kerja']);
            $belanja_iuran_jaminan_kematian = trim($myArray[$i]['belanja_iuran_jaminan_kematian']);
            $tunjangan_jaminan_hari_tua = trim($myArray[$i]['tunjangan_jaminan_hari_tua']);
            $tunjangan_jaminan_pensiun = trim($myArray[$i]['tunjangan_jaminan_pensiun']);
            $iwp_1 = trim($myArray[$i]['iwp_1%']);
            $belanja_iuran_simpanan_tapera = trim($myArray[$i]['belanja_iuran_simpanan_tapera']);
            $tunjangan_khusus_papua = trim($myArray[$i]['tunjangan_khusus_papua']);
            $jumlah_potongan = trim($myArray[$i]['jumlah_potongan']);
            $jumlah_ditransfer = trim($myArray[$i]['jumlah_ditransfer']);
            $mkg = trim($myArray[$i]['mkg']);
            $pph_21 = trim($myArray[$i]['pph_21']);
            $zakat = trim($myArray[$i]['zakat']);
            $bulog = trim($myArray[$i]['bulog']);
            $nmsatker = trim($myArray[$i]['nmsatker']);



            // ================================================================ CEK DATA PEGAWAI
            $idWhere = array(
                'nip' => $nip
                ,
                'bulan' => $bulan
                ,
                'tahun' => $tahun
            );
            $cekMstPegawai = $model->getData("mst_pegawai", $idWhere);
            $contMstPegawai = sizeof($cekMstPegawai);
            // ================================================================ CEK DATA PEGAWAI

            // ################################# // INSERT DATA PEGAWAI


            if ($contMstPegawai == 0) {
                $fieldValue = array(
                    'nip' => $nip
                    ,
                    'no' => $no
                    ,
                    'nama_pegawai' => $nama_pegawai
                    ,
                    'nik' => $nik
                    // ,'jk'               =>$jk
                    // ,'sts_pegawai'      =>$sts_pegawai
                    ,
                    'tanggal_lahir' => $tanggal_lahir
                    ,
                    'alamat' => $alamat
                    ,
                    'tipe_jabatan' => $tipe_jabatan
                    ,
                    'eselon' => $eselon
                    ,
                    'golongan' => $golongan
                    ,
                    'pppk_pns' => $pppk_pns
                    ,
                    'nama_jabatan' => $nama_jabatan
                    ,
                    'status_pernikahan' => $status_pernikahan
                    ,
                    'nip_pasangan' => $nip_pasangan
                    ,
                    'is_pasangan_pns' => $is_pasangan_pns
                    ,
                    'kode_bank' => $kode_bank
                    ,
                    'nama_bank' => $nama_bank
                    ,
                    'npwp' => $npwp
                    ,
                    'nomor_rekening_bank_pegawai' => $nomor_rekening_bank_pegawai
                    ,
                    'tipe_k' => $tipe_k
                    ,
                    'jumlah_anak' => $jumlah_anak
                    ,
                    'jumlah_istri_suami' => $jumlah_istri_suami
                    ,
                    'jumlah_tanggungan' => $jumlah_tanggungan
                    ,
                    'belanja_gaji_pokok' => $belanja_gaji_pokok
                    ,
                    'perhitungan_suami_istri' => $perhitungan_suami_istri
                    ,
                    'perhitungan_anak' => $perhitungan_anak
                    ,
                    'belanja_tunjangan_keluarga' => $belanja_tunjangan_keluarga
                    ,
                    'belanja_tunjangan_jabatan' => $belanja_tunjangan_jabatan
                    ,
                    'belanja_tunjangan_fungsional' => $belanja_tunjangan_fungsional
                    ,
                    'jumlah_gaji_tunjangan' => $jumlah_gaji_tunjangan
                    ,
                    'belanja_tunjangan_fungsional_umum' => $belanja_tunjangan_fungsional_umum
                    ,
                    'belanja_tunjangan_beras' => $belanja_tunjangan_beras
                    ,
                    'belanja_tunjangan_pph' => $belanja_tunjangan_pph
                    ,
                    'belanja_pembulatan_gaji' => $belanja_pembulatan_gaji
                    ,
                    'belanja_iuran_jaminan_kesehatan' => $belanja_iuran_jaminan_kesehatan
                    ,
                    'belanja_iuran_jaminan_kecelakaan_kerja' => $belanja_iuran_jaminan_kecelakaan_kerja
                    ,
                    'belanja_iuran_jaminan_kematian' => $belanja_iuran_jaminan_kematian
                    ,
                    'tunjangan_jaminan_hari_tua' => $tunjangan_jaminan_hari_tua
                    ,
                    'tunjangan_jaminan_pensiun' => $tunjangan_jaminan_pensiun
                    ,
                    'iwp_1' => $iwp_1
                    ,
                    'belanja_iuran_simpanan_tapera' => $belanja_iuran_simpanan_tapera
                    ,
                    'tunjangan_khusus_papua' => $tunjangan_khusus_papua
                    ,
                    'jumlah_potongan' => $jumlah_potongan
                    ,
                    'jumlah_ditransfer' => $jumlah_ditransfer
                    ,
                    'mkg' => $mkg
                    ,
                    'pph_21' => $pph_21
                    ,
                    'zakat' => $zakat
                    ,
                    'bulog' => $bulog
                    ,
                    'nmsatker' => $nmsatker
                    ,
                    'bulan' => $bulan
                    ,
                    'tahun' => $tahun

                );

                $fieldValue_WUser_Add = array(
                    // ==== w_user
                    'id_user' => $nip
                    ,
                    'password' => md5($nip)
                    ,
                    'nama_user' => $nama_pegawai
                    ,
                    'id_level' => "3"
                );

                $fieldValue_WUserSistem_Add = array(
                    // ==== w_user_sistem
                    'id_user_sistem' => $nip
                    ,
                    'password_sistem' => md5($nip)
                    ,
                    'nama_user_sistem' => $nama_pegawai
                );

                $fieldValue_WMappingSistem_Add = array(
                    // ==== w_mapping_sistem
                    'id_user_sistem' => $nip
                    ,
                    'id_sistem' => "7"
                );


                // $model->insertData("w_user",$fieldValue_WUser_Add);
                // $model_sistem->insertData_Sistem("w_user_sistem",$fieldValue_WUserSistem_Add);
                // $model_sistem->insertData_Sistem("w_mapping_sistem",$fieldValue_WMappingSistem_Add);
                $response = $model->insertData("mst_pegawai", $fieldValue);


            } else {
                $fieldValue_update = array(
                    'nama_pegawai' => $nama_pegawai
                    ,
                    'nik' => $nik
                    ,
                    'jk' => $jk
                    ,
                    'sts_pegawai' => $sts_pegawai
                    ,
                    'tanggal_lahir' => $tanggal_lahir
                    ,
                    'alamat' => $alamat
                    ,
                    'tipe_jabatan' => $tipe_jabatan
                    ,
                    'eselon' => $eselon
                    ,
                    'golongan' => $golongan
                    ,
                    'pppk_pns' => $pppk_pns
                    ,
                    'nama_jabatan' => $nama_jabatan
                    ,
                    'status_pernikahan' => $status_pernikahan
                    ,
                    'nip_pasangan' => $nip_pasangan
                    ,
                    'is_pasangan_pns' => $is_pasangan_pns
                    ,
                    'kode_bank' => $kode_bank
                    ,
                    'nama_bank' => $nama_bank
                    ,
                    'npwp' => $npwp
                    ,
                    'nomor_rekening_bank_pegawai' => $nomor_rekening_bank_pegawai
                    ,
                    'tipe_k' => $tipe_k
                    ,
                    'jumlah_anak' => $jumlah_anak
                    ,
                    'jumlah_istri_suami' => $jumlah_istri_suami
                    ,
                    'jumlah_tanggungan' => $jumlah_tanggungan
                    ,
                    'belanja_gaji_pokok' => $belanja_gaji_pokok
                    ,
                    'perhitungan_suami_istri' => $perhitungan_suami_istri
                    ,
                    'perhitungan_anak' => $perhitungan_anak
                    ,
                    'belanja_tunjangan_keluarga' => $belanja_tunjangan_keluarga
                    ,
                    'belanja_tunjangan_jabatan' => $belanja_tunjangan_jabatan
                    ,
                    'belanja_tunjangan_fungsional' => $belanja_tunjangan_fungsional
                    ,
                    'jumlah_gaji_tunjangan' => $jumlah_gaji_tunjangan
                    ,
                    'belanja_tunjangan_fungsional_umum' => $belanja_tunjangan_fungsional_umum
                    ,
                    'belanja_tunjangan_beras' => $belanja_tunjangan_beras
                    ,
                    'belanja_tunjangan_pph' => $belanja_tunjangan_pph
                    ,
                    'belanja_pembulatan_gaji' => $belanja_pembulatan_gaji
                    ,
                    'belanja_iuran_jaminan_kesehatan' => $belanja_iuran_jaminan_kesehatan
                    ,
                    'belanja_iuran_jaminan_kecelakaan_kerja' => $belanja_iuran_jaminan_kecelakaan_kerja
                    ,
                    'belanja_iuran_jaminan_kematian' => $belanja_iuran_jaminan_kematian
                    ,
                    'tunjangan_jaminan_hari_tua' => $tunjangan_jaminan_hari_tua
                    ,
                    'tunjangan_jaminan_pensiun' => $tunjangan_jaminan_pensiun
                    ,
                    'iwp_1' => $iwp_1
                    ,
                    'belanja_iuran_simpanan_tapera' => $belanja_iuran_simpanan_tapera
                    ,
                    'tunjangan_khusus_papua' => $tunjangan_khusus_papua
                    ,
                    'jumlah_potongan' => $jumlah_potongan
                    ,
                    'jumlah_ditransfer' => $jumlah_ditransfer
                    ,
                    'mkg' => $mkg
                    ,
                    'pph_21' => $pph_21
                    ,
                    'zakat' => $zakat
                    ,
                    'bulog' => $bulog
                    ,
                    'nmsatker' => $nmsatker

                );
                $idWhere_update = array(
                    'nip' => $nip
                    ,
                    'bulan' => $bulan
                    ,
                    'tahun' => $tahun
                );

                $response = $model->updateData("mst_pegawai", $fieldValue_update, $idWhere_update);


            }

        }

        echo json_encode($response);
        break;


    default:
        break;
}