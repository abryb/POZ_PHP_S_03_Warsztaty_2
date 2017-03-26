<?php
require_once('../autoloader.php');

session_start();

$editToolbar = false;

if ( isset($_SESSION['id']) && isset($_SESSION['email']) ) {
    $client = user::loadById($_SESSION['id']);
}

// Prosta zmiana danych
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $client) {
    if (!empty($_POST['email'])) {
        $client->setEmail($_POST['email']);
    } 
    if (!empty($_POST['username'])) {
        $client->setUsername($_POST['username']);
    }
    if (!empty($_POST['password'])) {
        $client->setPasswordHash($_POST['password']);
    }
    $client->save();
    $_SESSION['email'] = $client->getEmail();
    $_SESSION['id'] = $client->getId();
    $_SESSION['username'] = $client->getUsername();
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
        <?php if (isset($_SESSION['email'])) { ?>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span><?php echo $client->getUsername(); ?></a></li>
        <?php } ?>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        <li><a href="messages.php"><span class="glyphicon glyphicon-log-in"></span> Messages</a></li>
      </ul>
    </div>
  </div>
</nav>
    
<div class="container">
  <div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-6 ">
                
    </div>
    <div class="col-sm-4">
        
        <h3>Formularz zmiany danych</h3>
        <form action="" method="post" role="form" >
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" id="email"
                       placeholder="Your email">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username"
                       placeholder="Your username">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password"
                       placeholder="">                    
            </div>
            <button type="submit" class="btn btn-success">REGISTER</button>
        </form>
    </div>
  </div>
</div>

</body>
</html>