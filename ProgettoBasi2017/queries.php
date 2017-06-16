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
    /**
      progettodb.progettodb.new_casacinem(n text, ap text, tr date)
     */
    public static $new_casacinem = 'select * progettodb.new_casacinem(?,?,?)';
    
    //Query per prendere i dati dal DB
    public static $get_info_film = 'select * from progettodb.film as f where f.idfilm = ?';
    public static $get_registi = 'select * from progettodb.personecinematografiche as p join progettodb.registi as r on r.idregista = p.idpersona';
    public static $get_attori = 'select * from progettodb.attori as a join progettodb.personecinematografiche as p on a.idattore = p.idpersona;';
    public static $get_case_cinematografiche = 'select * from progettodb.casecinematografiche';
    public static $get_recensioni_film = 'select u.nomignolo r.datarecensione r.voto r.testo from progettodb.recensioni as r join progettodb.utenti as u join progettodb.film as f on u.idutente = r.idutente and f.idfilm = r.idfilm where f.idfilm = ? order by r.datarecensione desc';
    
}
