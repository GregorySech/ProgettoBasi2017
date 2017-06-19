<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './utilities.php';
require_once './queries.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cineforum</title>
        <?php
        utilities::requirements();
        ?>
    </head>
    <body>
        <?php
        if ($_GET['errore'] == 'mancainput') {
            echo "<p><font color=red>Mancano dei dati di input!</font></p>";
        } else
        if ($_GET['errore'] == 'invalide') {
            echo "<p><font color=red>Credenziali errate!</font></p>";
        }

        session_start();
        if (empty($_SESSION['nome_utente'])) {
            utilities::getNavBarNoSession();
            utilities::getReservedAreaForm();
        } else {
            utilities::getNavBarSession();
        }
        ?>

        <form action="ricerca.php" method="POST">
            <p>Titolo del film da cercare:</p> 
            <input type="text" name="parolacercata">
            <p>
                <input type="submit" value="Cerca">
            </p>
        </form>

        <form action="index.php" method="POST">
            <input type="submit" value="Ordina per nome" name="ordinanome">
            <input type="submit" value="Ordina per giudizio" name ="ordinagiudizio">
        </form>
        <div class="container">
            <div>Lista Film:</div>
            <?php
            $delta = 5;
            $rows = 0;
            $cols = 0;

            $db = utilities::connect();

            $index = 1;

            if (!isset($_POST["ordinanome"]) && !isset($_POST["ordinagiudizio"])) {
                foreach ($db->query(queries::$get_films) as $film) {
                    echo '<div> ';
                    utilities::filmPreview($film['titolo'], $film['annoproduzione'], $film['idfilm'], $film['punteggio'], $index);
                    echo '</div>';
                    $index++;
                }
            }

            if (isset($_POST["ordinanome"])) {
                foreach ($db->query(queries::$get_films_name) as $film) {
                    echo '<div> ';
                    utilities::filmPreview($film['titolo'], $film['annoproduzione'], $film['idfilm'], $film['punteggio'], $index);
                    echo '</div>';
                    $index++;
                }
            } else if (isset($_POST["ordinagiudizio"])) {
                foreach ($db->query(queries::$get_films) as $film) {
                    echo '<div> ';
                    utilities::filmPreview($film['titolo'], $film['annoproduzione'], $film['idfilm'], $film['punteggio'], $index);
                    echo '</div>';
                    $index++;
                }
            }
            ?>
        </div>
    </body>
</html>