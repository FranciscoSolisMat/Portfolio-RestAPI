<?php

require_once('functions.php');

const ROOT = __DIR__;

const LAYOUTS = [
	'head' => ROOT . '/layouts/head.php',
	'foot' => ROOT . '/layouts/foot.php',
	'code' => ROOT . '/layouts/code.php',
];

// Check if folder 'storage' exists
if (!file_exists(ROOT . '/storage')) {
	mkdir(ROOT . '/storage');
}
// Create the file 'db.sqlite' if it doesn't exist
if (!file_exists(ROOT . '/storage/db.sqlite')) {
	touch(ROOT . '/storage/db.sqlite');
}
$headers = [];
foreach ($_SERVER as $key => $value) {
	if (str_starts_with($key, 'HTTP_')) {
		$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))))] = $value;
	}
}
define('HEADERS', $headers);
define('REQUIRES_JSON', isset(HEADERS['Accept']) && str_contains(HEADERS['Accept'], 'application/json'));


// Init the SQLite database
$db = new SQLite3(ROOT . '/storage/db.sqlite');

$db->query('CREATE TABLE IF NOT EXISTS users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name TEXT,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

function json(array $data, bool $print_response = false, bool $print_header = false): string {
	if ($print_header) {
		header('Content-Type: application/json');
	}
	$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_LINE_TERMINATORS) ?? '{}';
	if($print_response) {
		print_r($json);
	}
	return $json;
}
