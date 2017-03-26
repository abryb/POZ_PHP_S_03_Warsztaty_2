<?php
require_once('../autoloader.php');

session_start();
$client = null;
$tweet = null;        

if (!empty($_SESSION['email']) && !empty($_SESSION['id'])) {
    $client = user::loadById($_SESSION['id']);
} 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET)) {
        $tweet = tweet::loadById($_GET['id']);        
        if ($tweet) {
            $_SESSION['tweetPostId'] = $_GET['id']; // jak wyślemy post to nie pójdzie get, więc zapisuje w session
        }        
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SESSION['tweetPostId'] && $client) {
        $tweet = tweet::loadById($_SESSION['tweetPostId']);
        if (!empty($_POST['comment'])){
            $comment = new comment();
            $comment->setText($_POST['comment']);
            $comment->setUserId($_SESSION['id']);
            $comment->setPostId($_SESSION['tweetPostId']);
            $comment->save();
        }
    }
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
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        
      </ul>
    </div>
  </div>
</nav>

<div class="container">

  <div class="row">
    <div class="col-sm-2">

    </div>
    <div class="col-sm-6 ">
    <?php 
    if ($tweet) {
        $tweetAuthor = user::loadById($tweet->getUserId());
        echo "<table><tr><td> " . $tweetAuthor->getUsername() . "</td><td> " . $tweetAuthor->getEmail() .
                    " </td><td> " . $tweet->getCreationDate() . 
                " </td></tr><tr id='text'><td colspan='3'>" . $tweet ->getText() . " </td></tr></table>";
        

    ?>
        <div>
            <h4>Komentarze</h4>
        <?php 
        $allComments = comment::loadAllByPostId($_SESSION['tweetPostId']);
        foreach ($allComments as $comment) {
            $author = user::loadById($comment->getUserId());
            echo "<table class='comments'><tr><td> " . $author->getUsername() . " </td><td> " . $author->getEmail() .
                    " </td><td> " . $comment->getCreationDate() . " </td></tr><tr><td colspan='3'> " . 
                    $comment ->getText() . " </td></tr></table>"; 
        }   
    }
    ?>
        </div>
    </div>
    <div class="col-sm-4">
        <?php if ($client) {?>
        <form action="" method="post" role="form" >
                <label for="comment">Comment:</label>
                <input type="text" class="form-control" name="comment" id="comment"
                       placeholder="Write comment">                  
            <button type="submit" class="btn btn-success">Send</button>
        </form>
        <?php } ?>
    </div>
  </div>
</div>

</body>
</html>
    
            
        