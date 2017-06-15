<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './utilities.php';

class index {

    public function getReservedAreaForm() {
        echo '<form method="POST" action="./login.php">
                    <span>Nomignolo:<input type ="text" name="username"/></span>
                    <span>Password:<input type ="password" name="password"/></span>
                    <input type="submit" value="Login"/>
                    <a href="./registra.php">Registrati</a>
                </form>';
    }

    public function getNavBarNoSession() {
        echo '<div class="navbar"><h1>Cineforum</h1>';
        $this->getReservedAreaForm();
        echo '</div>';
    }

    public function getNavBarSession() {
        echo '<div class="navbar"><h1>Cineforum</h1>';
        echo 'Bentornato ' . $_SESSION['nome_utente'];
        echo '<div>Inserisci un: </div>';
        echo '<ol>';
        echo '<li><a href="inserimento.php?info=film">Film</a></li>';
        echo '<li><a href="inserimento.php?info=persona">Attore/Registra</a></li>';
        echo '<li><a href="inserimento.php?info=casacinem">Casa cinematografica</a></li>';
        echo '</ol>';
        echo '</div>';
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
        <title>Cineforum</title>
        <?php
        $page->requirements()
        ?>
    </head>
    <body>
        <?php
        if ($_GET['errore'] == 'mancainput') {
            echo "<p><font color=red>Mancano dei dati di input!</font></p>";
        } else
        if ($_GET['errore'] == 'invalide') {
            echo "<p><font color=red>Credenziali errate!</font></p>";
        }

        session_start();
        if (empty($_SESSION['nome_utente'])) {
            $page->getNavBarNoSession();
        } else {
            $page->getNavBarSession();
        }
        ?>
        <p><a href="film.php">Visualizza i film presenti</a></p>
        <form action="ricerca.php" method="post">
            <p>Scrivi la parola che deve essere ricercata nelle domande:</p> 
            <input type="text" name="parola">
            <p>
                <input type="submit" value="Cerca">
            </p>
        </form>
        <div class="container">
            <?php ?>
        </div>
    </body>
</html>
