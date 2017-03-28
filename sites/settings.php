<?php
require_once('../autoloader.php');

session_start();

$editToolbar = false;
$outcome = ''; // Possible informations about wrong input data in form

// Setting clieng if exist, if not redirects to index page
if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    $client = user::loadById($_SESSION['id']);
} else {
    header('Refresh: 0; url= ../index.php');
    exit;
}

// Simple user data change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($client)) {
    //If password was send
    if (!empty($_POST['password'])) {
        //Check if password is correct
        $passwordVerify = password_verify($_POST['password'], $client->getPasswordHash());
        if ($passwordVerify === true) {
            // if it is
            if ($_POST['delete'] === 'yes') {
                // and user send delete request, delete user
                $client->delete();
                session_destroy();
                //and redirect to index
                header('Refresh: 0; url= ../index.php');
                exit;                
            }
            //or change clients email, usename, pasword
            if (!empty($_POST['email'])) {
                $client->setEmail($_POST['email']);
                $outcome .= 'Email został zmieniony,';
            }
            if (!empty($_POST['username'])) {
                $client->setEmail($_POST['username']);
                $outcome .= 'Nazwa użytkownia została zmieniona,';
            }
            if (!empty($_POST['newpassword'])) {
                $client->setPasswordHash($_POST['newpassword']);
                $outcome .= 'hasło zostało zmienione,';
            }
        }
    }
    $client->save();
    if ($client->save() == false) {
        $outcome = "Coś poszło nie tak, nie udało się zmienić danych";
    }
    $_SESSION['email'] = $client->getEmail();
    $_SESSION['id'] = $client->getId();
    $_SESSION['username'] = $client->getUsername();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
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
                    echo $outcome;
                    if (!empty($client)) {
                    ?>
                        <!--FORM changing client email, username, password or request to delete an account-->
                        <h3>Formularz zmiany danych. Potwierdź hasłem. Aby usunąć konto, wpisz swoje hasło wybierz usuń</h3>
                        <form action="" method="post" role="form" >
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       placeholder="Your email">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" id="username"
                                       placeholder="Your username">
                                <label for="newpassword">New Password:</label>
                                <input type="password" class="form-control" name="newpassword" id="newpassword"
                                       placeholder=""> 
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="">
                                <label for="delete">Czy rezygnujesz z naszej wspaniałej usługi? :</label>
                                <select id="delete" name="delete">
                                    <option value="no" defoult>Nie</option>
                                    <option value="yes">Tak, chce sobie iść</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">REGISTER</button>
                        </form>
                    <?php }
                    ?>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>

    </body>
</html>