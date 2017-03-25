<?php
require_once('./autoloader.php');

// Tworzenie losowych userów (odświeżając stronę) o imieniu Janusz z Obornik - działa
// $obj1 = new user();
// $obj1->setUsername('Janusz z Obornik '.rand(0,9));
// $obj1->setEmail('janusz14'.rand(0,9).'@wp.pl');
// $obj1->setpasswordHash('1234'.rand(0,9));
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
 // 
// $obj2 = user::loadById(15);
// var_dump($obj2);
// $obj2->delete();
// var_dump($obj2);
