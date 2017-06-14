<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require 'utilities.php';
    require 'queries.php';
    //Controllo che siano presenti tutti i campi obbligatori
    if (empty($_POST['nomignolo']) || empty($_POST['password']) || empty($_POST['email'])) {
    header('Location:registra.php?errore=mancainput');
} else {
    try {
        $dbconn = utilities::connect();
        // Controllo se è già presente un utente con quel nome
        $statement = $dbconn->prepare(queries::$count_nomignoli);
        $statement->execute(array($_POST['nomignolo']));
        $rec = $statement->fetch();
        if ($rec[0] == 1) {
            //Utente già registrato
            header('Location:registra.php?errore=registrato');
        } else {
            session_start();
            $_SESSION['nome_utente'] = $_POST['nomignolo'];
            //Creo utente nel DB
            $stat = $dbconn->prepare('select nuovo_utente(?,?)');
            $stat->execute(array($_POST['nomignolo'], $_POST['password']));
            // si ridirige l'utente alla pagina centrale del sito.
            header('Location:index.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}