<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require 'utilities.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrazione nuovo utente</title>
        <?php
        utilities::requirements();
        ?>
    </head>
    <body>
        <!-- Stampe di eventuali errori di login -->
        <?php
        utilities::defaultNavBar();
        if ($_GET['errore'] == 'registra') {
            echo "<p><font color=red>Utente già registrato!</font></p>";
        } 
        else
            if ($_GET['errore'] == 'mancainput') {
                echo "<p><font color=red>I campi obbligatori sono nomignolo, password e email!</font>i</p>";
            }
        ?>
        <form method="POST" action="./checkregistrazione.php">
            <div>Inserisci il Nomignolo:<input type ="text" name="nomignolo"/></div>
            <div>Inserisci la password:<input type ="text" name="password"/></div>
            <div>Inserisci il nome:<input type ="text" name="nome"/></div>
            <div>Inserisci il cognome:<input type ="text" name="cognome"/></div>
            <div>Inserisci la email:<input type ="text" name="email"/></div>
            <div>Inserisci la data di nascita:<input type ="text" name="data"/></div>
            <input type="submit" value="Registrati"/>
        </form>
    </body>
</html>
