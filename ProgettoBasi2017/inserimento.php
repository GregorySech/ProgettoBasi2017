<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require 'utilities.php';
    //checkLogin();?>
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inserimento dati</title>
    </head>
    <body>
        <?php  
        if ($_GET['info'] == 'film') {
            echo "<p><font color=red>Sto inserendo un film!</font></p>";
        } 
        else
            if ($_GET['info'] == 'persona') {
                echo "<p><font color=red>Sto inserendo una persona!</font>i</p>";
            }
            else
                if ($_GET['info'] == 'casacinem') {
                    echo "<p><font color=red>Sto inserendo una casa cinematografica!</font>i</p>";
                }
        ?>
    </body>
</html>