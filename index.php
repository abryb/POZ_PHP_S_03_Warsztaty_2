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
<div class="container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <a href="sites/login.php"><button type="submit" class="btn btn-success">LOG IN</button></a>
            <a href="sites/register.php"><button type="submit" class="btn btn-success">REGISTER</button></a>
            <form action="sites/logout.php" method="post" role="form">
            <button type="submit" name="logut" value="true"class="btn btn-success">LOGOUT</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
?>