<?php

/*-----------------------------------------------------
        checkdataDate
-----------------------------------------------------*/
function checkdataDate($date) {
    list($d, $m, $y) = explode('/', $date);
    
    return checkdate($m, $d, $y);
}

function checkdataUrl($url){
    $url = trim($url);
    if (!empty($url)) {
        return preg_match("/^(http:\/\/|https:\/\/)(www\.)?(\w+)\.(\w+)/i",$url);
    }
    else return true;
}

function checkSizeImg($img, $w, $h){
    if (is_uploaded_file($img['tmp_name'])){
        list($width, $height, $type, $attr) = getimagesize($img['tmp_name']);
        if (($width == $w) && ($height == $h)) {
            return true;
        } else {
            return false;
        }
    }
    return true;
}
function checkOption($element,$checked){
	if ($element && !$checked){
		return false;
	}
	return true;
}



?>