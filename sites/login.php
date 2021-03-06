<?php
require_once('../autoloader.php');

session_start();

// Feedback of login try
$outcome = '';

// Reception of login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $passwordVerify = false;
        $obj = user::loadByEmail($_POST['email']);
        if ($obj) {
            $passwordVerify = password_verify($_POST['password'], $obj->getPasswordHash());
            if ($passwordVerify === true) {
                $_SESSION['email'] = $obj->getEmail();
                $_SESSION['id'] = $obj->getId();
                $_SESSION['username'] = $obj->getUsername();
            } else {
                $outcome = "Podałeś niepoprawne hasło";
            }
        } else {
            $outcome = "Nie ma takiego użytkownika";
        }
    } else {
        $outcome = "Nie podałeś danych do logowania";
    }
}

// Redirects to index.php if user is loged in 
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header('Refresh: 0; url= ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tweeter</title>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4 ">

                <!--FORM-->
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email"
                               placeholder="Your email">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="">                    
                    </div>
                    <button type="submit" class="btn btn-success">LOG IN</button>
                    <?php echo $outcome ?>
                </form>  
                <!--FORM END-->

            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>

</body>
</html>
