<?php

header('Content-Type: application/json; charset=utf-8');    //Típus, karakterkódolás megadása
header('Access-Control-Allow-Origin: *');   //CORS kikapcsolása

//Teszt
//$data = array('teszt' => 'valami');
//echo json_encode($data);
//Sikeres

require_once './connection.php';    //Kapcsolat meghívása

$keres = explode("/", $_SERVER["QUERY_STRING"]);    //'QUERY_STRING' tárolása változóban

switch ($keres[0]) {    
    case 'dolgozok':    //Végpont létrehozása
        
        switch ($_SERVER["REQUEST_METHOD"]) {   //Kérés típusa
            
            case 'GET':   //'GET' kérés
                $valasz = $conn -> query("SELECT * FROM `dolgozok`");   //Lekérés adatbázisból
                http_response_code(201);    //Http kód visszaadása
                echo json_encode($valasz -> fetch_all(MYSQLI_ASSOC));   //Lekérdezés kiírása
                break;
            
            case 'POST':    //POST kérés
                //Oszlopok tárolása
                $nev = $_POST['nev'];
                $neme = $_POST['neme'];
                $reszleg = $_POST['reszleg'];
                $belepesev = $_POST['belepesev'];
                $ber = $_POST['ber'];

                //SQL parancs
                $stmt = $conn -> prepare("INSERT INTO `dolgozok` (`nev`, `neme`, `reszleg`, `belepesev`, `ber`) VALUES (?, ?, ?, ?, ?)");
                $stmt -> bind_param("sssii", $nev, $neme, $reszleg, $belepesev, $ber);
                $stmt -> execute();

                http_response_code(201);    //Http kód visszaadása
                break;
            
            default:
                break;
        }
    
    break;
    default:
        http_response_code(401);    //Http kód visszaadása
        echo json_encode(array("HIBA" => "Ismeretlen végpont!"));   //Hiba esetén közöljük
        break;
}