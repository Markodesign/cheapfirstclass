<?php

session_start();

if($data = $_SESSION['request']){

	foreach($data as $k => $v)
	{
		if(strpos($k, 'from') !== false || strpos($k, 'to') !== false || strpos($k, 'departure') !== false)
		{
			$number = 0;
			$key = '';
			if(strpos($k, 'from') !== false) { $number = intval(str_replace('from', '', $k)); $key = 'from'; }
			if(strpos($k, 'to') !== false) { $number = intval(str_replace('to', '', $k)); $key = 'to'; }
			if(strpos($k, 'departure') !== false) { $number = intval(str_replace('departure', '', $k)); $key = 'departure'; }

			$flights[$number][$key] = $v;
		}
	}

	if($data['cabin']=='First Class'){

		$ticketType = 'FST';

	}else
	if($data['cabin']=='Business Class'){

		$ticketType = 'BIZ';

	}

	$traveler_count = $data['traveler_count'];
	$travelType = $data['type'];

	if($data['type']=='roundtrip'){

		$TripType = 2;


	}else
	if($data['type']=='oneway'){

		$TripType =1;

	}else{
		$TripType =4;
	}

	foreach($flights as $seg=>$sdata){

		preg_match("|(.*)(?: - )+([[:upper:]]{3})|",$sdata['from'],$rfrom);
		$from = $rfrom[2];

		preg_match("|(.*)(?: - )+([[:upper:]]{3})|",$sdata['to'],$rto);
		$to = $rto[2];

		$departure = date ("d-m-Y", strtotime($sdata['departure']));

		$S = $seg>0 ? $seg-1 : 0;

		$url .= "&SO$S=$from&SD$S=$to&SDP$S=$departure";

	}

	$SegNo = count($flights);

	if($TripType == 2){

		$return = $data['return'] ? date ("d-m-Y", strtotime($data['return'])) : false;

		$url .= "&SO1=$to&SD1=$from&SDP1=$return";
		$SegNo = 2;
	}

	$url = "http://www.momondo.com/flightsearch/?Search=true&TripType=$TripType&SegNo=$SegNo$url&AD=$traveler_count&TK=$ticketType&DO=false&NA=false";


	$_SESSION['s_url'] = $url;
	$url = urlencode($url);
	$_SESSION['requestid'] = md5($url);
	exec("phantomjs send.js $url " . $_SESSION['requestid'] . " > /dev/null &");
	exec("find results -cmin +24 -type f | xargs rm > /dev/null &");  // delete files 24 min older

	//unset($_SESSION['request']);
}

?>
