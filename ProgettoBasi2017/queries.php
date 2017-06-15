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
    public static $login = 'select progettodb.login(?,?)';
    /**
    progettodb.new_user(
    nomignolo text,
    password text,
    email text,
    data_nascita date,
    nome text,
    cognome text)
     */
    public static $register = 'select progettodb.new_user(?, ?, ?, ?, ?, ?)';
}
