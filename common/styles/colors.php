<?php


$main_styles = $GLOBALS['_mysqlConnection']->query("SELECT * from dizaino_tema WHERE id_Dizaino_tema = '1'");
$main_styles = mysqli_fetch_all($main_styles, MYSQLI_ASSOC)[0];

// var_dump($main_styles);

// echo $main_styles["fono_spalva"];

$_fono_spalva = $main_styles["fono_spalva"];
$_teksto_spalva = $main_styles["teksto_spalva"];
$_antrastes_spalva = $main_styles["antrastes_spalva"];
$_porastes_spalva = $main_styles["porastes_spalva"];
$_pagrindine_spalva = $main_styles["pagrindine_spalva"];
$_antraeile_spalva = $main_styles["antraeile_spalva"];
$_pavadinimas = $main_styles["pavadinimas"];
$_srifto_dydis = $main_styles["srifto_dydis"];
$_sekmes_spalva = $main_styles["sekmes_spalva"];
$_klaidos_spalva = $main_styles["klaidos_spalva"];

$_color_gray = "#6c757d";
$_color_primary = "#bc7804";
$_color_primary_darker = "#9f6503";
$_color_primary_lighter = "#d88a04";
$_color_secondary = "#6c757d";
$_color_success = "#28a745";
$_color_info = "#17a2b8";
$_color_warning = "#ffc107";
$_color_danger = "#dc3545";
$_color_light = "#f8f9fa";
$_color_dark = "#343a40";
$_color_darker = "#2c3136";
$_color_noticable = "#542368";