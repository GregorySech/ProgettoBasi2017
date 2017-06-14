<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require 'utilities.php';
    //checkLogin();
    class index {
        public function getFormFilm() {
            echo    '<form method="POST" action="./inserisci.php">
                        <span>Nomignolo:<input type ="text"/></span>
                        <span>Password:<input type ="password"/></span>
                        <input type="submit" value="Login"/>
                        <a href="./registra.php">Registrati</a>
                    </form>';
        }
        
        public function getFormAttore() {
            echo    '<form method="POST" action="./inserisci.php">
                        <div>Nome:<input type ="text" name = "nome"/></div>
                        <div>Cognome:<input type ="text" name = "cognome"/></div>
                        <div>Luogo nascita:<input type ="text" name = "luogo"/></div>
                        <div>Data nascita:<input type ="text" name = "datanascita"/></div>
                        <div>Attore <input type="radio" name="tipopersona" value="attore"/></div>
                        <div>Regista  <input type="radio" name="tipopersona" value="regista"/></div>
                        <input type="submit" value="Inserisci la persona"/>
                    </form>';
        }
        public function getFormCasaCinematografica() {
            echo    '<form method="POST" action="./inserisci.php">
                        <div>Nome casa:<input type ="text" name = "nome"/></div>
                        <div>Luogo sede:<input type ="text" name = "luogo"/></div>
                        <div>Data fondazione:<input type ="text" name = "datanascita"/></div>
                        <input type="submit" value="Inserisci la casa cinematografica"/>
                    </form>';
        }

        //Requisiti della pagina, il css
        public function requirements() {
            echo '<link href="./css/style.css" rel="stylesheet" type="text/css">';
        }
    }
    $page = new index();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserimento dati</title>
    </head>
    <body>
        <?php  
        //Gestione errori di inserimento
        if ($_GET['errore'] == 'filminserito') {
            echo "<p><font color=red>Film già presente!</font></p>";
            $page->getFormFilm();
        } 
        else
            if ($_GET['errore'] == 'registainserito') {
                echo "<p><font color=red>Regista/attore già inserito!</font></p>";
                $page->getFormAttore();
            }
            else
                if ($_GET['errore'] == 'casainserita') {
                    echo "<p><font color=red>Casa cinematografica già inserita!</font></p>";
                    $page->getFormCasaCinematografica();
                }
        //Richiamo i form di inserimento
        if ($_GET['info'] == 'film') {
            echo "<p><font color=red>Sto inserendo un film!</font></p>";
            $page->getFormFilm();
        } 
        else
            if ($_GET['info'] == 'persona') {
                echo "<p><font color=red>Sto inserendo una persona!</font></p>";
                $page->getFormAttore();
            }
            else
                if ($_GET['info'] == 'casacinem') {
                    echo "<p><font color=red>Sto inserendo una casa cinematografica!</font></p>";
                    $page->getFormCasaCinematografica();
                }
        ?>
    </body>
</html>