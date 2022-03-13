<?php

// Load utils
require_once('utils.php');

if(isset($_GET['image'])){
	$file = ROOT . '/images/'.($_GET['image'] ?? 'LogoWhite.svg');
	if(!file_exists($file)){
		header('Location: /index.php?page=error&error=404');
		return;
	}
	$filename = basename($file);
	$file_extension = strtolower(substr(strrchr($filename,"."),1));
	
	switch($file_extension) {
		case 'gif': $ctype = 'image/gif'; break;
		case 'jpg':
		case 'jpeg': $ctype = 'image/jpeg'; break;
		case 'svg': $ctype = 'image/svg+xml'; break;
		default: $ctype = 'image/png'; break;
	}
	
	header('Content-type: ' . $ctype);
	readfile($file);
	return;
}

$page = $_REQUEST['page'] ?? 'index';
define('PAGE', $page);
// Check if page exists
if (!file_exists(ROOT . '/pages/' . $page . '.php')) {
	$page = 'index';
}

if(isset($_REQUEST['error'])){
	$error = $_REQUEST['error'] ?? 'null';
}

require_once(ROOT . '/pages/' . $page . '.php');