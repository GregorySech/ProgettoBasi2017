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
        $idfilm = $_GET['idfilm'];
        $statement = $db->prepare(queries::$get_info_film);
        $statement -> execute(array($idfilm));
        //Gestione errore
        switch($_GET['errore']){
            case 'recensioneesistente':
                echo "<p><font color=red>Hai già recensito questo film!</font></p>";
                break;
            case 'erroregenerico':
                echo "<p><font color=red>Errore di inserimento.</font></p>";
                break;
            case 'datimancanti':
                echo "<p><font color=red>Devi inserire tutti i dati</font></p>";
                break;
        }
        
        switch($_GET['info']){
            case 'ok':
                echo "<p><font color=red>Recensione aggiunta correttamente.</font></p>";
                break;
        }
        
        //Stampa delle informazioni del film
        foreach ($statement ->fetchAll() as $film){
            echo '<div>';
            echo '<p>Titolo: '.$film["titolo"].'</p><p>Anno produzione: '.$film["annoproduzione"].'</p><p>Trama: '.$film["trama"].'</p><p>Durata: '.$film["durata"].'</p><p>Punteggio recensioni: '.$film["punteggio"].'</p>';
            echo '</div>';
        }
        //Stampa dei registi del film
        $statement = $db->prepare(queries::$get_registi_film);
        $statement -> execute(array($idfilm));
        foreach ($statement ->fetchAll() as $registi){
            echo '<div>';
            echo '<p>Regista: '.$registi["nome"].' '.$registi["cognome"].'</p>';
            echo '</div>';
        }
        //Stampa degli attori del film
        $statement = $db->prepare(queries::$get_attori_film);
        $statement -> execute(array($idfilm));
        foreach ($statement ->fetchAll() as $attori){
            echo '<div>';
            echo '<p>Attore: '.$attori["nome"].' '.$attori["cognome"].'</p>';
            echo '</div>';
        }
        //Stampa della casa cinematografica del film
        $statement = $db->prepare(queries::$get_casecinematografiche_film);
        $statement -> execute(array($idfilm));
        foreach ($statement ->fetchAll() as $casecinematografiche){
            echo '<div>';
            echo '<p>Casa cinematografica: '.$casecinematografiche["nome"].'</p>';
            echo '</div>';
        }
        //Stampa del form di inserimento della recensione se loggato
        if (!empty($_SESSION['nome_utente'])) {
            echo '<hr>';
            echo    '<form method = "POST" action = "./inserisci.php">
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
                    <textarea rows="4" cols="50" name="testorecensione"></textarea>
                    <div><input type = "submit" value = "Inserisci recensione" name = "inserisci"/></div>
                    <input type="hidden" name="idfilm" value="'.$idfilm.'" />
                    <input type="hidden" name="itype" value="recensione" />
                </form>';
        }
        //Stampe di tutte le recensioni presenti nel DB in base al film selezionato
        $statement = $db->prepare(queries::$get_recensioni_film);
        $statement -> execute(array($idfilm));
        
        foreach ($statement ->fetchAll() as $recensioni){
            echo '<hr>';
            echo '<div>';
            echo '<p>Nomignolo recensore: <a href="pagina_utente.php?nomignolo='.$recensioni["nomignolo"].'">'.$recensioni["nomignolo"].'</a></p><p>Data recensione: '.$recensioni["datarecensione"].'</p><p>Voto: '.$recensioni["voto"].'</p><p>Testo: '.$recensioni["testo"].'</p>';
            echo '</div>';
        }
        ?>
    </body>
</html>
