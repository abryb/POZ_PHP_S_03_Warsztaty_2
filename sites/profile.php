<?php
require_once('../autoloader.php');

session_start();

$client = null; // Client = loged user

$outcome = ''; // possible information about searching for user

// Setting clieng if exist, if not redirects to index page
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
} else {
    header('Refresh: 0; url= ../index.php');
    exit;
}

// Reception of GET form below. Creates user object of user with id from GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['id'])) {
        $user = user::loadById($_GET['id']);
        if (!empty($user)) {
            $_SESSION['receiverId'] = $user->getId();
        } else {
            $outcome = 'nie ma użytkownika o takim id';
        }
    }
}

// Receptiom of message form. 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['message'])) {
        $message = new message();
        $message->setReceiverId($_SESSION['receiverId']);
        $message->setSenderId($client->getId());
        $message->setText($_POST['message']);
        $result = $message->save();
        if ($result == true) {
            $_SESSION['send'] = true;
            header("Refresh:0 url=messages.php");
        }
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tweeter</title>
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
                </button>
                <a class="navbar-brand" href="../index.php">Tweeter</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="profile.php?id=<?php echo $client->getId() ?>">Profile</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($client) { ?>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span><?php echo $client->getUsername(); ?></a></li>
                    <?php } ?>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    <li><a href="messages.php"><span class="glyphicon glyphicon-log-in"></span> Messages</a></li>
                    <li><a href="settings.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-6 ">
                <?php
                // In case of trying to find user by not-existsing id 
                echo $outcome;
                // Writes out all tweets of seleceted user, may be a client
                if (!empty($user)) {
                    echo "<h3>Użytkownik " . $user->getUsername() . "</h3>";
                    echo "<h3>Email: " . $user->getEmail() . "</h3>";
                    $allTweets = tweet::loadAllByUserId($user->getId());                    
                    foreach ($allTweets as $tweet) {
                        $allComments = comment::loadAllByPostId($tweet->getId());                        
                        echo "<a href=tweet.php?id=" . $tweet->getId() . ">";
                        echo "<table><tr><td> " . $user->getUsername() . " </td><td> " . $user->getEmail() .
                        " </td><td> " . $tweet->getCreationDate() . " </td></tr><tr><td colspan='3'> " .
                        $tweet->getText() . " </td></tr><tr><td> Liczba Komentarzy :". count($allComments) ."</td></tr></table>";
                        echo "</a>";
                    }
                }
                ?>        
            </div>
            <div class="col-sm-4">
                <?php
                // If clients is not looking on himself, he can write a message
                if (!empty($user)) {
                if ($user->getId() != $client->getId() && $user->getId() != null) {
                    ?>
                    <form action="" method="post" role="form" >
                        <label for="message">Napisz wiadomość</label>
                        <input type="text" class="form-control" name="message" id="message"
                               placeholder="Write message">                  
                        <button type="submit" class="btn btn-success">Send</button>
                    </form>
                <?php }}
                ?>
            </div>
        </div>
    </div>

</body>
</html>