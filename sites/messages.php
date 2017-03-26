<?php
require_once('../autoloader.php');

session_start();

if ( isset($_SESSION['id']) && isset($_SESSION['email']) ) {
    $client = user::loadById($_SESSION['id']);
}else {
    header('Refresh: 0; url= ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title>Messages</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/style.css" type="text/css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style>
          table {
              border-collapse: separate;
          }
          tr {
              border 3px solid green;
          }
          
      </style>
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
        <?php if (isset($_SESSION['email'])) { ?>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span><?php echo $client->getUsername(); ?></a></li>
        <?php } ?>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    
<div class="container">
  <div class="row">
    <div class="col-sm-5">
        <?php
        if (!empty($client)) {
            echo "<h3>Wiadomości odebrane: </h3>";
            $allMessages = message::loadAllByUserId($client->getId());
            foreach ($allMessages as $mess) {
                echo "<a href=tweet.php?id=" . $mess->getId() . ">";
                echo "<table><tr><td> " . $client->getUsername() . " </td><td> " . $client->getEmail() .
                        " </td><td> " . $mess->getCreationDate() . " </td></tr><tr><td colspan='3'> " . 
                        $mess ->getText() . " </td></tr></table>"; 
                echo "</a>";
            }
        }
        
        
        ?>        
    </div>
    <div class="col-sm-1 ">
       
    </div>
    <div class="col-sm-5">
        <?php

        if (!empty($client)) {
            echo "<h3>Wiadomości wysłąne: </h3><br><table>";
            $allMessages = message::loadAllByUserId($client->getId(),1);
            foreach ($allMessages as $mess) {
                $receiver = user::loadById($mess->getReceiverId());
                echo "<tr><td><a href='profile.php?id=".$mess->getReceiverId()."'>".$receiver->getUsername()."</a></td>";
                echo "<td><a href='messages.php?id=".$mess->getId()."'>".$mess->getText()."</a></td></tr>";

            }
            echo "</table>";
        }
        ?> 

    </div>
  </div>
</div>

</body>
</html>