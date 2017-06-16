<?php

require_once './utilities.php';
require_once './queries.php';
utilities::checkLogin();

if(!empty($_POST['itype'])){
    switch ($_POST['itype']){
        case 'film': 
                if(empty($_POST['titolo']) || empty($_POST['trama']))
                    header('Location:inserimento.php?errore=insert');
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
        case 'casacine':
            if (empty($_POST['nome'])) {
                header('Location:inserimento.php?errore=insert&info=casacinem');
            } else {
                $db = utilities::connect();
                $statement = $db->prepare(queries::$new_casacinem);

                $nome = $_POST['nome'];
                $luogo = NULL;
                $data = NULL;
                if (!empty($_POST['luogo']))
                    $luogo = $_POST['luogo'];
                if (!empty($_POST['datafondazione']))
                    $data = $_POST['datafondazione'];
                try {
                    $statement->execute(array($nome, $luogo, $data));
                    header('Location:inserimento.php?info=casainserita');
                } catch (Exception $ex) {
                    header('Location:inserimento.php?errore=insertcasa&info=casacinem');
                }
            }
            break;
        case 'recensione':
            if (empty($_POST['star']) || empty($_POST['testorecensione'])) {
                header('Location:pagina_film.php?idfilm='.$idfilm.'&errore=datimancanti');
            } else {
                $db = utilities::connect();
                $ratings = $_POST['star'];
                $testo = $_POST['testorecensione'];
                $idfilm = $_POST['idfilm'];
                
                $statement = $db ->prepare(queries::$new_recensione);
                try{
                    $statement -> execute(array($_SESSION['nome_utente'],$idfilm,$ratings,$testo));
                    header('Location:pagina_film.php?idfilm='.$idfilm.'&info=ok');
                } catch (PDOException $ex) {
                    header('Location:pagina_film.php?idfilm='.$idfilm.'&errore=recensioneesistente');
                }
                catch (Exception $ex) {
                    header('Location:pagina_film.php?idfilm='.$idfilm.'&errore=erroregenerico');
                }
            }
            break;
        default : header('Location:inserimento.php?errore=insert'); break;
    }
}



