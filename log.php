<?php
include_once 'logdb.php';

$r = array();

// Date & Time
$r['datetime'] = date('Y-m-d H:i:s');

// IP
$r['ip'] = $_SERVER['REMOTE_ADDR'];

// Hostname
//$r['hostname'] = gethostbyaddr($r['ip']);

// URI
$r['uri'] = $_SERVER['REQUEST_URI'];

// Browser
$r['agent'] = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";

// Referer
$r['referer'] = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";

// Domain
$r['domain'] = $_SERVER["HTTP_HOST"];

// Script file name
$r['filename'] = $_SERVER["SCRIPT_FILENAME"];

// Method
$r['method'] = $_SERVER["REQUEST_METHOD"];

// Query (GET data)
$r['query'] = $_SERVER["QUERY_STRING"];

// POST data
$r['post'] = file_get_contents("php://input");

// data
$r['data'] = trim( $r['query'] . " " . $r['post'] );

// Cookie
//$r['cookie'] = $_SERVER["HTTP_COOKIE"];

// Via
//$r['via'] = isset($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_VIA"] : "";

// Forwarded for
//$r['forwarded'] = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : "";

// Mysql escape
$r['uri'] = mysqli_real_escape_string($con, $r['uri']);
$r['agent'] = mysqli_real_escape_string($con, $r['agent']);
$r['referer'] = mysqli_real_escape_string($con, $r['referer']);
$r['domain'] = mysqli_real_escape_string($con, $r['domain']);
$r['data'] = mysqli_real_escape_string($con, $r['data']);

$hits = 0;
// Filter
if(substr($r['agent'], 0, 11) != 'Pingdom.com'
&& strpos($r['agent'],'HostTracker.com') === false)
{
// Insert to DB

$sql  = "INSERT INTO `hits` (`datetime`, `ip`, `uri`, `agent`, `referer`, `domain`, `filename`, `method`, `data`) VALUES (";
$sql .= "'{$r['datetime']}', ";
$sql .= "'{$r['ip']}', ";
$sql .= "'{$r['uri']}', ";
$sql .= "'{$r['agent']}', ";
$sql .= "'{$r['referer']}', ";
$sql .= "'{$r['domain']}', ";
$sql .= "'{$r['filename']}', ";
$sql .= "'{$r['method']}', ";
$sql .= "'{$r['data']}' ";
$sql .= ");";

mysqli_query($con, $sql);
$hits = mysqli_insert_id($con);
}
