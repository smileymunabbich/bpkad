<?php
include '../MODEL__/model.php';
include '../MODEL__/model_sistem.php';

$model = new model();
$model_sistem = new model_sistem();

$ACTION = $_POST['action'];
switch($ACTION){
    
    case "listTable":
	    $id_user = trim($_POST['id_user']);
		$id_level = trim($_POST['id_level']);
		
		$response = $model->getAllData("mst_tpp");
		echo json_encode($response);
		break;
    
    case "commit_data";
    
        $bulan = trim($_POST['bulan']);
        $tahun = trim($_POST['tahun']);
        $myArray  = json_decode($_POST['jsonArr'], true);
        
        for($i = 0; $i < count($myArray); $i++) {
            $nip =  $myArray[$i]['nip'];
            $nama =  $myArray[$i]['nama'];
            $jabatan =  $myArray[$i]['jabatan'];            
            $unit_kerja =  $myArray[$i]['unit_kerja'];    
            $gol_ruang =  $myArray[$i]['gol_ruang'];    
            $kelas =  $myArray[$i]['kelas'];
            $bruto =  $myArray[$i]['bruto'];
            $bebankerja_tpp =  $myArray[$i]['bebankerja_tpp'];
			$bebankerja_pph = $myArray[$i]['bebankerja_pph'];
			$bebankerja_netto = $myArray[$i]['bebankerja_netto'];
            $prestasikerja_tpp =  $myArray[$i]['prestasikerja_tpp'];
            $prestasikerja_pph =  $myArray[$i]['prestasikerja_pph'];
			$prestasikerja_netto = $myArray[$i]['prestasikerja_netto'];
            $kondisikerja_tpp =  $myArray[$i]['kondisikerja_tpp'];
            $kondisikerja_pph =  $myArray[$i]['kondisikerja_pph'];
            $kondisikerja_netto =  $myArray[$i]['kondisikerja_netto'];
            $jumlah =  $myArray[$i]['jumlah'];
			$potongan_pph = $myArray[$i]['potongan_pph'];
			$jumlah_tpp =  $myArray[$i]['jumlah_tpp'];
            $potongan_iwp =  $myArray[$i]['potongan_iwp'];
            $tpp_diterima =  $myArray[$i]['tpp_diterima'];
            $no_rekening =  $myArray[$i]['no_rekening'];
           
            
            // ================================================================ CEK DATA 
            $idWhere = array(
                'nip' => $nip
                ,'bulan'   =>$bulan
                ,'tahun'   =>$tahun
    		);
    		$cekMstTpp = $model->getData("mst_tpp",$idWhere);
    		$contMstTpp = sizeof($cekMstTpp);
    		// ================================================================ CEK DATA
    		
    		if($contMstTpp == 0){ 
    		    
    		    // ################################# // INSERT DATA
    		    $fieldValue = array(
					'nip' =>$nip
					,'nama' =>$nama
				    ,'jabatan' =>$jabatan
                    ,'unit_kerja' =>$unit_kerja
                    ,'gol_ruang' =>$gol_ruang
                    ,'kelas' =>$kelas
                    ,'bruto' =>$bruto
                    ,'bebankerja_tpp' =>$bebankerja_tpp
        			,'bebankerja_pph' =>$bebankerja_pph
        			,'bebankerja_netto' =>$bebankerja_netto
                    ,'prestasikerja_tpp' =>$prestasikerja_tpp
                    ,'prestasikerja_pph' =>$prestasikerja_pph
        			,'prestasikerja_netto' =>$prestasikerja_netto
                    ,'kondisikerja_tpp' =>$kondisikerja_tpp
                    ,'kondisikerja_pph' =>$kondisikerja_pph
                    ,'kondisikerja_netto' =>$kondisikerja_netto
                    ,'jumlah' =>$jumlah
        			,'potongan_pph' =>$potongan_pph
        			,'jumlah_tpp' =>$jumlah_tpp
                    ,'potongan_iwp' =>$potongan_iwp
                    ,'tpp_diterima' =>$tpp_diterima
                    ,'no_rekening' =>$no_rekening
                    ,'bulan' =>$bulan
                    ,'tahun' =>$tahun
    			);
        		
				            
		        $response = $model->insertData("mst_tpp",$fieldValue);
				
				
    		}else{
    		    // #################################################### // UPDATE DATA
    		    $fieldValue_update = array(
					'nama' =>$nama
				    ,'jabatan' =>$jabatan
                    ,'unit_kerja' =>$unit_kerja
                    ,'gol_ruang' =>$gol_ruang
                    ,'kelas' =>$kelas
                    ,'bruto' =>$bruto
                    ,'bebankerja_tpp' =>$bebankerja_tpp
        			,'bebankerja_pph' =>$bebankerja_pph
        			,'bebankerja_netto' =>$bebankerja_netto
                    ,'prestasikerja_tpp' =>$prestasikerja_tpp
                    ,'prestasikerja_pph' =>$prestasikerja_pph
        			,'prestasikerja_netto' =>$prestasikerja_netto
                    ,'kondisikerja_tpp' =>$kondisikerja_tpp
                    ,'kondisikerja_pph' =>$kondisikerja_pph
                    ,'kondisikerja_netto' =>$kondisikerja_netto
                    ,'jumlah' =>$jumlah
        			,'potongan_pph' =>$potongan_pph
        			,'jumlah_tpp' =>$jumlah_tpp
                    ,'potongan_iwp' =>$potongan_iwp
                    ,'tpp_diterima' =>$tpp_diterima
                    ,'no_rekening' =>$no_rekening
    			);
        		
				            
		        $idWhere_update = array(
                    'nip' => $nip
                    ,'bulan'   =>$bulan
                    ,'tahun'   =>$tahun
        		);
        		
                $response = $model->updateData("mst_tpp",$fieldValue_update,$idWhere_update);
    			
    		    
    		}
            
        }    
        
        echo json_encode($response);
        break;


	default:
		break;
}

