<?php
  include_once('database_manager.php');

  if (isset($_POST["submit"])) {

    //Get user input
    $naam = $_POST["naam"];
    $postcode = $_POST["postcode"];
    $email = $_POST["email"];
    $geboortedatum = $_POST["geboortedatum"];
    $klachtsoort = $_POST["klachtsoort"];
    $klacht = $_POST["klacht"];


    //Create user
    $sql = "INSERT INTO gebruiker (naam, postcode, email, geboortedatum)
    VALUES (:naam, :postcode, :email, :geboortedatum);";

    $arr = array("naam" => $naam, "postcode" => $postcode, "email" => $email, "geboortedatum" => $geboortedatum);

    db_statement($sql, $arr);


    //Get user ID
    $sql = "SELECT ID
    FROM gebruiker
    ORDER BY ID DESC
    LIMIT 1";

    $ret = db_statement($sql, null);

    $id = $ret[0] -> ID;


    //Create new complaint
    $sql = "INSERT INTO klacht (ID_gebruiker, ID_klachtsoort, datum, prioriteit, klacht)
    VALUES (:gebruiker, :klachtsoort, NOW(), 1, :klacht)";

    $arr = array("gebruiker" => $id, "klachtsoort" => $klachtsoort, "klacht" => $klacht);

    $ret = db_statement($sql, $arr);

    var_dump($ret);
  }

  header("Location: index.php");

?>
