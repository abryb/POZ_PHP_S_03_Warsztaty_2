<?php
require_once('../autoloader.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ( !empty($_SESSION['email'])) {
        session_destroy();
    }
}
header('Refresh: 1; url= ../index.php');