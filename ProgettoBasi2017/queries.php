<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Classe contenente le query dell'applicazione.
 */
class queries {
    public static $count_nomignoli = 'select count(*) from progettodb.utenti where nomignolo = ?';
    public static $login = 'select * from progettodb.utenti where progettodb.utenti.nomignolo = ? and progettodb.utenti.psw = ?';
}
