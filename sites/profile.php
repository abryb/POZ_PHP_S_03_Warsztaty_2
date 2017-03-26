<?php
require_once('../autoloader.php');

session_start();
$userId= null;
$client=null;

if ( isset($_SESSION['id']) && isset($_SESSION['email']) ) {
    $client = user::loadById($_SESSION['id']);
    $clientId = $client->getId();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['id'])) {
        $user = user::loadById($_GET['id']);
        $userId= $user->getId();
        $_SESSION['receiverId'] = $userId;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['message'])) {
         $message = new message();
         $message->setReceiverId($client->getId());
         $message->setSenderId($_SESSION['receiverId']);
         $message->setText($_POST['message']);
         $result = $message->save();
         if ($result == true) {
             $_SESSION['send'] = true;
             header("Refresh:0 url=messages.php");
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
        <li class="active"><a href="profile.php">Profile</a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if ($client) { ?>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span><?php echo $client->getUsername(); ?></a></li>
        <?php } ?>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        <li><a href="messages.php"><span class="glyphicon glyphicon-log-in"></span> Messages</a></li>
        <li><a href="settings.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
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
        if (!empty($user)) {
            echo "<h3>Użytkownik " . $user->getUsername() . "</h3>";
            $allTweets = tweet::loadAllByUserId($user->getId());
            foreach ($allTweets as $tweet) {
                echo "<a href=tweet.php?id=" . $tweet->getId() . ">";
                echo "<table><tr><td> " . $user->getUsername() . " </td><td> " . $user->getEmail() .
                        " </td><td> " . $tweet->getCreationDate() . " </td></tr><tr><td colspan='3'> " . 
                        $tweet ->getText() . " </td></tr></table>"; 
                echo "</a>";
            }
        }
        ?>        
    </div>
    <div class="col-sm-4">
        <?php 
        if ($userId != $clientId && $userId != null) { 
        ?>
        <form action="" method="post" role="form" >
                <label for="message">Napisz wiadomość</label>
                <input type="text" class="form-control" name="message" id="message"
                       placeholder="Write message">                  
            <button type="submit" class="btn btn-success">Send</button>
        </form>
        <?php }
        ?>

    </div>
  </div>
</div>

</body>
</html>