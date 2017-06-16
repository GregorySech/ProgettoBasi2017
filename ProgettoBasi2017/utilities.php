<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Libreria di utilities per semplificarsi la vita
 */
error_reporting(E_ALL & ~E_NOTICE);

class utilities {

    //Variabili per la connessione al DB
    public static $dbname = "a2016u125";
    public static $dbuser = "a2016u125";
    public static $dbpassword = "7DJ7LpV.";

    //Funzione per controllare se un utente è loggato o meno
    public static function checkLogin() {
        session_start();
        if (empty($_SESSION['nome_utente'])) {
            header('Location:index.php');
        }
    }

    //Funzione per connettersi al DB
    public static function getDBHost() {
        return 'pgsql:host=dblab.dsi.unive.it;port=5432;dbname=' . (self::$dbname);
    }

    public static function connect() {
        $dbconnection = new PDO(self::getDBHost(), self::$dbuser, self::$dbpassword);
        $dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbconnection;
    }
    
    public static function defaultNavBar(){
        session_start();
        echo    '<div class="navbar"><a href = "index.php"><h1>Cineforum</h1></a>';
        if (!empty($_SESSION['nome_utente'])) {
            echo    '<p><a href = "logout.php">Logout</a></p>';
        }
        echo    '</div>';
    }
    
    public static function getNavBarNoSession() {
        echo '<div class="navbar"><h1>Cineforum</h1>';
        echo '</div>';
    }
    
    public static function getReservedAreaForm() {
        echo '<form method="POST" action="./login.php">
                    <span>Nomignolo:<input type ="text" name="username"/></span>
                    <span>Password:<input type ="password" name="password"/></span>
                    <input type="submit" value="Login"/>
                    <a href="./registra.php">Registrati</a>
                </form>';
    }

    public static function getNavBarSession() {
        echo '<div class="navbar"><h1>Cineforum</h1>';
        echo 'Bentornato ' . $_SESSION['nome_utente'];
        echo '<div><a href = "logout.php">Logout</a></div>';
        echo '<div>Inserisci un: </div>';
        echo '<ol>';
        echo '<li><a href="inserimento.php?info=film">Film</a></li>';
        echo '<li><a href="inserimento.php?info=persona">Attore/Registra</a></li>';
        echo '<li><a href="inserimento.php?info=casacinem">Casa cinematografica</a></li>';
        echo '</ol>';
        echo '</div>';
    }
    
    //Requisiti della pagina, il css
    public static function requirements() {
        echo '<link href="./css/style.css" rel="stylesheet" type="text/css">';
    }
    
    public static function validateDate($date){
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    
    public static function filmPreview($titolo, $annoproduzione, $idfilm, $punteggio){
        echo "<a href='./pagina_film.php?idfilm=$idfilm'>";
        echo '<span>';
        echo "<div>$titolo ($annoproduzione) </div>";
        echo "<div>Rating: $punteggio </div>";
        echo '</span>';
        echo "</a>";
    }
}
