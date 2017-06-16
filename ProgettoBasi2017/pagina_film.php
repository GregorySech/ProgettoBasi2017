<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'utilities.php';
require 'queries.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserimento recensione del film</title>
        <?php
        utilities::requirements();
        ?>
    </head>
    <body>
        <?php
        utilities::defaultNavBar();
        session_start();
        $db = utilities::connect();
        $idfilm = 1;
        $statement = $db->prepare(queries::$get_info_film);
        $statement -> execute(array($idfilm));
        
        foreach ($statement ->fetchAll() as $film){
            echo '<div>';
            echo '<p>Titolo: '.$film["titolo"].'</p><p>Anno produzione: '.$film["annoproduzione"].'</p><p>Trama: '.$film["trama"].'</p><p>Durata: '.$film["durata"].'</p><p>Punteggio recensioni: '.$film["punteggio"].'</p>';
            echo '</div>';
        }
        if (!empty($_SESSION['nome_utente'])) {
            echo    '<form method = "POST" action = "./pagina_film.php">
                    <div>Recensione del film</div>
                    <div>Inserisci la valutazione della recensione</div>
                    <div class="rating">
                        <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
                        <label for="star5">☆</label>
                        <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
                        <label for="star4">☆</label>
                        <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
                        <label for="star3">☆</label>
                        <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
                        <label for="star2">☆</label>
                        <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
                        <label for="star1">☆</label>
                        <div class="clear"></div>
                    </div>
                    <div>Inserisci il testo della recensione</div>
                    <input type = "textarea" name = "testorecensione"></input>
                    <div><input type = "submit" value = "Inserisci recensione" name = "inserisci"/></div>
                </form>';
        }
        //Stampe di tutte le recensioni presenti nel DB in base al film selezionato
        $statement = $db->prepare(queries::$get_recensioni_film);
        $statement -> execute(array($idfilm));
        
        foreach ($statement ->fetchAll() as $recensioni){
            echo '<div>';
            echo '<p>Nomignolo recensore: '.$recensioni["nomignolo"].'</p><p>Data recensione: '.$recensioni["datarecensione"].'</p><p>Voto: '.$recensioni["voto"].'</p><p>Testo: '.$recensioni["testo"].'</p>';
            echo '</div>';
        }
        ?>
    </body>
</html>
