<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrazione nuovo utente</title>
    </head>
    <body>
        <!-- Stampe di eventuali errori di login -->
        <?php  if ($_GET['errore'] == 'registra') {
            echo "<p><font color=red>Utente già registrato!</font></p>";
          } elseif ($_GET['errore'] == 'mancainput') {
            echo "<p><font color=red>I campi obbligatori sono nomignolo, password e email!</font>i</p>";
          }
          ?>
        <form method="POST" action="./checkregistrazione.php">
            <span>Inserisci il Nomignolo:<input type ="text" name="nomignolo"/></span>
            <span>Inserisci la password:<input type ="text" name="password"/></span>
            <span>Inserisci il nome:<input type ="text" name="nome"/></span>
            <span>Inserisci il cognome:<input type ="text" name="cognome"/></span>
            <span>Inserisci la email:<input type ="text" name="email"/></span>
            <span>Inserisci la data di nascita:<input type ="text" name="data"/></span>
            <input type="submit" value="Registrati"/>
        </form>
    </body>
</html>
