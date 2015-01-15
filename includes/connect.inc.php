<?php

include "password.inc.php";

try {
    $pdo=new PDO($host,$username,$password);
    $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec ('SET NAMES "utf8"');
} catch (Exception $e) {
    echo "<br>Det gick inte att kontakta databasen<br>";
    exit ();
}

?>