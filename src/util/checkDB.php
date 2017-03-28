<?php
// Db class
require_once('db.php');

// Creates new Database connection object
$db = new db();

// Checks connection and database existance, if not redirets to infomation page
if ($db->conn == null) {
    header('Refresh: 0; url= database/makeDatabase.php');
    exit;
}
if ($db->changeDB('twitter') == false) {
    header('Refresh: 0; url= database/makeDatabase.php');
    exit;
}