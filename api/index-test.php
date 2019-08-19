<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

$html = @file_get_contents("results/254a3fabf5cadffd6138fe5179942466.html");

function parseimage($img){

	$file = $_SERVER['DOCUMENT_ROOT'] .'/images/airlines/' . $img;

	if(!is_file($file)){

		file_put_contents($file,file_get_contents("http://cdn1.momondo.net/logos/airlines/$img"));

	}

	return '/images/airlines/' . $img;

}

preg_match_all('|(<div class="result-box .*)<span class="label">Go to Site</span></a></div>|sU',$html,$mtch);

preg_match("|applied: (.*) results|",$html,$res);

$allresults = $res[1];
$bestresults = count($mtch[1]);
$traveler_count = $_SESSION['request']['traveler_count'];


foreach($mtch[1] as $n=>$row){

	preg_match('|<span class="price.*"><span class="value">(.*)</span> <span class="unit">(.*)</span>|Us',$row,$prs);



	$FlightsData['price'] = $prs[1];
	$FlightsData['currency'] = $prs[2];

	preg_match_all('|<div class="segment segment(.*)">.*<div class="destination ">.*<span class="city">.*</span>|sU',$row,$sgt);

	foreach($sgt[0] as $index=>$segment){

        preg_match('|logos/airlines/(.+\.png)?" alt="(.*)".*<div class="departure ">.*<span class="iata">(.*)</span>.*<span class="time">(.*)<span class="(.*)">.*<span class="city">(.*)</span>.*<div class="travel-time">(.*)</div>.*<span class="total">(.*)</span>.*<span class="time">(.*)<span class="(.*)">.*<span class="iata">(.*)</span>.*<span class="city">(.*)</span>|Us',$segment,$mtch);

		$flightData[$index]['airlineName'] = $mtch[2];
		$flightData[$index]['airlineLogo'] = $mtch[1];
		$flightData[$index]['iata'] = $mtch[3];
		$flightData[$index]['from'] = $mtch[3];
		$flightData[$index]['to'] = $mtch[11];
		$flightData[$index]['depature'] = $mtch[4] . " " . $mtch[5];
		$flightData[$index]['arrival'] = $mtch[9] . " " . $mtch[10];
		$flightData[$index]['depatureName'] = $mtch[6];
		$flightData[$index]['arrivalName'] = $mtch[12];
		$flightData[$index]['duration'] = $mtch[7];
		$flightData[$index]['stops'] = $mtch[8];

    }

	$FlightsData['flights'] = $flightData;

	$FlightsData['price'] = ceil(intval(str_replace(",", "", $FlightsData['price'])) * 1.068 * 0.7);
	if($FlightsData['currency']=='EUR') $FlightsData['currency'] = 'USD';


	$FlightsData['offer'] = rand(20,30);


	$FlightsData['travelers'] = $traveler_count;

	if($traveler_count>1){
		$FlightsData['travelers'] = $traveler_count;
		$FlightsData['personprice'] = ceil($flight['price']/$traveler_count);
	}

	$FlightsData['kayak'] = rand(15,30);
	$FlightsData['tickets'] = rand(15,30);
	$FlightsData['airfrance'] = rand(15,30);

	$FlightsT['flights'][] = $FlightsData;

	if($n==0){

		$FlightsT['bestofferduration'] = $flightData[1]['duration'];
		$FlightsT['bestofferprice'] = $FlightsData['price'];
		$FlightsT['bestoffercurrency'] = $FlightsData['currency'];
		$FlightsT['bestresults'] = $bestresults;
		$FlightsT['allresults'] = $allresults;

	}

	// caching logos
	if($flightData[1]['airlineLogo']){
		$logos[$flightData[1]['airlineLogo']] = 1;
	}

	if($flightData[2]['airlineLogo']){
		$logos[$flightData[2]['airlineLogo']] = 1;
	}

}

if($logos){

	foreach($logos as $logo=>$zero){

		parseimage($logo);

	}
}


header('Content-Type: application/json');
$status = 'data';

if(preg_match("|[Search complete]|",$html,$mtc)){

	$status = 'done';

}

if(is_array($FlightsT['flights'])){
	array_splice($FlightsT['flights'], 18);
}


echo json_encode(array('status'=>$status, 'data'=>$FlightsT, 'results'=>$bestresults));
?>
