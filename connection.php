<?php

$conn = new mysqli("localhost", "root", "", "dolgozok");    //Csatlakozás adatbázishoz

if ($conn -> errno) {   //Hiba esetén leáll
    echo 'Hiba a csatlakozas soran!';
    die();
}

$conn ->set_charset("utf8");    //Karakterkódolás megadása