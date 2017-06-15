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

    /**
      progettodb.new_film(
      t text,
      ap integer,
      tr text,
      d integer)
     */
    public static $new_film = 'select progettodb.new_film(?, ?, ?, ?)';

    public static $get_registi = 'select * from progettodb.personecinematografiche as p join progettodb.registi as r on r.idregista = p.idpersona';
    public static $get_attori = 'select * from progettodb.attori as a join progettodb.personecinematografiche as p on a.idattore = p.idpersona;';
    public static $get_case_cinematografiche = 'select * from progettodb.casecinematografiche';
    
    
}
