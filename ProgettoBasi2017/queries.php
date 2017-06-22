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
      d integer,
      attori integer[],
      registi integer[],
      casecinem integer[])
     */
    public static $new_film = 'select progettodb.new_film(?, ?, ?, ?, ?, ?, ?)';

    /**
      progettodb.progettodb.new_casacinem(n text, ap text, tr date)
     */
    public static $new_casacinem = 'select progettodb.new_casacinem(?,?,?)';
    /* progettodb.new_recensione(
      nomignolo text,
      idf integer,
      score integer,
      com text) */
    public static $new_recensione = 'select progettodb.new_recensione(?,?,?,?)';
    /*
     * progettodb.new_person(
      n text,
      cn text,
      bp text,
      bd date,
      actor boolean,
      director boolean)
     */
    public static $new_persona = 'select progettodb.new_person(:name,:surname,:birthplace,:birthday,:actor,:director)';
    //Query per prendere i dati dal DB
    public static $get_info_film = "select * 
            from progettodb.film as f 
            where f.idfilm = ?";
    public static $get_registi = "select * 
            from progettodb.personecinematografiche as p join progettodb.registi as r 
            on r.idregista = p.idpersona";
    public static $get_attori = "select *
            from progettodb.attori as a join progettodb.personecinematografiche as p 
            on a.idattore = p.idpersona";
    public static $get_case_cinematografiche = "select *
            from progettodb.casecinematografiche";
    public static $get_recensioni_film = "select u.nomignolo, r.datarecensione, r.voto, r.testo 
            from progettodb.recensioni as r, progettodb.utenti as u, progettodb.film as f 
            where u.idutente = r.idutente and f.idfilm = r.idfilm and f.idfilm = ? 
            order by r.datarecensione desc";
    public static $get_films = "select f.titolo, f.annoproduzione, f.idfilm, f.punteggio 
            from progettodb.film as f 
            order by f.punteggio desc";
    public static $get_films_name = "select f.titolo, f.annoproduzione, f.idfilm, f.punteggio
            from progettodb.film as f 
            order by f.titolo asc";
    public static $get_info_utente = "select *
            from progettodb.utenti
            where nomignolo = ?";
    public static $get_film_utente = "select f.idfilm,f.titolo,f.annoproduzione,r.voto,r.testo
            from progettodb.film as f join progettodb.recensioni as r 
            on f.idfilm = r.idfilm 
            where r.idutente = ?";
    public static $get_registi_film = "select pc.nome, pc.cognome 
            from progettodb.direzioni as d, progettodb.personecinematografiche as pc 
            where d.film = ? and d.regista = pc.idpersona";
    public static $get_attori_film = "select pc.nome, pc.cognome 
            from progettodb.recitazioni as c, progettodb.personecinematografiche as pc 
            where c.film = ? and c.attore = pc.idpersona";
    public static $get_casecinematografiche_film = "select cc.nome
            from progettodb.produzioni as p, progettodb.casecinematografiche as cc 
            where p.film = ? and p.casacinematografica = cc.idcasa";
    public static $get_result_search = "select * 
            from progettodb.film as f 
            where f.titolo ilike '%'||?||'%' 
            order by f.titolo";

}
