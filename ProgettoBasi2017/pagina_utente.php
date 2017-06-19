<?php
require 'utilities.php';
require 'queries.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina utente</title>    
        <?php
        utilities::requirements();
        ?>
    </head>
    <body>
        <?php
        utilities::defaultNavBar();
        session_start();
        $db = utilities::connect();

        $nomignolo = $_GET['nomignolo'];

        $statement = $db->prepare(queries::$get_info_utente);
        $statement->execute(array($nomignolo));
        $result = $statement -> fetch();
        
        echo '<div>';
        echo '<p>Nomignolo: ' . $result["nomignolo"] . '</p><p>Nome: ' . $result["nome"] . '</p><p>Cognome: ' . $result["cognome"] . '</p><p>email: ' . $result["email"] . '</p><p>Data di nascita: ' . $result["datanascita"] . '</p>';
        echo '</div>';

        
        $statement = $db->prepare(queries::$get_film_utente);
        $statement->execute(array($result['idutente']));
        echo '<hr>';
        echo "<p>Film recensiti dall'utente:</p>";
        foreach ($statement->fetchAll() as $film) {
            utilities::filmPreviewReduced($film["titolo"], $film["annoproduzione"], $film["voto"], $film["idfilm"],$film["testo"]);
        }
        ?>
    </body>
</html>