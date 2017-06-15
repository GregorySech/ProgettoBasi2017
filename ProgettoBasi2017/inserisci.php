<?php

require_once './utilities.php';
require_once './queries.php';
utilities::checkLogin();

if(!empty($_POST['itype'])){
    switch ($_POST['itype']){
        case 'film': 
                if(empty($_POST['titolo']) || empty($_POST['trama']))
                    header('Location:index.php?errore=insert');
                else{
                    $db = utilities::connect();
                    $statement = $db->prepare(queries::$new_film);
                    
                    $titolo = $_POST['titolo'];
                    $trama = $_POST['trama'];
                    
                    $durata = NULL;
                    if(!empty($_POST['durata']) && is_numeric($_POST['durata']))
                        $durata = $_POST['durata'];
                    
                    $anno = NULL;
                    if(!empty($_POST['anno']) && is_numeric($_POST['anno']))
                        $durata = $_POST['anno'];
                    
                    $statement ->execute(array($titolo, $anno, $trama, $durata));
                }
            break;
        default : header('Location:index.php?errore=insert'); break;
    }
}

?>

