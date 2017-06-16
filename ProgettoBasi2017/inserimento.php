<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './utilities.php';
require_once './queries.php';
//checkLogin();
class inserimento {

    public function getFormFilm() {

        echo '<form method="POST" action="./inserisci.php">';
        echo '<input type="hidden" name="itype" value="film" />';
        echo '  <div>
                <span>Titolo:<input type ="text" name="titolo"/></span><br>
                <span>Anno di Produzione:<input type ="text" name="anno"/></span>
                </div>

                <div>
                Trama:<textarea name="trama" cols="50" rows="5"></textarea> 
                </div>
                <div>
                Durata:<input type="text" name="durata"/>
                </div>
            ';
        
        echo '<div>';
        
        echo 'Registi (<a href="inserimento.php?info=persona">nuovo regista</a>)<br>';
        
        $db = utilities::connect();
        
        foreach ($db->query(queries::$get_registi) as $regista){
            echo '<div>';
            echo $regista['nome'].' '.$regista['cognome'];
            echo '<input type="checkbox" name="registi[]" value="'.$regista['idregista'].'"/>';
            echo '</div>';
        }
        
        
        echo '</div>';
        
        echo '<div>';
        
        echo 'Attori (<a href="inserimento.php?info=persona">nuovo attore</a>)<br>';
        
        foreach ($db->query(queries::$get_attori) as $attore){
            echo '<div>';
            echo $attore['nome'].' '.$attore['cognome'];
            echo '<input type="checkbox" name="attori[]" value="'.$attore['idattore'].'"/>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '<div>';
        
        echo 'Case Cinematografiche (<a href="inserimento.php?info=casacinem">nuova casa cinematografica</a>)<br>';
        
        foreach ($db->query(queries::$get_case_cinematografiche) as $casa){
            echo '<div>';
            echo $casa['nome'];
            echo '<input type="checkbox" name="attori[]" value="'.$casa['idcasa'].'"/>';
            echo '</div>';
        }
        
        echo '</div>';
        
        echo '<input type="submit" value="Aggiungi" name="insertfilm"/>';
        echo '</form>';
    }

    public function getFormAttore() {
        echo '<form method="POST" action="./inserisci.php">
                        <div>Nome:<input type ="text" name = "nome"/></div>
                        <div>Cognome:<input type ="text" name = "cognome"/></div>
                        <div>Luogo nascita:<input type ="text" name = "luogo"/></div>
                        <div>Data nascita:<input type ="date" name = "datanascita"/></div>
                        <div>Attore <input type="radio" name="tipopersona" value="attore"/></div>
                        <div>Regista  <input type="radio" name="tipopersona" value="regista"/></div>
                        <input type="submit" value="Inserisci la persona" name="insertpersona"/>
                                                <input type="hidden" name="itype" value="persona" />

                    </form>';
    }

    public function getFormCasaCinematografica() {
        echo '<form method="POST" action="./inserisci.php">
                        <div>Nome casa:<input type ="text" name = "nome"/></div>
                        <div>Luogo sede:<input type ="text" name = "luogo"/></div>
                        <div>Data fondazione:<input type ="text" name = "datafondazione"/></div>
                        <input type="submit" value="Inserisci la casa cinematografica" name="insertcc"/>
                                                <input type="hidden" name="itype" value="casacine" />

                    </form>';
    }
}

$page = new inserimento();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserimento dati</title>
        <?php
        utilities::requirements();
        ?>
    </head>
    <body>
        <?php
        utilities::defaultNavBar();
        //Gestione errori di inserimento
        utilities::checkLogin();
        if ($_GET['errore'] == 'filminserito') {
            echo "<p><font color=red>Film già presente!</font></p>";
        } else
        if ($_GET['errore'] == 'registainserito') {
            echo "<p><font color=red>Regista/attore già inserito!</font></p>";
        } else
        if ($_GET['errore'] == 'casainserita') {
            echo "<p><font color=red>Casa cinematografica già inserita!</font></p>";
        }
        if ($_GET['errore'] == 'insert') {
            echo "<p><font color=red>Errore di inserimento generico!</font></p>";
        }
        if ($_GET['errore'] == 'insertcasa') {
            echo "<p><font color=red>Errore di inserimento casa cinematografica!</font></p>";
        }
        //Richiamo i form di inserimento
        if ($_GET['info'] == 'film') {
            echo "<p><font color=red>Inserisci i dati del Film</font></p>";
            $page->getFormFilm();
        }
        if ($_GET['info'] == 'persona') {
            echo "<p><font color=red>Inserisci i dati dell'attore/regista</font></p>";
            $page->getFormAttore();
        }
        if ($_GET['info'] == 'casacinem') {
            echo "<p><font color=red>Inserisci i dati della casa cinematografica</font></p>";
            $page->getFormCasaCinematografica();
        }
        if ($_GET['info'] == 'casainserita') {
            echo "<p><font color=red>Casa cinematografica inserita.</font></p>";
            $page->getFormCasaCinematografica();
        }
        ?>
    </body>
</html>