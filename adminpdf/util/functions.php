<?php



function microtime_float()
{
	list($utime, $time) = explode(" ", microtime());
	return ((float)$utime + (float)$time);
}

function show($var)
{
	echo "<pre>\n";
	echo htmlentities(print_r($var, true), null, 'UTF-8');
	echo "</pre>\n";
}

function showx($var)
{
	show($var);
	exit;
}

function getExtension($filename)
{
	//return substr(strrchr($fileName, '.'), 1);
	return array_pop(explode(".", $filename));
}

function getFilename($file)
{
	$filename = substr($file, strrpos($file, '/') + 1, strlen($file) - strrpos($file, '/'));
	return $filename;
}


function get_time_difference($start, $end)
{
	$uts['start'] = strtotime($start);
	$uts['end'] = strtotime($end);

	return $uts['end'] - $uts['start'];
}


function isValidDateTime($dateTime)
{
	if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
		if (checkdate($matches[2], $matches[3], $matches[1])) {
			return true;
		}
	}
	return false;
}


function checkUrl($url)
{
	if (strlen($url)) {
		if (strpos($url, '.') === false) {
			return false;
		}
		/*
		if (!(strpos($url, 'http://') === 0) and !(strpos($url, 'https://') === 0)) {
			$url = 'http://'.$url;
		}
		*/
		return true;
	}

	return false;
}

function filterUrl($url)
{
	$url = trim($url);
	$url = ltrim($url, '/\\');
	if (!(strpos($url, 'http://') === 0) and !(strpos($url, 'https://') === 0)) {
		$url = 'http://' . $url;
	}
	return $url;
}

function show_text($var)
{
	echo "<textarea style=\"width:600px;height:300px;\">\n";
	print_r($var);
	echo "</textarea>\n";
}

function ifsetor(&$val, $default = null)
{
	return isset($val) ? $val : $default;
}

function is_unsigned_integer($a)
{
	return ((string)$a === (string)(int)$a) && (int)$a > 0;
}


/*-----------------------------------------------------
        VALIDATION functions
-----------------------------------------------------*/
function isValidURL($url)
{

	$urlregex = '|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i';

	return preg_match($urlregex, $url);
}

function isValidPassword($str)
{
	if (preg_match('|.{4,16}|s', $str)) {
		return true;
	} else {
		return false;
	}
}

function isValidEmail($email)
{
	if (strlen($email) > 255) {
		return false;
	} elseif (preg_match('|^([a-z0-9_\.\-\+]{1,64})@(([a-z0-9\-]{1,64})\.)+([a-z]{2,5})$|is', $email)) {
		$emailArr = explode('@', $email);
		if (strlen($emailArr[0] > 64) or strlen($emailArr[1] > 255)) {
			return false;
		} else {
			if (strpos($emailArr[0], '..') === false) {
				return true;
			} else {
				return false;
			}
		}
	} else {
		return false;
	}
}

/*-----------------------------------------------------
        URL functions
-----------------------------------------------------*/
function movePage($num, $url)
{
	static $http = array(
		100 => "100 Continue",
		101 => "101 Switching Protocols",
		200 => "200 OK",
		201 => "201 Created",
		202 => "202 Accepted",
		203 => "203 Non-Authoritative Information",
		204 => "204 No Content",
		205 => "205 Reset Content",
		206 => "206 Partial Content",
		300 => "300 Multiple Choices",
		301 => "301 Moved Permanently",
		302 => "302 Found",
		303 => "303 See Other",
		304 => "304 Not Modified",
		305 => "305 Use Proxy",
		307 => "307 Temporary Redirect",
		400 => "400 Bad Request",
		401 => "401 Unauthorized",
		402 => "402 Payment Required",
		403 => "403 Forbidden",
		404 => "404 Not Found",
		405 => "405 Method Not Allowed",
		406 => "406 Not Acceptable",
		407 => "407 Proxy Authentication Required",
		408 => "408 Request Time-out",
		409 => "409 Conflict",
		410 => "410 Gone",
		411 => "411 Length Required",
		412 => "412 Precondition Failed",
		413 => "413 Request Entity Too Large",
		414 => "414 Request-URI Too Large",
		415 => "415 Unsupported Media Type",
		416 => "416 Requested range not satisfiable",
		417 => "417 Expectation Failed",
		500 => "500 Internal Server Error",
		501 => "501 Not Implemented",
		502 => "502 Bad Gateway",
		503 => "503 Service Unavailable",
		504 => "504 Gatewway Time-out"
	);
	header($_SERVER["SERVER_PROTOCOL"] . " " . $http[$num]);
	header("Location: $url");
	exit;
}

function redirectToHTTPS()
{
	if ($_SERVER['HTTPS'] !== "on") {
		$redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: " . $redirect);
		exit;
	}
}


function replaceUrl($string)
{

	$from = array(" ", "&", "%");
	$to = array("_", "and", "_");
	$newphrase = str_replace($from, $to, $string);
	return $newphrase;
}






function convertToCsv($input_array, $output_file_name, $delimiter)
{
	/** open raw memory as file, no need for temp files, be careful not to run out of memory thought */
	$f = fopen('php://memory', 'w');
	/** loop through array  */
	foreach ($input_array as $line) {
		/** default php csv handler **/
		fputcsv($f, $line, $delimiter);
	}
	/** rewrind the "file" with the csv lines **/
	fseek($f, 0);

	/** modify header to be downloadable csv file **/
	header('Content-Type: application/csv');
	header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
	//   header("Content-Length: " . $file_size);
	/** Send file to browser for download */
	fpassthru($f);
	header("Connection: close");
}

