<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Schiphol Meldpunt</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <meta http-equiv="content-type" content="text/html" charset="utf-8"/>
  </head>

  <?php
  include_once("database_manager.php");

  ?>

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
        <h3>Klacht indienen</h3>
        <form action="aanmaken.php" method="post" enctype="multipart/form-data">
          Naam<br />
          <input required type="text" name="naam" placeholder="Naam"/><br />
          Postcode<br />
          <select required name="postcode">
            <option value="1098LV">1098LV</option>
            <option value="1098XX">1098XX</option>
            <option value="1098LX">1098LX</option>
            <option value="1099TT">1099TT</option>
            <option value="1999BB">1099BB</option>
            <option value="2000AA">2000AA</option>
          </select><br />
          E-mail<br />
          <input required type="email" name="email" placeholder="E-mail"/><br />
          Geboortedatum<br />
          <input required type="date" name="geboortedatum"/><br />
          Klachtsoort<br />
          <input required type="radio" name="klachtsoort" value="0" />Geluid<br />
          <input required type="radio" name="klachtsoort" value="1" />Milieu<br />
          <input required type="radio" name="klachtsoort" value="2" />Veiligheid<br />
          Klacht<br />
          <textarea required name="klacht" rows="4" cols="50"></textarea><br />
          <input type="submit" name="submit" value="Verzenden"/>

        </form>
      </div>
    </div>


  </body>
</html>
