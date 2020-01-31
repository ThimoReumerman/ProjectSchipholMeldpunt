<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Schiphol Meldpunt</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>

  <?php include_once("database_manager.php") ?>
  <body>
    <div id="main">
      <header>
        <div>Schiphol Meldpunt</div>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="invoeren.php">Klacht invoeren</a></li>
            <li><a href="klachten.php">Overzicht</a></li>
          </ul>
        </nav>
      </header>

      <div class="float" id="complaint">
        <h3>Klachten</h3>
        <p>Hieronder kunt u de bestaande klachten vinden</p>
      </div>

      <?php
          //SQL statement
          $sql = "SELECT klacht.id, gebruiker.postcode, CONVERT(klacht.datum, DATE), CONVERT(klacht.datum, TIME), klachtsoort.klachtsoort, klacht.klacht
          FROM klacht
          INNER JOIN klachtsoort
          ON klacht.ID_klachtsoort = klachtsoort.id
          INNER JOIN gebruiker
          ON klacht.ID_gebruiker = gebruiker.ID
          WHERE klacht.prioriteit != 0
          ORDER BY klacht.prioriteit";

          //Get posts
          $posts = db_statement($sql, null);

          //Create table
          echo "<div class='float'><table>";
          echo "<th>Nummer</th><th>Postcode</th><th>Datum</th><th>Tijd</th><th>Soort</th><th>Klacht</th>";
          foreach ($posts as $post) {
            echo "<tr>";
            foreach ($post as $tab) {
              echo "<td>$tab</td>";
            }
            echo "</tr>";
          }
          echo "</table></div>";
       ?>

    </div>
  </body>
</html>
