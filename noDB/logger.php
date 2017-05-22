<?php

$logFile = "log.txt";
$hitCounter = "counter.txt";

$r = array();

// Date & Time
$r['datetime'] = date('Y-m-d H:i:s');

// IP
$r['ip'] = $_SERVER['REMOTE_ADDR'];

// Port
//$r['port'] = $_SERVER["REMOTE_PORT"];

// URI
$r['uri'] = $_SERVER['REQUEST_URI'];

// Browser
$r['agent'] = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";

// Referer
$r['referer'] = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";

// Script
//$r['script'] = $_SERVER["SCRIPT_FILENAME"];

// Query (GET data)
//$r['query'] = $_SERVER["QUERY_STRING"];

// POST data
//$r['post'] = file_get_contents("php://input");

// Method
//$r['method'] = $_SERVER["REQUEST_METHOD"];

// Host
//$r['host'] = $_SERVER["HTTP_HOST"];

// Cookie
//$r['cookie'] = $_SERVER["HTTP_COOKIE"];

// Via
//$r['via'] = $_SERVER["HTTP_VIA"];

// Forwarded for
//$r['forwarded'] = $_SERVER["HTTP_X_FORWARDED_FOR"];


//---------------------------------------------------

// Hit Counter
$hit = file_exists($hitCounter)? file_get_contents($hitCounter) : 0;
$hit++;
file_put_contents($hitCounter, $hit);
$r['hit'] = $hit;

// Debug
if(isset($_GET['logdebug']))
{
	echo "<pre>";
	print_r($r);
	echo "</pre>";
}

// Log Report
$log = "";
$log .= "Hit : " . $r['hit'] . "\n";
$log .= "Time : " . $r['datetime'] . "\n";
$log .= "IP : " . $r['ip'] . "\n";
$log .= "URI : " . $r['uri'] . "\n";
$log .= "Agent : " . $r['agent'] . "\n";
$log .= "Referer : " . $r['referer'] . "\n";
$log .= "--------------------\n";

// Log File
file_put_contents($logFile, $log, FILE_APPEND);
