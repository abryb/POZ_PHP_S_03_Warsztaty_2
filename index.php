<?php
// File checking connection with database
require_once('src/util/checkDB.php');
//Loader klas
require_once('./autoloader.php');

session_start();

// client = loged in user
$client = null;

//parse_str(file_get_contents("php://input"), $put_vars);
//var_dump(file_get_contents("php://input"));
//var_dump($put_vars);

// Seting client if exist
if ( isset($_SESSION['id']) && isset($_SESSION['email']) ) {
    $client = user::loadById($_SESSION['id']);
}

// Reception of tweet form
if ($client != null) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['tweet'])) {
            $tweet = new tweet();
            $tweet->setText($_POST['tweet']);
            $tweet->setUserId($_SESSION['id']);
            $tweet->save();
        }
    }
}
?>
<!--HTML HEAD-->
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
<!--HTML HEAD END-->
<body>
    <!--NAVBAR-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">                   
                </button>
                <a class="navbar-brand" href="#">Tweeter</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!--Checking if client exists, if so shows link to profile page-->
                    <?php if ($client != null) { ?>
                    <li class="active"><a href="sites/profile.php?id=<?php echo $client->getId() ?>">Profile</a></li>
                    <?php } 
                    ?>
                    <!--end-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php                    
                    if (!$client) {
                        // If viewer isn't loged shows Login and Register links
                        ?>
                        <li><a href="sites/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <li><a href="sites/register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                    <?php } else {
                        // else shows logout, messages, settings link
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
    <!--NAVBAR END-->
    
    <!--TWEET FORM-->
    <?php
    // If client exists
    if ($client != null ) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-6 ">
                    <form action="" method="post" role="form" >
                        <label for="tweet">Tweet:</label>
                        <input type="text" maxlength="140" class="form-control" name="tweet" id="tweet"
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
    <!--TWEET FORM END-->    
    
    <!--VIEW OF ALL TWEETS-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-6 ">
                <?php
                if ($client!=null) {
                    $allTweets = tweet::loadAll();
                    foreach ($allTweets as $tweet) {
                        $user = user::loadById($tweet->getUserId());
                        echo "<table><tr><td><a href='sites/profile.php?id=" . $user->getId()
                        . "'>" . $user->getUsername() . "</a></td><td> " . $user->getEmail() .
                        " </td><td> " . $tweet->getCreationDate() . " </td></tr>";
                        echo "<tr><td colspan='3'>" . "<a href=sites/tweet.php?id=" .
                        $tweet->getId() . ">" . $tweet->getText() . "</a></td></tr></table>";
                    }
                } else {
                ?>
                <h3>Nie jesteś zalogowany, <a href = "sites/login.php">zaloguj się</a> lub <a href = "sites/register.php">załóż konto</a></h3>
                <?php } 
                ?>        
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
    <!--VIEW OF ALL TWEETS END-->

</body>
</html>
