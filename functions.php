<?php

function make_whois($inp)
{
	return '<a href="http://whois.domaintools.com/' . $inp . '" >' . $inp . '</a>';
} 
function make_loc($inp)
{
	$res  = '<br>';
	$res .= '<a href="http://www.iplocation.net/index.php?query=' . $inp . '" >L1</a> ';
	$res .= '<a href="http://geomaplookup.net/?ip=' . $inp . '" >L2</a> ';
	return $res;
} 
function br1($text)
{
	return wordwrap($text, 40, "<br>");
}
function br2($text, $val = 40)
{
	return wordwrap($text, $val, "<br>", true);
}

global $gethname_results;
$gethname_results = array();

function gethname($ip)
{
	global     $gethname_results;
    if ( isset($gethname_results[$ip]) ) 
    	return $gethname_results[$ip];
    else
    {
        $ans = @gethostbyaddr($ip);
        if($ans == $ip) $ans = "";
        $gethname_results[$ip] = $ans;
        return $ans;
    }
}

