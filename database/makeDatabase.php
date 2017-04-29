<?php
// db class
require_once('../src/util/db.php');
//Creates new Database connection object,
$db = new db();

//If there IS proper database redirects to index.php (for example after using form below
if ($db->conn !=null && $db->changeDB('twitter') != false) {
        header('Refresh: 0; url= ../index.php');
        exit;
}
// Reception od form makeing database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['awesome'])) {
        $db=new db();
        $sql = file_get_contents("Dbquery.txt");
        $db->conn->query($sql);

    }
}

// If there is no connection writes out information
if ($db->conn == null) {
    echo "<h3>Brak połączenia z bazą danych</h3>";
    echo "<h3>Otwórz plik src/util/db.php i zmień domyślne wartości host,user i pass </h3>";
    exit;
}
// If there is no twitter Database writes out message
if ($db->changeDB('twitter') == false) {
    echo "<h3>Wygląda na to że nie masz bazy danych 'twitter'</h3>";
    echo "Jeśli chcesz stworzymy razem tę bazę danych.<br><br>Spróbuj załadować z pliku w folderze database o nazwie twitter.sql "
    . "potrzebną bazę danych<br>";
    echo "<br> A jeśli wolisz, wyślij poniższy formularz. Zrobi to za Ciebie.<br><br><br>";
}


?>

<!--Form sending sql querys to make database twitter with tables and mr. President user-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tweeter Main Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <form action="" method="post" role="form">
            <input name="awesome" value="true" hidden>
            <button type="submit" class="btn btn-success">Stwórz bazę danych</button>
        </form>
    </body>
</html>