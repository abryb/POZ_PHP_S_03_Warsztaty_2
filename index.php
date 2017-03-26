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
            <a href="sites/login.php"><button type="submit" class="btn btn-success">REGISTER</button></a>
            <form action="sites/logout.php" method="post" role="form">
            <button type="submit" name="logut" value="true"class="btn btn-success">LOGOUT</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
// Tworzenie losowych userów (odświeżając stronę) o imieniu Janusz z Obornik - działa
// $obj1 = new user();
// $obj1->setUsername('Michal z Gdanska '.rand(0,99));
// $obj1->setEmail('michal'.rand(0,99).'@wp.pl');
// $obj1->setpasswordHash('michal'.rand(0,99));
// $obj1->save();

// Wczytanie usera o id istniejącym - działa
// $obj1 = user::loadById(4);
// var_dump($obj1);

//Wczytanie usera o id nieistniejącym - działa, zwraca NULL
// $obj1 = user::loadById(90032321);
// var_dump($obj1);
// $obj2 = user::loadById(-1);
// var_dump($obj2);
 
//Wczytanie wszystkich userów - działa
//var_dump(user::loadAll());

//Modyfikacja obiektu - działa
// $obj1 = user::loadById(4);
// $obj1->setUsername('To nie jest Krzysztof');
// $obj1->save();
// var_dump($obj1);
 
 // Usuwanie usera. - działa, 
 // jak się odświeży stronę to sypnie błędy bo będzie użyta metoda klasy user
 //  na zmiennej która ma wartość null (loadById zwróci null)
// $obj2 = user::loadById(15);
// var_dump($obj2);
// $obj2->delete();
// var_dump($obj2);

//Tworzenie nowego tweeta - działa
// $obj1 = new tweet();
// $obj1->setUserId(1);
// $obj1->setText('nasz michal '.rand(0,99).' to baju baju ');
// $obj1->setcreationDate(null);
// $obj1->save();
?>