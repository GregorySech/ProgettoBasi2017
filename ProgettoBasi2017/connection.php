<?php

/**
 * Classe contenente informazioni sulla connessione alla base di dati 
 * dell'applicazione
 *
 */
class connection {

    public static $dbname = "a2016u125";
    public static $dbuser = "a2016u125";
    public static $dbpassword = "7DJ7LpV.";

    public static function getDBHost() {
        return 'pgsql:host=dblab.dsi.unive.it;port=5432;dbname=' . (connection::$dbname);
    }

}
