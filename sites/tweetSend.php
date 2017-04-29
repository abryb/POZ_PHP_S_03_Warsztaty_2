<?php
require_once('../autoloader.php');

session_start();

// client = loged in user
$client = null;

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
}

// Reception of tweet form
if ($client != null) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['tweet'])) {
            $tweet = new tweet();
            $tweet->setText($_POST['tweet']);
            $tweet->setUserId($_SESSION['id']);
            $tweet->save();
        }
    }
}
header('Refresh: 0; url= ../index.php');