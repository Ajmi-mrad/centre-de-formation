<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/session_formation.php';



$id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
// print_r($id_formation);
// print_r($id_session);
if (isset($_GET['ok'])&& $_GET['ok']=="confirmation") {
    $delete = $conn->prepare("DELETE FROM session_formation
     WHERE id_formation=:id_formation
     AND id_session=:id_session");
    $delete->execute([':id_formation' => $id_formation, ':id_session' => $id_session]);
}

header("location: liste_sessions.php");
