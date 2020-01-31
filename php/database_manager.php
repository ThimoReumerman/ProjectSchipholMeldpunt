<?php
  function db_statement($sql, $arr) {
    //Set database variables
    $dbhost = "localhost";
    $dbname = "schiphol";
    $user = "root";
    $pass = "";

    try {
      //Connect to database
      $database = new PDO("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
      $database -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

      //SQL statement
      $stmt = $database -> prepare($sql);
      if($arr == null) {
        try {
          $stmt -> execute();
        } catch (PDOException $e) {
          echo "<script>alert('$e')</script>";
        }

      } else {
        try {
          $stmt -> execute($arr);
          echo "Executed.";
        } catch (PDOException $e) {
          echo "<script>alert('$e')</script>";
        }
      }

      $posts = $stmt -> fetchAll();

      //Disconnect from database
      $database = null;

      //Return the result from the SQL statement
      return $posts;
    } catch (PDOException $e) {
          return null;
    }
  }
?>
