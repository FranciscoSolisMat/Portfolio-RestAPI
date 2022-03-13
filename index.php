<?php

// Init the sqlite server
const ROOT = __DIR__;
// Create the file 'db.sqlite' if it doesn't exist
if (!file_exists(ROOT . '/db.sqlite')) {
	touch(ROOT . '/db.sqlite');
}
$db = new SQLite3(ROOT . '/db.sqlite');

$db->query('CREATE TABLE IF NOT EXISTS users (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name TEXT,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');