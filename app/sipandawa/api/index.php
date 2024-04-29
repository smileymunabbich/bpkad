<?php

include 'MODEL__/model.php';
include 'MODEL__/model_sistem.php';
// include 'controller_api.php';

$model = new model();
$model_sistem = new model_sistem();
// $api = new Controller_api();

$table_inv = "mst_inventory";
$table_cust = "mst_cust";
$table_sell_mst = "sell_mst";

$ACTION = $_GET['action'];
switch ($ACTION) {
    
    case "setting_order":
        $idWhere = array(
            'sts_setting' => "A"
        );
        $response = $model->getData("setting_order", $idWhere);
        echo json_encode($response);
        break;
    
    case "select_complete":
        date_default_timezone_set("Asia/Jakarta"); 
        $inp_sysdate = date("Y-m-d");
        // $inp_sysdate = "2020-03-18";
        
        $query = "SELECT * FROM vw_sell_info WHERE payment_info = 'bank_transfer' AND sell_sts = 'processing' AND sts_retur = 'F' AND (inp_sysdate BETWEEN '$inp_sysdate'  AND '$inp_sysdate')";
        $response = $model->getDataQuery($query);
        echo json_encode($response);
        break;
        
    case "change_sts_complete":
        $order_id = $_GET['order_id'];
        $idWhere = array(
            'order_id' => $order_id
        );
        $fieldValue = array(
            'sell_sts' => "completed"
        );
        $response = $model->updateData("sell_mst",$fieldValue,$idWhere);
        echo json_encode($response);
        break;
        
    case "select_retur":
        date_default_timezone_set("Asia/Jakarta"); 
        // $inp_sysdate = date("Y-m-d");
        $inp_sysdate = "2020-08-22";
        
        $query = "SELECT * FROM vw_sell_info WHERE sts_retur = 'T' AND sell_sts = 'completed' AND (retur_date BETWEEN '$inp_sysdate'  AND '$inp_sysdate')";
        $response = $model->getDataQuery($query);
        echo json_encode($response);
        break;
        
    case "change_sts_refunded":
        $order_id = $_GET['order_id'];
        $idWhere = array(
            'order_id' => $order_id
        );
        $fieldValue = array(
            'sell_sts' => "refunded"
        );
        $response = $model->updateData("sell_mst",$fieldValue,$idWhere);
        echo json_encode($response);
        break;
        
    case "select_inv":
        $part_no = $_GET['kode_product'];
        $idWhere = array(
            'part_no' => $part_no
        );
        $response = $model->getData($table_inv, $idWhere);
        echo json_encode($response);
        break;
        
    case "select_sell_mst":
        $order_id = $_GET['order_id'];
        $idWhere = array(
            'order_id' => $order_id
        );
        $response = $model->getData("sell_mst", $idWhere);
        echo json_encode($response);
        break;
        
    case "retur":
        date_default_timezone_set("Asia/Jakarta"); 
        $inp_sysdate = date("Y-m-d H:i:s"); 
        // $inp_sysdate = "2020-03-21";
        
        $sell_id = $_GET['sell_id'];
        $sell_qty = $_GET['sell_qty'];
        $idWhere = array(
            'sell_id' => $sell_id
        );
        $fieldValueUpdateSellMst = array(
            'retur_date' => $inp_sysdate
            ,'sts_retur' => "T"
        );
        $fieldValueUpdateHistTrans = array(
            'trans_qty' => -$sell_qty
        );
        $response = $model->updateData("sell_mst",$fieldValueUpdateSellMst,$idWhere);
        $response = $model->updateData("hist_transaction",$fieldValueUpdateHistTrans,$idWhere);
        echo json_encode($response);
        break;
        
    case "select_cust":
        $publisher = $_GET['publisher'];
        $cust_name = $_GET['cust_name'];
        $idWhere = array(
            'cust_name' => $cust_name
            , 'id_publisher' => $publisher
        );
        $response = $model->getData($table_cust, $idWhere);
        echo json_encode($response);
        break;
        
    case "sell":
        date_default_timezone_set("Asia/Jakarta"); 
        $inp_sysdate = date("Y-m-d H:i:s");   
        // $inp_sysdate = "2021-01-23";
        
        // ======================================== Check Next_Id
		$strQuery = 'SELECT AUTO_INCREMENT AS next_id FROM information_schema.TABLES WHERE TABLE_NAME = "sell_mst"';
        $resultQuery = $model->getDataQuery($strQuery);
        $next_id = $resultQuery[0]['next_id'];
        // ======================================== Check Next_Id END
        
        //sell_mst
        $id_user = "1";

        $sell_date = $_GET['sell_date'];
        $sell_sts = $_GET['sell_sts'];
        $payment_sts = $_GET['payment_sts'];
        $cust_id = $_GET['cust_id'];
        $id_publisher = $_GET['id_publisher'];

        //sell_dtl
        $id_order = $_GET['id_order'];
        $inv_id = $_GET['inv_id'];
        $sell_qty = $_GET['sell_qty'];
        $inv_unit = $_GET['inv_unit'];
        $sell_price = $_GET['sell_price'];
        $name_cust = addslashes($_GET['name_cust']);
        $tlpn_cust = $_GET['tlpn_cust'];
        $address_cust = addslashes($_GET['address_cust']);
        $payment_info = $_GET['payment_info'];
        $ekspedisi = $_GET['ekspedisi'];

        $sell_qty_min = $sell_qty;
        
        // =========================== TAMBAHAN FIELD SESUAI OO
        
        $email          = $_GET['email'];
        $province       = $_GET['province'];
        $city           = $_GET['city'];
        $subdistrict    = $_GET['subdistrict'];
        $zip            = $_GET['zip'];
        $product_price  = $_GET['product_price'];
        $cogs           = $_GET['cogs'];
        $discount       = $_GET['discount'];
        $bump           = $_GET['bump'];
        $bump_price     = $_GET['bump_price'];
        $notes          = $_GET['notes'];
        $shipping_cost  = $_GET['shipping_cost'];
        $cod_cost       = $_GET['cod_cost'];
        $receipt_number = $_GET['receipt_number'];
        $gross_revenue  = $_GET['gross_revenue'];
        $net_revenue    = $_GET['net_revenue'];
        $coupon         = $_GET['coupon'];
        
        $utm_campaign   = $_GET['utm_campaign'];
        $utm_medium     = $_GET['utm_medium'];
        $utm_source     = $_GET['utm_source'];
        $utm_content    = $_GET['utm_content'];
        $utm_term       = $_GET['utm_term'];
        $tags           = $_GET['tags'];
        $variation      = $_GET['variation'];
    
        // =========================== TAMBAHAN FIELD SESUAI OO
        
        // ======================================== Check order_id
		$idWhere_Check = array(
        	'order_id' => $id_order
        );
        $check = $model->getData("sell_mst",$idWhere_Check);
        // ======================================== Check order_id END

        $fieldValueSellMst = array(
            'sell_id' => $next_id
            , 'order_id' => $id_order
            , 'sell_date' => $sell_date
            , 'sell_sts' => $sell_sts
            , 'payment_sts' => $payment_sts
            , 'id_user' => $id_user
            , 'inp_sysdate' => $inp_sysdate
            , 'cust_id' => $cust_id
            , 'id_publisher' => $id_publisher
        );
        
        $fieldValueSellDetail = array(
            'sell_id' => $next_id
            , 'inv_id' => $inv_id
            , 'sell_price' => $sell_price
            , 'sell_qty' => $sell_qty
            , 'inv_unit' => $inv_unit
            , 'name_cust' => $name_cust
            , 'tlpn_cust' => $tlpn_cust
            , 'address_cust' => $address_cust
            , 'payment_info' => $payment_info
            , 'ekspedisi' => $ekspedisi
            , 'email' => $email
            , 'province' => $province
            , 'city' => $city
            , 'subdistrict' => $subdistrict
            , 'zip' => $zip
            , 'product_price' => $product_price
            , 'cogs' => $cogs
            , 'discount' => $discount
            , 'bump' => $bump
            , 'bump_price' => $bump_price
            , 'notes' => $notes
            , 'shipping_cost' => $shipping_cost
            , 'cod_cost' => $cod_cost
            , 'receipt_number' => $receipt_number
            , 'gross_revenue' => $gross_revenue
            , 'net_revenue' => $net_revenue
            , 'coupon' => $coupon
            , 'utm_campaign' => $utm_campaign
            , 'utm_medium' => $utm_medium
            , 'utm_source' => $utm_source
            , 'utm_content' => $utm_content
            , 'utm_term' => $utm_term
            , 'tags' => $tags
            , 'variation' => $variation
        );
        
        
        $fieldValueHistTransaction = array(
            'id_user' => $id_user
            , 'inp_sysdate' => $inp_sysdate
            , 'sell_id' => $next_id
            , 'inv_id' => $inv_id
            , 'trans_qty' => -$sell_qty_min
            , 'inv_unit' => $inv_unit
        );

        if(!empty($check)) { // jika data tidak kosong
	        $response = "Order sudah di inputkan";
	    } else {
            $response = $model->insertData($table_sell_mst, $fieldValueSellMst);
            $response = $model->insertData("sell_dtl", $fieldValueSellDetail);
            $response = $model->insertData("hist_transaction", $fieldValueHistTransaction);
        }
        
        echo json_encode($response);
        break;
    
    /*case "sell_retur":
        date_default_timezone_set("Asia/Jakarta"); 
        // $inp_sysdate = date("Y-m-d H:i:s");   
        $inp_sysdate = "2020-02-27";   
        
        // ======================================== Check Next_Id
		$strQuery = 'SELECT AUTO_INCREMENT AS next_id FROM information_schema.TABLES WHERE TABLE_NAME = "sell_mst"';
        $resultQuery = $model->getDataQuery($strQuery);
        $next_id = $resultQuery[0]['next_id'];
        // ======================================== Check Next_Id END
        
        //sell_mst
        $id_user = "1";

        $sell_date = $_GET['sell_date'];
        $sell_sts = $_GET['sell_sts'];
        $payment_sts = $_GET['payment_sts'];
        $cust_id = $_GET['cust_id'];

        //sell_dtl
        $id_order = $_GET['id_order'];
        $inv_id = $_GET['inv_id'];
        $sell_qty = $_GET['sell_qty'];
        $inv_unit = $_GET['inv_unit'];
        $sell_price = $_GET['sell_price'];
        $name_cust = addslashes($_GET['name_cust']);
        $tlpn_cust = $_GET['tlpn_cust'];
        $address_cust = addslashes($_GET['address_cust']);
        $payment_info = $_GET['payment_info'];
        $ekspedisi = $_GET['ekspedisi'];

        $sell_qty_min = $sell_qty;
        
        // =========================== TAMBAHAN FIELD SESUAI OO
        
        $email          = $_GET['email'];
        $province       = $_GET['province'];
        $city           = $_GET['city'];
        $subdistrict    = $_GET['subdistrict'];
        $zip            = $_GET['zip'];
        $product_price  = $_GET['product_price'];
        $cogs           = $_GET['cogs'];
        $discount       = $_GET['discount'];
        $bump           = $_GET['bump'];
        $bump_price     = $_GET['bump_price'];
        $notes          = $_GET['notes'];
        $shipping_cost  = $_GET['shipping_cost'];
        $cod_cost       = $_GET['cod_cost'];
        $receipt_number = $_GET['receipt_number'];
        $gross_revenue  = $_GET['gross_revenue'];
        $net_revenue    = $_GET['net_revenue'];
        $coupon         = $_GET['coupon'];
    
        // =========================== TAMBAHAN FIELD SESUAI OO
        
        // ======================================== Check order_id
		$idWhere_Check = array(
        	'order_id' => $id_order
        );
        $check = $model->getData("sell_mst",$idWhere_Check);
        // ======================================== Check order_id END

        $fieldValueSellMst = array(
            'sell_id' => $next_id
            , 'order_id' => $id_order
            , 'sell_date' => $sell_date
            , 'sell_sts' => $sell_sts
            , 'payment_sts' => $payment_sts
            , 'id_user' => $id_user
            , 'inp_sysdate' => $inp_sysdate
            , 'cust_id' => $cust_id
        );
        
        $fieldValueSellDetail = array(
            'sell_id' => $next_id
            , 'inv_id' => $inv_id
            , 'sell_price' => $sell_price
            , 'sell_qty' => $sell_qty
            , 'inv_unit' => $inv_unit
            , 'name_cust' => $name_cust
            , 'tlpn_cust' => $tlpn_cust
            , 'address_cust' => $address_cust
            , 'payment_info' => $payment_info
            , 'ekspedisi' => $ekspedisi
            , 'email' => $email
            , 'province' => $province
            , 'city' => $city
            , 'subdistrict' => $subdistrict
            , 'zip' => $zip
            , 'product_price' => $product_price
            , 'cogs' => $cogs
            , 'discount' => $discount
            , 'bump' => $bump
            , 'bump_price' => $bump_price
            , 'notes' => $notes
            , 'shipping_cost' => $shipping_cost
            , 'cod_cost' => $cod_cost
            , 'receipt_number' => $receipt_number
            , 'gross_revenue' => $gross_revenue
            , 'net_revenue' => $net_revenue
            , 'coupon' => $coupon
        );
        
        
        $fieldValueHistTransaction = array(
            'id_user' => $id_user
            , 'inp_sysdate' => $inp_sysdate
            , 'sell_id' => $next_id
            , 'inv_id' => $inv_id
            , 'trans_qty' => -$sell_qty_min
            , 'inv_unit' => $inv_unit
        );

        if(!empty($check)) { // jika data tidak kosong
	        $response = "Order sudah di inputkan";
	    } else {
            $response = $model->insertData($table_sell_mst, $fieldValueSellMst);
            $response = $model->insertData("sell_dtl", $fieldValueSellDetail);
            $response = $model->insertData("hist_transaction", $fieldValueHistTransaction);
        }
        
        echo json_encode($response);
        break;*/
        
    case "sell_retur":
        date_default_timezone_set("Asia/Jakarta"); 
        $inp_sysdate = "2020-08-22";   
        
        // ======================================== Check Next_Id
		$strQuery = 'SELECT AUTO_INCREMENT AS next_id FROM information_schema.TABLES WHERE TABLE_NAME = "sell_mst"';
        $resultQuery = $model->getDataQuery($strQuery);
        $next_id = $resultQuery[0]['next_id'];
        // ======================================== Check Next_Id END
        
        //sell_mst
        $id_user = "1";

        $sell_date = $_GET['sell_date'];
        $sell_sts = $_GET['sell_sts'];
        $payment_sts = $_GET['payment_sts'];
        $cust_id = $_GET['cust_id'];
        $id_publisher = $_GET['id_publisher'];

        //sell_dtl
        $id_order = $_GET['id_order'];
        $inv_id = $_GET['inv_id'];
        $sell_qty = $_GET['sell_qty'];
        $inv_unit = $_GET['inv_unit'];
        $sell_price = $_GET['sell_price'];
        $name_cust = addslashes($_GET['name_cust']);
        $tlpn_cust = $_GET['tlpn_cust'];
        $address_cust = addslashes($_GET['address_cust']);
        $payment_info = $_GET['payment_info'];
        $ekspedisi = $_GET['ekspedisi'];

        $sell_qty_min = $sell_qty;
        
        // =========================== TAMBAHAN FIELD SESUAI OO
        
        $email          = $_GET['email'];
        $province       = $_GET['province'];
        $city           = $_GET['city'];
        $subdistrict    = $_GET['subdistrict'];
        $zip            = $_GET['zip'];
        $product_price  = $_GET['product_price'];
        $cogs           = $_GET['cogs'];
        $discount       = $_GET['discount'];
        $bump           = $_GET['bump'];
        $bump_price     = $_GET['bump_price'];
        $notes          = $_GET['notes'];
        $shipping_cost  = $_GET['shipping_cost'];
        $cod_cost       = $_GET['cod_cost'];
        $receipt_number = $_GET['receipt_number'];
        $gross_revenue  = $_GET['gross_revenue'];
        $net_revenue    = $_GET['net_revenue'];
        $coupon         = $_GET['coupon'];
        
        $utm_campaign   = $_GET['utm_campaign'];
        $utm_medium     = $_GET['utm_medium'];
        $utm_source     = $_GET['utm_source'];
        $utm_content    = $_GET['utm_content'];
        $utm_term       = $_GET['utm_term'];
        $tags           = $_GET['tags'];
        $variation      = $_GET['variation'];
    
        // =========================== TAMBAHAN FIELD SESUAI OO
        
        // ======================================== Check order_id
		$idWhere_Check = array(
        	'order_id' => $id_order
        );
        $check = $model->getData("sell_mst",$idWhere_Check);
        // ======================================== Check order_id END

        $fieldValueSellMst = array(
            'sell_id' => $next_id
            , 'order_id' => $id_order
            , 'sell_date' => $sell_date
            , 'sell_sts' => $sell_sts
            , 'payment_sts' => $payment_sts
            , 'id_user' => $id_user
            , 'inp_sysdate' => $inp_sysdate
            , 'cust_id' => $cust_id
            , 'id_publisher' => $id_publisher
        );
        
        $fieldValueSellDetail = array(
            'sell_id' => $next_id
            , 'inv_id' => $inv_id
            , 'sell_price' => $sell_price
            , 'sell_qty' => $sell_qty
            , 'inv_unit' => $inv_unit
            , 'name_cust' => $name_cust
            , 'tlpn_cust' => $tlpn_cust
            , 'address_cust' => $address_cust
            , 'payment_info' => $payment_info
            , 'ekspedisi' => $ekspedisi
            , 'email' => $email
            , 'province' => $province
            , 'city' => $city
            , 'subdistrict' => $subdistrict
            , 'zip' => $zip
            , 'product_price' => $product_price
            , 'cogs' => $cogs
            , 'discount' => $discount
            , 'bump' => $bump
            , 'bump_price' => $bump_price
            , 'notes' => $notes
            , 'shipping_cost' => $shipping_cost
            , 'cod_cost' => $cod_cost
            , 'receipt_number' => $receipt_number
            , 'gross_revenue' => $gross_revenue
            , 'net_revenue' => $net_revenue
            , 'coupon' => $coupon
            , 'utm_campaign' => $utm_campaign
            , 'utm_medium' => $utm_medium
            , 'utm_source' => $utm_source
            , 'utm_content' => $utm_content
            , 'utm_term' => $utm_term
            , 'tags' => $tags
            , 'variation' => $variation
        );
        
        
        $fieldValueHistTransaction = array(
            'id_user' => $id_user
            , 'inp_sysdate' => $inp_sysdate
            , 'sell_id' => $next_id
            , 'inv_id' => $inv_id
            , 'trans_qty' => -$sell_qty_min
            , 'inv_unit' => $inv_unit
        );

        if(!empty($check)) { // jika data tidak kosong
	        $response = "Order sudah di inputkan";
	    } else {
            $response = $model->insertData($table_sell_mst, $fieldValueSellMst);
            $response = $model->insertData("sell_dtl", $fieldValueSellDetail);
            $response = $model->insertData("hist_transaction", $fieldValueHistTransaction);
        }
        
        echo json_encode($response);
        break;
        
    case "select_sell_id":
        $order_id = $_GET['order_id'];
        $idWhere = array(   
            'order_id' => $order_id
        );
        $response = $model->getData("sell_mst", $idWhere);
        echo json_encode($response);
        break;
        
    case "update_sell":
        $sell_id = $_GET['sell_id'];
        $id_order = $_GET['id_order'];
        $status = $_GET['status'];
        $payment_status = $_GET['payment_status'];
        $payment_method = $_GET['payment_method'];
        $receipt_number = $_GET['receipt_number'];
        
        $idWhere = array(
        	'sell_id' => $sell_id
        );
        
        $fieldValue_sell_mst = array(
            'sell_sts' => $status
            , 'payment_sts' => $payment_status
        );
        
         $fieldValue_sell_dtl = array(
            'receipt_number' => $receipt_number
        );
        
        $response = $model->updateData("sell_mst", $fieldValue_sell_mst, $idWhere);
        $response = $model->updateData("sell_dtl", $fieldValue_sell_dtl, $idWhere);
        
        echo json_encode($response);
        break;
        
    case "update_sell_bank":
        $sell_id = $_GET['sell_id'];
        $id_order = $_GET['id_order'];
        $status = $_GET['status'];
        $payment_status = $_GET['payment_status'];
        
        $idWhere = array(
        	'sell_id' => $sell_id
        );
        
        $fieldValue_sell_mst = array(
            'sell_sts' => $status
            , 'payment_sts' => $payment_status
        );
        
        $response = $model->updateData("sell_mst", $fieldValue_sell_mst, $idWhere);
        
        echo json_encode($response);
        break;
        
    // ********************************************************************************************************************** API ORDER ONLINE
    /*case "syncData":
        date_default_timezone_set("Asia/Jakarta"); 
        $inp_sysdate = date("Y-m-d H:i:s");  
        $dateh_to = date("Y-m-d");
        $dateh_from = date_create($dateh_to)->modify('-1 day')->format('Y-m-d'); 
        if(isset($_GET["longor"])){
            $modd = '';
            switch($_GET["longor"]){
                case "month":
                    $modd = '-1 month';
                    break;
                case "triwulan":
                    $modd = '-3 months';
                    break;
                case "caturwulan":
                    $modd = '-4 months';
                    break;
                case "seminggu":
                    $modd = '-7 days';
                    break;
                default:
                    $modd = '-1 day';
                    break;
            }
            $dateh_from = date_create($dateh_to)->modify($modd)->format('Y-m-d'); 
        }
        
        //sell_mst
        if(isset($_GET)){
            $start = (isset($_GET["start"]))?$_GET["start"]:$dateh_from;
            $end = (isset($_GET["end"]))?$_GET["end"]:$dateh_to;
            unset($_GET["start"],$_GET["end"],$_GET["action"]);
            $addition = $_GET;
        }
        $id_user = "1";
        $diff=date_diff(date_create($start),date_create($end));
        $diff = $diff->format("%a");
        $diff = (int)$diff;
        for($i = 0; $i <= $diff; $i++){
            $end = $start;
            $inp_sysdate = $end;
                $json = $api->getOrderData($start,$end,$addition);
                $res_coks = json_decode($json, true);
                foreach ($res_coks as $key => $res_cok) {
                    $id_order = $res_cok['order_id'];
                    $sell_sts = $res_cok['status'];
                    $payment_sts = $res_cok['payment']['status'];
                    
                    
                    $fieldValueSellMst = array(
                        'order_id' => $id_order
                        , 'sell_sts' => $sell_sts
                        , 'payment_sts' => $payment_sts
                    );
                    
                    
                    print(json_encode("tanggal => ".$inp_sysdate." ".$response.$key."  "));
                    flush();
                    ob_flush();
                    
                }
                   
            $start = date_create($end)->modify('+1 day')->format('Y-m-d'); 
        }
        echo json_encode($response);
        break;*/

    default:
        break;
}
?>