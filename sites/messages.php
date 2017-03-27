<?php
require_once('../autoloader.php');

session_start();

$client = false;
$message = null;

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
} else {
    header('Refresh: 0; url= ../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['id'])) {
        $message = message::loadById($_GET['id']);
        if (!empty($message->getId())) {
            $_SESSION['messageId'] = $message->getId();
        }
    }
}

//Obsługa wiadomości od prezydenta
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lech'])) {
        $exampleMessage = new message();
        $exampleMessage->setText('A jak się nie wie, co się buduje, to nawet szałasu nie można rozbierać, bo deszcz na głowę będzie padał.');
        $exampleMessage->setReceiverId($client->getId());
        $exampleMessage->setSenderId(42);
        $exampleMessage->save();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Messages</title>
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
                        <?php if ($client) { ?>
                            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span><?php echo $client->getUsername(); ?></a></li>
                        <?php } ?>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                        <li><a href="settings.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <h5>Wyślij sobie wiadomośc od Prezydenta</h5>
                    <form action="" method="post" role="form" >
                        <button type="submit" class="btn btn-success" name="lech">Ślij</button>
                    </form>
                </div>
                <div class="col-sm-10">

                </div>
                <?php
                if (!empty($_SESSION['messageId']) && !empty($message)) {
                    echo "<h3>" . $message->getText() . "</h3>";
                    $message->setRead(1);
                    $message->save();
                    $_SESSION['messageId'] = null;
                }
                ?>
            </div>
        </div>                
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <?php
                if ($client) {
                    echo "<h3>Wiadomości odebrane: </h3><br><table>";
                    $allMessages = message::loadAllByUserId($client->getId(), 1);
                    foreach ($allMessages as $mess) {
                        $sender = user::loadById($mess->getSenderId());
                        $isRead = ($mess->getRead() == 1) ? '' : 'NIEPRZECZYTANA';
                        echo "<tr><td><a href='profile.php?id=" . $mess->getSenderId() . "'>" . $sender->getUsername() . "</a></td>";
                        echo "<td>$isRead</td>";
                        echo "<td><a href='messages.php?id=" . $mess->getId() . "'>" . substr($mess->getText(), 0, 30) . "</a></td></tr>";
                    }
                    echo "</table>";
                }
                ?>        
            </div>
            <div class="col-sm-1 ">

            </div>
            <div class="col-sm-5">
                <?php
                if ($client) {
                    echo "<h3>Wiadomości wysłane: </h3><br><table>";
                    $allMessages = message::loadAllByUserId($client->getId());
                    foreach ($allMessages as $mess) {
                        $receiver = user::loadById($mess->getReceiverId());
                        echo "<tr><td><a href='profile.php?id=" . $mess->getReceiverId() . "'>" . $receiver->getUsername() . "</a></td>";
                        echo "<td><a href='messages.php?id=" . $mess->getId() . "'>" . substr($mess->getText(), 0, 30) . "</a></td></tr>";
                    }
                    echo "</table>";
                }
                ?> 
            </div>
        </div>
    </div>

</body>
</html>