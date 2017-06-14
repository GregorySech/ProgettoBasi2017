<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
class index {

    public function getReservedAreaForm() {
        echo    '<form method="POST" action="./registra.php">
                    <span>Nomignolo:<input type ="text"/></span>
                    <span>Password:<input type ="password"/></span>
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
        echo 'Bentornato ' & $_SESSION['nome_utente'];
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
        if (empty($_SESSION['nome_utente'])) {
            $page->getNavBarNoSession();
          }
        else{
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
        <div class="container">SWAG</div>
    </body>
</html>
