<?php
require_once('./autoloader.php');
session_start();
if (!empty($_SESSION['email']) && !empty($_SESSION['id'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['tweet'])){
            $tweet = new tweet();
            $tweet->setText($_POST['tweet']);
            $tweet->setUserId($_SESSION['id']);
            $tweet->save();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title>Tweeter Main Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/style.css" type="text/css">
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
      <a class="navbar-brand" href="#">Tweeter</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li class="active"><a href="sites/profile.php">Profile</a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <?php 
          if (!isset($_SESSION['email'])) {
          ?>
          <li><a href="sites/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <li><a href="sites/register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
          <?php }else{ 
          ?>
          <li><a href="sites/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          <li><a href="sites/messages.php"><span class="glyphicon glyphicon-log-in"></span> Messages</a></li>
          <li><a href="sites/settings.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
          <?php } 
          ?>
      </ul>
    </div>
  </div>
</nav>
    
<div class="container">
    <?php
    if (!isset($_SESSION['email'])) {
    ?>
    <h1>Nie jesteś zalogowany, zaloguj się lub stwórz konto</h1>
    <?php }else{
    ?>
    <h1>Jesteś zalogowany</h1>
    <?php }
    ?>
</div>

<?php if (!empty($_SESSION['email']) && !empty($_SESSION['id'])) {
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                
            </div>
            <div class="col-sm-6 ">
                <form action="" method="post" role="form" >
                    <label for="tweet">Tweet:</label>
                    <input type="text" class="form-control" name="tweet" id="tweet"
                       placeholder="Write tweet">                  
                    <button type="submit" class="btn btn-success">Send</button>
                    </form>
            </div>
            <div class="col-sm-4">
                
            </div>
        </div>
    </div>    
<?php }
?>    
<div class="container">

  <div class="row">
    <div class="col-sm-4">

    </div>
    <div class="col-sm-6 ">
        <?php 
        $allTweets = tweet::loadAll();
        foreach ($allTweets as $tweet) {
            $user = user::loadById($tweet->getUserId());
            echo "<table><tr><td><a href='sites/profile.php?id=". $user->getId()
                    . "'>" . $user->getUsername() . "</a></td><td> " . $user->getEmail() .
                    " </td><td> " . $tweet->getCreationDate() . " </td></tr>";
            echo "<tr><td colspan='3'>" . "<a href=sites/tweet.php?id=" . 
                 $tweet->getId() . ">" . $tweet ->getText() . "</a></td></tr></table>";   
        }
        ?>        
    </div>
    <div class="col-sm-4">

    </div>
  </div>
</div>

</body>
</html>
