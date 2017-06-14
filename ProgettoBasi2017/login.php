<?php

require "utilities.php";
require 'queries.php';
// se c'e' almeno un campo vuoto, si ritorna subito all'index.php
if (empty($_POST['username']) || empty($_POST['password'])) {
    header('Location:index.php?errore=mancainput');
} else {
    try {
        // si controlla la validita' delle credenziali con la funzione definita nel database
        $dbconn = utilities::connect();
        $statement = $dbconn->prepare(queries::$login);
        $statement->execute(array($_POST['username'], $_POST['password']));
        $rec = $statement->fetch();
        // il risultato di creadenziali_valiede e' un booleano postgres, che corrisponde ad 
        // un booleano php
        if ($rec[0] == 1) {
            // si crea una nuova sessione
            session_start();   
            $_SESSION['nome_utente'] = $_POST['username']; // si inserisce il nome utente
            header('Location:index.php');
        } else {
            header('Location:index.php?errore=invalide');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
