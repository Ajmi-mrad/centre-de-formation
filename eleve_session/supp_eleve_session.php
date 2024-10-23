<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";

$id_sessison = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
$id_eleve = (isset($_GET["id_eleve"])) ? intval($_GET["id_eleve"]) : intval($_POST["id_eleve"]);
$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);

if (isset($_GET['ok'])&& $_GET['ok']=="confirmation") {
    $delete = $conn->prepare("DELETE FROM eleve_session
    WHERE id_formation=:id_formation
    AND id_session=:id_session
    AND id_eleve=:id_eleve");
    $delete->execute([':id_formation' => $id_formation, ':id_session' => $id_sessison, ':id_eleve' => $id_eleve]);
}

header("location: liste_eleve_sessions.php");
