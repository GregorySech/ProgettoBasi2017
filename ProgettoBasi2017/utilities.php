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
        if (empty($_SESSION['userID'])) {
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

}
