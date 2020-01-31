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


      <div class="float" id="summary">
        <h3>Welkom</h3>
        <p>We doen elke dag ons uiterste best om van u een tevreden omwondende te maken. Heeft u onverhoopt toch een klacht over geluidsoverlast, milieuoverlast of veiligheid? Dan kunt u ons meldpunt gebruiken om uw klacht te melden.</p>
      </div>

      <div class="float" id="summary">
        <h3>Geldige postcodes</h3>
        <p>Hieronder vindt u de lijst van geldige postcodes om een klacht in te dienen.</p>

        <?php
          //SQL statement
          $sql = "SELECT postcode FROM postcode";

          //Get posts
          $posts = db_statement($sql, null);

          //Create list of valid ZIP-codes
          echo "<ul>";
          foreach ($posts as $post) {
            echo "<li>";
            foreach ($post as $tab) {
              echo $tab;
            }
            echo "</li>";
          }
          echo "</ul>";
         ?>

      </div>

      <div class="float" id="contact">
        <h3>Contact</h3>

        <div id="portions">
          <div class="portion">
            <h5>Adres</h5>
            <p>
              Amsterdam Airport Schiphol
              <br />Postbus 7501
              <br />1118 ZG Schiphol
            </p>
          </div>

          <div class="portion">
            <h5>Sociale media</h5>
            <p>
              <ul>
                <li><a href="https://twitter.com/Schiphol">Twitter</a></li>
                <li><a href="https://facebook.com/Schiphol">Facebook</a></li>
                <li><a href="https://instagram.com/Schiphol">Instagram</a></li>
                <li><a href="https://youtube.com/Schiphol">YouTube</a></li>
              </ul>
            </p>
          </div>
        </div>


      </div>
    </div>

  </body>
</html>
