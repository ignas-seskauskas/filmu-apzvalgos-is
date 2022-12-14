<?php
// require('../../settings.php');
?>

<?php
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//   $newChannelId = $GLOBALS['_channelController']->addChannel((object) $_POST);
//   $result = array('success' => 'success', 'payload' => ['createdId' => $newChannelId]);

//   echo json_encode($result);
//   header("Content-Type: application/json; charset=UTF-8");
//   header("Access-Control-Allow-Origin: *");  
//   die();
// } else {
//   $result = array('error' => 'Bad request method');
// }
// session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    var_dump($_POST);
    $fono_spalva = $_POST["fono_spalva"];
    $teksto_spalva = $_POST["teksto_spalva"];
    $antrastes_spalva = $_POST["antrastes_spalva"];
    $porastes_spalva = $_POST["porastes_spalva"];
    $pagrindine_spalva = $_POST["pagrindine_spalva"];
    $antraeile_spalva = $_POST["antraeile_spalva"];
    $pavadinimas = $_POST["pavadinimas"];
    $srifto_dydis = $_POST["srifto_dydis"];
    $sekmes_spalva = $_POST["sekmes_spalva"];
    $klaidos_spalva = $_POST["klaidos_spalva"];
    
    // Naudojamos dizaino temos id
    $id = $_stylesid;
    $id = 1;
    // $sql = "UPDATE dizaino_tema SET fono_spalva = '$fono_spalva', teksto_spalva = '$teksto_spalva', antrastes_spalva = '$antrastes_spalva', porastes_spalva = '$porastes_spalva', pagrindine_spalva = '$pagrindine_spalva', antraeile_spalva = '$antraeile_spalva', pavadinimas = '$pavadinimas', srifto_dydis = '$srifto_dydis', sekmes_spalva = '$sekmes_spalva', klaidos_spalva = '$klaidos_spalva' WHERE id_Dizaino_tema = '$id';";
    // databaseQuery($sql);
    $all_empty = true;
    $sql = "UPDATE dizaino_tema SET ";
    if (strlen($fono_spalva) != 0) {
        $sql = $sql . "fono_spalva = '$fono_spalva', ";
        $all_empty = false;
    }
    if (strlen($teksto_spalva) != 0) {
        $sql = $sql . "teksto_spalva = '$teksto_spalva', ";
        $all_empty = false;
    }
    if (strlen($antrastes_spalva) != 0) {
        $sql = $sql . "antrastes_spalva = '$antrastes_spalva', ";
        $all_empty = false;
    }
    if (strlen($porastes_spalva_spalva) != 0) {
        $sql = $sql . "porastes_spalva_spalva = '$porastes_spalva_spalva', ";
        $all_empty = false;
    }
    if (strlen($pagrindine_spalva_spalva) != 0) {
        $sql = $sql . "pagrindine_spalva_spalva = '$pagrindine_spalva_spalva', ";
        $all_empty = false;
    }
    if (strlen($antraeile_spalva) != 0) {
        $sql = $sql . "antraeile_spalva = '$antraeile_spalva', ";
        $all_empty = false;
    }
    if (strlen($pavadinimas) != 0) {
        $sql = $sql . "pavadinimas = '$pavadinimas', ";
        $all_empty = false;
    }
    if (strlen($srifto_dydis) != 0) {
        $sql = $sql . "srifto_dydis = '$srifto_dydis', ";
        $all_empty = false;
    }
    if (strlen($sekmes_spalva) != 0) {
        $sql = $sql . "sekmes_spalva = '$sekmes_spalva', ";
        $all_empty = false;
    }
    if (strlen($klaidos_spalva) != 0) {
        $sql = $sql . "klaidos_spalva = '$klaidos_spalva', ";
        $all_empty = false;
    }

    echo "substr is [" . mb_substr($sql, -2) . "]";
    if (mb_substr($sql, -2) == ", ") {
        echo "TURE ";
        $sql = mb_substr($sql, 0, -2);
    } else {
        echo "FALSE";
    }

    if (!$all_empty) {
        $sql = $sql . " WHERE id_Dizaino_tema = '$id';";

        databaseQuery($sql);
        echo $sql;
    } else {
        echo "ALL EMPTY";
    }

    
}