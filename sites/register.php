<?php
require_once('../autoloader.php');

session_start();

$outcome = ''; // response to registration form

// If user is already loged in, redirects to index.php
if ( isset($_SESSION['id']) && isset($_SESSION['email']) ) {
    header('Refresh: ; url= ../index.php');
}

// Reception of signup form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        if (user::loadByEmail($_POST['email'])) {
            $outcome =  "Podany email jest już zajęty";
        }else {
            if (user::loadByUsername($_POST['username'])) {
                $outcome =  "Podana nazwa użytkownika jest już zajęta";
            } else {
                $obj1 = new user();
                $obj1->setUsername($_POST['username']);
                $obj1->setEmail($_POST['email']);
                $obj1->setpasswordHash($_POST['password']);
                $obj1->save();
                $outcome =  "Rejestracja się powiodła!<br>";
                header('Refresh: 2; url=login.php');
            }
        }
    } else {
        $outcome = "Nie podałeś wszystkich informacji";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title>Tweeter Register </title>
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
      </button>
      <a class="navbar-brand" href="../index.php">Tweeter</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
          <li class="active"><a href="profile.php">Profile</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    
<div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4 ">
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
        <!--Informations about unsuccesfull regestration--> 
        <?php echo $outcome ?>
    </div>
    <div class="col-sm-4">
    </div>
  </div>
</div>

</body>
</html>
