<?php
require_once('../autoloader.php');

session_start();

$client = false;
$message = null;

// Setting clieng if exist, if not redirects to index page
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
} else {
    header('Refresh: 0; url= ../index.php');
    exit;
}

// Setting of message to show
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['id'])) {
        $message = message::loadById($_GET['id']);
        $sender = user::loadById($message->getSenderId());
        $receiver = user::loadById($message->getReceiverId());
        if (!empty($message->getId())) {
            $_SESSION['messageId'] = $message->getId();
        }
    }
}

// Handling form sending message from President
$mrPresidentQuots = [
    'A jak się nie wie, co się buduje, to nawet szałasu nie można rozbierać, bo deszcz na głowę będzie padał.',
    'Dobrze się stało, że źle się stało.',
    'Dokonałem zwrotu o 360 stopni.',
    'Dzięki komputerom uda się nam pogodzić kapitalistyczną skuteczność z dużą ilością wolnego czasu, właściwą dla socjalizmu.',
    'Gdyby w jeziorze były ryby, wędkowanie nie miałoby sensu.',
    'Może założę jakiś biznes i będę bogaty.',
    'Nie mogło być lepiej to chciałem, żeby było śmieszniej.',
    'Nie można mieć pretensji do Słońca, że kręci się wokół Ziemi.'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lech'])) {
        $president = user::loadByUsername('Lech W');
        $exampleMessage = new message();
        $exampleMessage->setText($mrPresidentQuots[mt_rand(0, 7)]);
        $exampleMessage->setReceiverId($client->getId());
        $exampleMessage->setSenderId($president->getId());
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
                        <li><a href="settings.php"><span class="glyphicon glyphicon-log-in"></span> Settings</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <!--Sending message from mr. President-->
                    <h3>Wyślij sobie wiadomośc od Prezydenta</h3>
                    <form action="" method="post" role="form" >
                        <button type="submit" class="btn btn-success" name="lech" style="width: 100px">Ślij</button>
                    </form>
                </div>
                <div class="col-sm-10">

                </div>
                <?php
                // Displays all text message
                if (!empty($_SESSION['messageId']) && !empty($message)) {
                    echo "<h6>From ". $sender->getUsername(). " To : ". $receiver->getUsername()
                            . "</h6><br><h2>". $message->getText() . "</h2>";
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
                // Writes out all received messages
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
                // Writes out all send messages
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
</html
