<?php
require_once('../autoloader.php');
session_start();
$outcome = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $passwordVerify = false;
        $obj = user::loadByEmail($_POST['email']);
        if ($obj) {
            $passwordVerify = password_verify($_POST['password'], $obj->getPasswordHash());
            if ($passwordVerify === true) {
                $_SESSION['email'] = $obj->getEmail();
                $_SESSION['id'] = $obj->getId();
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?php 
            if (!empty($_SESSION['email'])) {
                header('Refresh: 1; url= ../index.php');
            } else {
            ?>
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
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <h5> NIE MASZ KONTA TO SIE ZAREJESTRUJ</h5>
            <form action="register.php" method="post" role="form" >
                    <button type="submit" class="btn btn-success">REGISTER</button>
            </form>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>
<?php }?>
</body>
</html>