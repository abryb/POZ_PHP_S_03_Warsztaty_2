<?php
require_once('../autoloader.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        $obj1 = new user();
        $obj1->setUsername($_POST['username']);
        $obj1->setEmail($_POST['email']);
        $obj1->setpasswordHash($_POST['password']);
        $obj1->save();
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"<?php
?>
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h1>Welcome to Tweeter: new, better Twitter made in Poland</h1>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            </div>
        </div>
    </div>
</body>
</html>