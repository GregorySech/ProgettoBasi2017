<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './utilities.php';
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
        <p><a href="film.php">Visualizza i film presenti</a></p>
        <form action="ricerca.php" method="post">
            <p>Scrivi la parola che deve essere ricercata nelle domande:</p> 
            <input type="text" name="parola">
            <p>
                <input type="submit" value="Cerca">
            </p>
        </form>
        <div class="container">
            <?php ?>
        </div>
    </body>
</html>