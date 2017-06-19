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
        if ($_GET['errore'] == 'mancainput') {
            echo "<p><font color=red>I campi obbligatori sono nomignolo, password e email!</font></p>";
        }
        if ($_GET['errore'] == 'erroreinput') {
            echo "<p><font color=red>Errore input nel form.</font></p>";
        }
        ?>
        <form method="POST" action="./checkregistrazione.php">
            <table>
                <tr>
                    <td>
                        Inserisci il Nomignolo:
                    </td>
                    <td>
                        <input type ="text" name="nomignolo"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Inserisci la password:
                    </td>
                    <td>
                        <input type ="text" name="password"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Inserisci il nome:
                    </td>
                    <td>
                        <input type ="text" name="nome"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Inserisci il cognome:
                    </td>
                    <td>
                        <input type ="text" name="cognome"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Inserisci la email:
                    </td>
                    <td>
                        <input type ="text" name="email"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Inserisci la data di nascita (AAAA-MM-GG):
                    </td>
                    <td>
                        <input type ="text" name="data"/>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Registrati"/>
        </form>
    </body>
</html>
