<?php
require_once('../autoloader.php');

session_start();

$client = null;
$tweet = null;

// Setting clieng if exist, if not redirects to index page
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
} else {
    header('Refresh: 0; url= ../index.php');
    exit;
}

// Reception of POST form of sending Comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['tweetPostId'] && $client) {
        $tweet = tweet::loadById($_SESSION['tweetPostId']);
        if (!empty($_POST['comment'])) {
            $comment = new comment();
            $comment->setText($_POST['comment']);
            $comment->setUserId($_SESSION['id']);
            $comment->setPostId($_SESSION['tweetPostId']);
            $comment->save();
        }
    }
}
header('Refresh: 0; url= '. $_SERVER['HTTP_REFERER']);