<?php
require_once('../autoloader.php');

$stringToMakeThisWork = "W sierpniu 1980 brał udział w organizowaniu zaplanowanego przez Bogdana Borusewicza strajku w Stoczni Gdańskiej. 14 sierpnia dołączył do inicjujących w tym zakładzie protest Jerzego Borowczaka, Bogdana Felskiego i Ludwika Prądzyńskiego. Po przemówieniu do dyrektora Stoczni Gdańskiej Klemensa Gniecha, w którym przypomniał o swoim zwolnieniu, wszedł w skład Komitetu Strajkowego, a następnie stanął na jego czele[11]. Po tym jak władze zgodziły się na główne postulaty (podwyższenie pensji, a także na tablicę upamiętniającą ofiary wydarzeń grudniowych i przywrócenie zwolnionych pracowników), Lech Wałęsa ogłosił przegłosowaną decyzję Komitetu Strajkowego o zakończeniu protestu. Jeszcze tego samego dnia, po konsultacji m.in. z przedstawicielami innych zakładów pracy, ogłosił strajk solidarnościowy, a następnego został przewodniczącym Międzyzakładowego Komitetu Strajkowego[12]. 31 sierpnia 1980 z ramienia MKS podpisał z delegacją rządową pod przewodnictwem wicepremiera Mieczysława Jagielskiego gdańskie porozumienia sierpniowe. Podpis złożył charakterystycznym dużym długopisem z wizerunkiem papieża Jana Pawła II[13].
Lech Wałęsa został przywrócony do pracy w Stoczni Gdańskiej. 17 września 1980 stanął na czele nowo utworzonej Krajowej Komisji Porozumiewawczej, organu koordynującego założonego na bazie MKS ogólnopolskiego Niezależnego Samorządnego Związku Zawodowego „Solidarność”. W 1981 został wybrany najpierw na przewodniczącego zarządu Regionu Gdańskiego, a następnie – na pierwszym Krajowym Zjeździe Delegatów w Gdańsku – na pierwszego przewodniczącego NSZZ „S”, otrzymując już w pierwszej turze około 55% głosów i pokonując tym samym Andrzeja Gwiazdę, Mariana Jurczyka i Jana Rulewskiego[14]. Prowadzony w latach 1980–1981 przez Lecha Wałęsę związek zawodowy przekształcił się w masowy ruch społeczno-polityczny, liczący w szczytowym okresie około 10 mln członków, wokół którego powstawały organizacje satelickie, m.in. Niezależny Samorządny Związek Zawodowy Rolników Indywidualnych „Solidarność” i Niezależne Zrzeszenie Studentów.";

$words = explode(' ', $stringToMakeThisWork);

$wordsCount = count($words)-1;

function randomName() { 
    global $words;
    global $wordsCount;
    return $words[mt_rand(0, $wordsCount)] . " " . $words[mt_rand(0, $wordsCount)];
    
}

//$randomName = $words[mt_rand(0, $wordsCount)] . " " . $words[mt_rand(0, $wordsCount)];
echo randomName();
echo randomName();

var_dump($_POST);

/*

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['number'])) {
        var_dump($_POST['number']);
        $db = new db();
//        for ($i = 0; $i < $_POST['number']/2; $i ++) {
//            $user = new user();
//            $user->setEmail($words[mt_rand(0, $wordsCount)] , "@" . $words[mt_rand(0, $wordsCount)]);
//            $user->setUsername($words[mt_rand(0, $wordsCount)] . " " . $words[mt_rand(0, $wordsCount)]);
//            $user->setPasswordHash($words[mt_rand(0, $wordsCount)]);
//            $user->save();  
//        }
//        
        //Create tweets
        $allUsers = [];
        $sql = "use twitter";
        $db->conn->query($sql);
        $sql = "SELECT id FROM users";
        $result = $db->conn->query($sql);
        foreach ($result as $value) {
            $allUsers[] = $value['id'];
        }
        var_dump($allUsers);
        $countAllUsers = count($allUsers) -1;
        for ($i = 0; $i < $_POST['number']; $i ++) {
            $length = mt_rand(0, 20);
            $text = '';
            for ($i = 0; $i < $length; $i++) {
                $text .= $words[mt_rand(0, $countAllUsers)];
            }            
            $tweet = new tweet();
            $tweet->setText($text);
            $tweet->setUserId($allUsers[mt_rand(0, $countAllUsers)]);
            $tweet->save();
        }
        
        //Create comments
        $allTweets = [];
        $sql = "SELECT id FROM tweets";
        $result = $db->conn->query($sql);
        foreach ($result as $value) {
            $allTweets[] = $value['id'];
        }
        $countAllTweets = count($allTweets) -1;
        for ($i = 0; $i < $_POST['number'] * 2; $i ++) {
            $length = mt_rand(3, 7);
            $text = '';
            for ($i = 0; $i < $length; $i++) {
                $text .= $words[mt_rand(0, $countAllUsers)];
            }
            $comment = new comment();
            $comment->setText($text);
            $comment->setUserId($allUsers[mt_rand(0, $countAllUsers)]);
            $comment->setPostId($allTweets[mt_rand(0, $countAllTweets)]);
            $comment->save();  
        }
        for ($i = 0; $i < $_POST['number']; $i ++) {
  
        }
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tweeter Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
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
                    <li class="active"><a href="profile.php">Profile</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4 ">

                <!--FORM-->
                <h3>Create Random Activity<h3>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="number">type a number:</label>
                        <input type="number" max="20" class="form-control" name="number" id="number"
                               placeholder="">                    
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>  
                <!--FORM END-->

            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>

</body>
</html>


*/