<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/session_formation.php';



$id_sessison = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
$id_formateur = (isset($_GET["id_formateur"])) ? intval($_GET["id_formateur"]) : intval($_POST["id_formateur"]);
$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);

if (isset($_GET['ok'])&& $_GET['ok']=="confirmation") {
    $delete = $conn->prepare("DELETE FROM formateur_session
    WHERE id_formation=:id_formation
    AND id_session=:id_session
    AND id_formateur=:id_formateur");
    $delete->execute([':id_formation' => $id_formation, ':id_session' => $id_sessison, ':id_formateur' => $id_formateur]);
}

header("location: liste_formateur_sessions.php");
