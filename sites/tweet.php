<?php
require_once('../autoloader.php');
session_start();

echo "Na tej stronie możesz uzyskać informacje o każdym tweetcie, pod warunkiem że znasz jego id";


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET)) {
        $id = $_GET['id'];
        $tweet = tweet::loadById($id);
        if ($tweet) {
            $user = user::loadById($tweet->getUserId());
            var_dump($tweet);
            echo "<table><tr><td> " . $user->getUsername() . "</td><td> id: ".
                    $user->getId()." </td><td> " . $user->getEmail() .
                        " </td><td> " . $tweet->getCreationDate() . 
                    " </td></tr><tr id='text'><td>tweet id: ".$tweet->getId().
                    "</td><td colspan='3'>" . $tweet ->getText() . " </td></tr></table>";
        }        
    }
}