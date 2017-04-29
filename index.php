<?php
// File checking connection with database
require_once('src/util/checkDB.php');
//Loader klas
require_once('./autoloader.php');

session_start();

// client = loged in user
$client = null;

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
}
?>
<!--HTML HEAD-->
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
                        <!--Showing proper buttons-->
                        <?php
                        if (!$client) {
                            // If viewer isn't loged shows Login and Register links
                            ?>
                            <li><a href="sites/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            <li><a href="sites/register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                        <?php
                        } else {
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
        // If client exists show write tweet form Post/Redirect/Get
        if ($client != null) {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-6 ">
                        <form action="sites/tweetSend.php" method="post" role="form" >
                            <label for="tweet">Tweet:</label>
                            <input type="text" maxlength="140" class="form-control" name="tweet" id="tweet"
                                   placeholder="Write tweet">                  
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </div>    
        <?php }
        ?>   
        <!--TWEET FORM END-->    

        <!--VIEW OF ALL TWEETS-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6 ">
                    <?php
                    if ($client != null) {
                        $allTweets = tweet::loadAll();
                        foreach ($allTweets as $tweet) {
                            $user = user::loadById($tweet->getUserId());
                            $allComments = comment::loadAllByPostId($tweet->getId());     
                            echo "<div class='tweet row'><div class='tweetInfo'>" .
                            "<span class='username'><a href=sites/profile.php?id=".$user->getId().">" . $user->getUsername() . "</a></span><span class='userEmail'>" . $user->getEmail() . "</span><span class='tweetdate'>" . $tweet->getCreationDate() . "</span>" .
                            "</div><div class='text'><a href='sites/tweet.php?id=" . $tweet->getId() . "'>" . $tweet->getText() . "</a></div><div class='comments'> Comments(".count($allComments).")</div></div>";
                        }
                    } else {
                        ?>
                        <h3>Nie jesteś zalogowany, <a href = "sites/login.php">zaloguj się</a> lub <a href = "sites/register.php">załóż konto</a></h3>
                    <?php }
                    ?>        
                </div>
                <div class="col-sm-3">
                </div>
            </div>
        </div>
        <!--VIEW OF ALL TWEETS END-->

    </body>
</html>
