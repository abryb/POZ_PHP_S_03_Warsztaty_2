<?php
require_once('../autoloader.php');
session_start();
if (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header('Refresh: 0; url= ../index.php');
} else {
    $user = user::loadById($_SESSION['id']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/style.css" type="text/css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <a class="navbar-brand" href="../index.php">Tweeter</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="sites/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    
<div class="container">
</div>

<div class="container">

  <div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-6 ">
        <?php 
        $allTweets = tweet::loadAllByUserId($_SESSION['id']);
        foreach ($allTweets as $tweet) {
            echo "<a href=tweet.php?id=" . $tweet->getId() . ">";
            echo "<table><tr><td> " . $user->getUsername() . " </td><td> " . $user->getEmail() .
                    " </td><td> " . $tweet->getCreationDate() . " </td></tr><tr><td colspan='3'> " . 
                    $tweet ->getText() . " </td></tr></table>"; 
            echo "</a>";
        }
        ?>        
    </div>
    <div class="col-sm-4">
        <form action="../index.php" method="post" role="form" >
                <label for="tweet">Tweet:</label>
                <input type="text" class="form-control" name="tweet" id="tweet"
                       placeholder="Write tweet">                  
            <button type="submit" class="btn btn-success">Send</button>
        </form>
    </div>
  </div>
</div>

</body>
</html>