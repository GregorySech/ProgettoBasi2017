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
        echo '  
                <table>
                    <tr>
                        <td>
                            Titolo:
                        </td>
                        <td>
                            <input type ="text" name="titolo"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Anno di Produzione:
                        </td>
                        <td>
                            <input type ="text" name="anno"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Trama:
                        </td>
                        <td>
                            <textarea name="trama" cols="50" rows="5"></textarea> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Durata:
                        </td>
                        <td>
                            <input type="text" name="durata"/>
                        </td>
                    </tr>
            ';

        echo '<td colspan ="2"><hr></td>';


        echo '<tr>';
        echo '<td colspan = "2">Registi (<a href="inserimento.php?info=persona">nuovo regista</a>)</td>';
        echo '</tr>';
        $db = utilities::connect();

        foreach ($db->query(queries::$get_registi) as $regista) {
            echo '<tr>';
            echo '<td>' . $regista['nome'] . ' ' . $regista['cognome'] . '</td>';
            echo '<td><input type="checkbox" name="registi[]" value="' . $regista['idregista'] . '"/></td>';
            echo '</tr>';
        }



        echo '<td colspan ="2"><hr></td>';
        echo '<tr>';
        echo '<td colspan="2">Attori (<a href="inserimento.php?info=persona">nuovo attore</a>)</td>';
        echo '</tr>';
        foreach ($db->query(queries::$get_attori) as $attore) {
            echo '<tr>';
            echo '<td>' . $attore['nome'] . ' ' . $attore['cognome'] . '</td>';
            echo '<td><input type="checkbox" name="attori[]" value="' . $attore['idattore'] . '"/></td>';
            echo '</tr>';
        }

        echo '<td colspan ="2"><hr></td>';
        echo '<tr>';
        echo '<td colspan="2">Case Cinematografiche (<a href="inserimento.php?info=casacinem">nuova casa cinematografica</a>)</td>';
        echo '</tr>';
        foreach ($db->query(queries::$get_case_cinematografiche) as $casa) {
            echo '<tr>';
            echo "<td>" . $casa['nome'] . "</td>";
            echo '<td><input type="checkbox" name="case[]" value="' . $casa['idcasa'] . '"/></td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '<br>';
        echo '<input type="submit" value="Aggiungi" name="insertfilm"/>';
        echo '</form>';
    }

    public function getFormAttore() {
        echo '<form method="POST" action="./inserisci.php">
                <table>
                    <tr>
                        <td>
                            Nome:
                        </td>
                        <td>
                            <input type ="text" name = "nome"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cognome:
                        </td>
                        <td>
                            <input type ="text" name = "cognome"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Luogo nascita:
                        </td>
                        <td>
                            <input type ="text" name = "luogo"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Data nascita (AAAA-MM-GG):
                        </td>
                        <td>
                            <input type ="date" name = "datanascita"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Attore:
                        </td>
                        <td>
                            <input type="checkbox" name="isattore"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Regista:
                        </td>
                        <td>
                            <input type="checkbox" name="isregista"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Inserisci la persona" name="insertpersona"/>
                        </td>
                        <td>
                            <input type="hidden" name="itype" value="persona" />
                        </td>
                    </tr>
                </table>
            </form>';
    }

    public function getFormCasaCinematografica() {
        echo '<form method="POST" action="./inserisci.php">
                    <table>
                        <tr>
                            <td>
                                Nome casa:
                            </td>
                            <td>
                                <input type ="text" name = "nome"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Luogo sede:
                            </td>
                            <td>
                                <input type ="text" name = "luogo"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Data fondazione (AAAA-MM-GG):
                            </td>
                            <td>
                                <input type ="text" name = "datafondazione"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Inserisci la casa cinematografica" name="insertcc"/>
                            </td>
                            <td>
                                <input type="hidden" name="itype" value="casacine" />
                            </td>
                        </tr>
                    </table>
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
        switch ($_GET['errore']) {
            case 'filminserito':
                echo "<p><font color=red>Film già presente!</font></p>";
                break;
            case 'registainserito':
                echo "<p><font color=red>Regista/attore già inserito!</font></p>";
                break;
            case 'casainserita':
                echo "<p><font color=red>Casa cinematografica già inserita!</font></p>";
                break;
            case 'insert':
                echo "<p><font color=red>Errore di inserimento!</font></p>";
                break;
            case 'insertcasa':
                echo "<p><font color=red>Errore di inserimento casa cinematografica!</font></p>";
                break;
            case 'nattorenregista':
                echo "<p><font color=red>Una persona cinematografica deve essere perlomeno un attore o un regista!</font></p>";
                break;
            case 'pdo':
                echo "<p><font color=red>PDOException!</font></p>";
                break;
        }
        //Richiamo i form di inserimento
        switch ($_GET['info']) {
            case 'film':
                echo "<p><font color=red>Inserisci i dati del Film</font></p>";
                $page->getFormFilm();
                break;
            case 'persona':
                echo "<p><font color=red>Inserisci i dati della Persona Cinematografica</font></p>";
                $page->getFormAttore();
                break;
            case 'casacinem':
                echo "<p><font color=red>Inserisci i dati della casa cinematografica</font></p>";
                $page->getFormCasaCinematografica();
                break;
            case 'casainserita':
                echo "<p><font color=red>Casa cinematografica inserita.</font></p>";
                $page->getFormCasaCinematografica();
                break;
            case 'personainserita':
                echo "<p><font color=red>Persona cinematografica inserita.</font></p>";
                $page->getFormAttore();
                break;
            case 'filminserito':
                echo "<p><font color=red>Film inserito.</font></p>";
                $page->getFormFilm();
                break;
            default:

                break;
        }
        ?>
    </body>
</html>
