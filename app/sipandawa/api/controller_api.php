<?php

class Controller_api {

	function __construct(){
		$this->api_key = "Z2tMmsyvkA10aooB";
		$this->api_endpoint = "https://openapi.bcoder.xyz/oo/$this->api_key/";
	}
	function api_call($url){
		$json = file_get_contents($url);
		return $json;
	}
	function get_product(){
		$cur_page = 1;
		$total_page = 0;
		$product = 0;
		$product_data = [];
		
        while($cur_page != $total_page){
        	$result = $this->api_call($this->api_endpoint.'?action=getproducts&limit=0&since=2019-01-01&page='.$cur_page);
	        $res_coks = json_decode($result, true);
	        $total_page = $res_coks["page_info"]["last_page"];
	        $product += count($res_coks["products"]);
	        $product_data = array_merge($product_data,$res_coks["products"]);
	        ($total_page > $cur_page)?$cur_page+=1:$cur_page=$total_page;
        }
        file_put_contents("products", json_encode($product_data));
        return $product_data;
	}
	function get_single($id){
		$prod_data = [];
		$prods = [];
		$singleProd = $this->api_call($this->api_endpoint.'?action=getproduct&id='.$id);
		$singleData = json_decode($singleProd, true);
		// if($singleData["variations"]["multiple_variations"]["enabled"]==true){
		// 	foreach ($singleData["variations"]["prices"] as $rambut) {
		// 		$findSlice = strpos($singleData["name"],"/");
		// 		$prod_data["inv_name"] = substr($singleData["name"], 0,$findSlice);
		// 		$prod_data["inv_name"] .= $rambut["name"];
		// 		$prod_data["part_no"] = substr($singleData["name"], $findSlice+2);
		// 		$prod_data["inv_type"] = $singleData["category"]["category"];
		// 		$prod_data["inv_desc"] = $rambut["weight"]." gram";
		// 		$prod_data["inv_sell_prc"] = $rambut["cogs"];
		// 		$prod_data["id_oo"] = $singleData["_id"];
		// 		$prod_data["product_slug"] = $singleData["slug"];
		// 		array_push($prods,$prod_data);
		// 	}
		// }
		// else {
				$findSlice = strpos($singleData["name"],"/");
				$prod_data["inv_name"] = substr($singleData["name"], 0,$findSlice);
				$prod_data["part_no"] = substr($singleData["name"], $findSlice+2);
				$prod_data["inv_type"] = $singleData["category"]["category"];
				$prod_data["inv_desc"] = $singleData["weight"]." gram";
				$prod_data["inv_buy_prc"] = $singleData["cogs"];
				$prod_data["inv_sell_prc"] = $singleData["price"];
				$prod_data["id_oo"] = $singleData["_id"];
				$prod_data["product_slug"] = $singleData["slug"];
				array_push($prods,$prod_data);
		// }
		return $prods;
	}

	function parseProduct(){
		$galon = array();
		$prod_coks = $this->get_product();
        foreach ($prod_coks as $prod_cok) {
            $dancoks = $this->get_single($prod_cok["_id"]["\$oid"]);
            foreach ($dancoks as $dancok) {
            	array_push($galon, $dancok);
            	// $galon = array_merge($galon,$dancok);
            }
        }
        return json_encode($galon);
	}

