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

        $idutente = $_GET['nome_utente'];

        $statement = $db->prepare(queries::$get_info_utente);
        $statement->execute(array($idutente));
        $result = $statement->fetch();
        echo '<div>';
        echo '<p>Nomignolo: ' . $idutente["nomignolo"] . '</p><p>Nome: ' . $idutente["nome"] . '</p><p>Cognome: ' . $idutente["cognome"] . '</p><p>email: ' . $idutente["email"] . '</p><p>Data di nascita: ' . $idutente["datanascita"] . '</p>';
        echo '</div>';

        $statement = $db->prepare(queries::$get_film_utente);
        $statement->execute(array($idutente));
        foreach ($statement->fetchAll() as $film) {
            utilities::filmPreviewReduced($film["titolo"], $film["annoproduzione"], $film["voto"], $film["idfilm"]);
        }
        ?>
    </body>
</html>