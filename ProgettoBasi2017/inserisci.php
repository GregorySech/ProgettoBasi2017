<?php

require_once './utilities.php';
require_once './queries.php';
utilities::checkLogin();

if (!empty($_POST['itype'])) {
    switch ($_POST['itype']) {
        case 'film':
            if (empty($_POST['titolo']) || empty($_POST['trama']) || empty($_POST['durata']))
                header('Location:inserimento.php?errore=insert&info=film');
            else {
                $db = utilities::connect();
                $statement = $db->prepare(queries::$new_film);

                $titolo = $_POST['titolo'];
                $trama = $_POST['trama'];
                $attori = '{}';
                $registi = '{}';
                $case = '{}';

                $durata = NULL;
                if (!empty($_POST['durata']) && is_numeric($_POST['durata']))
                    $durata = $_POST['durata'];

                $anno = NULL;
                if (!empty($_POST['anno']) && is_numeric($_POST['anno']))
                    $anno = $_POST['anno'];

                if (isset($_POST['attori'])) {
                    $attorip = $_POST['attori'];
                    $attori = '{' . implode(',', $attorip) . '}';
                }

                if (isset($_POST['registi'])) {
                    $registip = $_POST['registi'];
                    $registi = '{' . implode(',', $registip) . '}';
                }

                if (isset($_POST['case'])) {
                    $casep = $_POST['case'];
                    $case = '{' . implode(',', $casep) . '}';
                }

                try {
                    $statement->execute(array($titolo, $anno, $trama, $durata, $attori, $registi, $case));
                    header('Location:inserimento.php?info=filminserito');
                } catch (PDOException $pdoe) {
                    echo 'PDO EXCEPTION';
                }
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

                echo 'Ora provo ad inserire\n';
                echo "{nome: $nome, luogo: $luogo, data: $data}";


                try {
                    $statement->execute(array($nome, $luogo, $data));
                    header('Location:inserimento.php?info=casainserita');
                } catch (Exception $ex) {
                    echo $ex->getTraceAsString();
                    header('Location:inserimento.php?errore=insertcasa&info=casacinem');
                }
            }
            break;
        case 'recensione':
            if (empty($_POST['star']) || empty($_POST['testorecensione'])) {
                header('Location:pagina_film.php?idfilm=' . $idfilm . '&errore=datimancanti');
            } else {
                $db = utilities::connect();
                $ratings = $_POST['star'];
                $testo = $_POST['testorecensione'];
                $idfilm = $_POST['idfilm'];

                $statement = $db->prepare(queries::$new_recensione);
                try {
                    $statement->execute(array($_SESSION['nome_utente'], $idfilm, $ratings, $testo));
                    header('Location:pagina_film.php?idfilm=' . $idfilm . '&info=ok');
                } catch (PDOException $ex) {
                    header('Location:pagina_film.php?idfilm=' . $idfilm . '&errore=recensioneesistente');
                } catch (Exception $ex) {
                    header('Location:pagina_film.php?idfilm=' . $idfilm . '&errore=erroregenerico');
                }
            }
            break;
        case 'persona':
            if (empty($_POST['nome']) || empty($_POST['cognome'])) {
                echo 'casino zio';
            } else {
                $db = utilities::connect();

                $nome = $_POST['nome'];
                $cognome = $_POST['cognome'];
                $luogo = NULL;
                $datanascita = NULL;
                $attore = 'false';
                $regista = 'false';

                if (!empty($_POST['luogo']))
                    $luogo = $_POST['luogo'];

                if (!empty($_POST['datanascita']))
                    $datanascita = $_POST['datanascita'];

                if (!empty($_POST['isattore'])) {
                    $attore = 'true';
                }

                if (!empty($_POST['isregista'])) {
                    $regista = 'true';
                }
                if ($attore == 'true' || $regista == 'true') {
                    $statement = $db->prepare(queries::$new_persona);

                    try {
                        $statement->execute(array(':name' => $nome, ':surname' => $cognome, ':birthplace' => $luogo, ':birthday' => $datanascita, ':actor' => $attore, ':director' => $regista));
                        header('Location:inserimento.php?info=personainserita');
                    } catch (PDOException $pdoe) {
                        header('Location:inserimento.php?errore=pdo&itype=persona');
                    } catch (Exception $e) {
                        header('Location:inserimento.php?errore=insert&itype=persona');
                    }
                } else {
                    header('Location:inserimento.php?errore=nattorenregista&itype=persona');
                }
            }
            break;
        default : header('Location:inserimento.php?errore=insert');
            break;
    }
}