	function produceStats($start = "", $end = "", $utem = "", $addition = ""){
		$dempul = "";
		$itungan = 1;
		$utm_s = "";
		if(strpos($utem, "@nasa.com") !== false){
			$utm_s = "&utm_source=".$utem;
		}
		$result = $this->api_call($this->api_endpoint.'?action=getstats&since='.$start.'&till='.$end.$utm_s);
		$res_coks = json_decode($result, true);
		$res_coks["net_profit"] = $res_coks["gross_revenue"]-$res_coks["shipping_cost"]-$res_coks["cogs"]-$addition["total_expense"];
		foreach ($res_coks as $konci => $res_cok) {
		    if($konci != "net_revenue" && $konci != "shipping_cod_cost" && $konci != "coupon_discount_claimed"){
		        
    			// if($itungan ==1){
       //          	$dempul .= '<div class="row" style="padding-top: 10px;">';
       //          }
    			$dempul .= '<div class="col col-xl-4 col-md-3 col-xs-12" style="padding-top: 10px;">
                              <div class="card card-stats '.(($res_coks["net_profit"]<0)?"bg-danger btn-default":"bg-success btn-default").'">
                                <!-- Card body -->
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col">
                                      <h5 class="card-title text-uppercase mb-0">'.$this->tJudul($konci).'</h5>
                                      <span class="h4 font-weight-bold mb-0">'.$this->isDuit($konci, $res_cok, $addition).'</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>';
                // if($itungan%4 == 0){
                // 	$dempul .= '</div>';
                // 	$itungan = 0;
                // }
                // $itungan += 1;
		    }
		}

		return $dempul;
	}
    function tJudul($judul){
        switch($judul){
            case "gross_revenue":
                $res = "Omset";
                break;
            default:
				$res = ucwords(str_replace("_", " ", $judul));;
				break;
        }
        return $res;
    }
	function isDuit($data,$duit,$addition){
		setlocale(LC_MONETARY,"id_ID");
		switch ($data) {
			case strpos($data, 'revenue') !== false:
				$res = "Rp " . number_format($duit,2,',','.');
				break;
			case strpos($data, 'cost') !== false:
				$res = "Rp " . number_format($duit,2,',','.');
				break;
			case "expense":
			    $duit = $addition["total_expense"];
				$res = "Rp " . number_format($duit,2,',','.');
				break;
			case "cogs":
				$res = "Rp " . number_format($duit,2,',','.');
				break;
			case strpos($data, 'profit') !== false:
				$res = "Rp " . number_format($duit,2,',','.');
				break;
			case 'closing_rate':
				$res = $duit."%";
				break;
			case 'paid_ratio':
				$res = $duit."%";
				break;
			default:
				$res = $duit;
				if(is_int($duit)){$res = number_format($duit,0,'','.');}
				break;
		}
		return $res;
	}

	function getFormId($id_oo){
		$singleProd = $this->api_call($this->api_endpoint.'?action=getform&id='.$id_oo);
		$singleData = json_decode($singleProd, true);
		$form_id = $singleData[0]["_id"];
		return $form_id;
	}

	function getOrderData($start = "", $end = "", $sakarepmu = ""){
		$date_temp=date_create(date("Y-m-d"));
		date_sub($date_temp,date_interval_create_from_date_string("1 day"));
		$temp_date = date_format($date_temp,"Y-m-d");
		if($sakarepmu != ""){
			$sakarepmu = '&'.http_build_query($sakarepmu);
		}
		if($start == ""){
			$start = $temp_date;
		}
		if($end == ""){
			$end = date("Y-m-d");
		}
// 		$json = $this->api_call($this->api_endpoint.'?action=getorder&since='.$start.'&until='.$end.'&limit=0&status=processing,completed,refunded'.$sakarepmu);
// 		$json = $this->api_call($this->api_endpoint.'?action=getorder&since='.$start.'&until='.$end.'&limit=0&status=processing,completed,pending'.$sakarepmu);
		$json = $this->api_call($this->api_endpoint.'?action=getorder&since=2018-10-02&until=2040-12-31&completed_at_since='.$start.'&completed_at_until='.$end.'&status=completed'.$sakarepmu);
        return $json;
	}

	function changeOrder($id, $status){
		$res_req = $this->api_call($this->api_endpoint.'?action=changeorder&id='.$id.'&status='.$status);
		$res = json_decode($res_req, true);
		if(isset($res["order_id"])){
			$res = "success";
		}
		else {
			$res = "failed";
		}
		return $res;
	}
	
	function getMember($id){
	    $singleMember = $this->api_call($this->api_endpoint.'?action=getmember&id='.$id);
		$singleData = json_decode($singleMember, true);
		$cs_name = $singleData["name"];
		return $cs_name;
	}
}