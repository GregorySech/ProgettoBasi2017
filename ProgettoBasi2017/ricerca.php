<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include 'utilities.php';
include 'queries.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ricerca</title>
        <?php
        utilities::requirements();
        ?>
    </head>
    <body>
        <?php
        utilities::defaultNavBar();

        try {
            $db = utilities::connect();
            $stringacercata = $_POST['parolacercata'];
            if ($stringacercata == "") {
                echo '<p>Non è stata immessa alcuna stringa di ricerca</p>';
            } else {
                $statement = $db->prepare(queries::$get_result_search);
                $statement->execute(array($stringacercata));
                echo '<p>Risultati per ' . $stringacercata . '</p>';
                foreach ($statement->fetchAll() as $parolacercata) {
                    utilities::filmPreviewReduced($parolacercata['titolo'], $parolacercata['annoproduzione'], $parolacercata['punteggio'], $parolacercata['idfilm']);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        ?>
    </body>
</html>
