<?php
require_once('./autoloader.php');
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <?php
    if (!isset($_SESSION['email'])) {
    ?>
    <div class="container">
        <h1>NIe jesteś zalogowany, zaloguj się lub stwórz konto</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <a href="sites/login.php"><button type="" class="btn btn-success">LOG IN</button></a>
                <a href="sites/register.php"><button type="" class="btn btn-success">REGISTER</button></a>
            </div>
        </div>
    </div>
    
    <?php }else{ ?>
    <div class="container">
        <h1>Jesteś zalogowany</h1>
    </div>
    <div class="container">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <a href="sites/profile.php"><button type="" class="btn btn-success">PROFILE</button></a>
            <form action="sites/logout.php" method="post" role="form">
                <button type="submit" name="logut" value="true"class="btn btn-success">LOGOUT</button>
            </form>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

        </div>
    </div>  
    <div class="container">
        
    </div>
    <div class="container">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <?php 
        $allTweets = tweet::loadAll();
        foreach ($allTweets as $tweet) {
            var_dump($tweet);
            echo $tweet->getText();
        }
        
        ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
    <div class="container">
        
    </div>
    <?php }?>
</body>
</html>

<?php
?>