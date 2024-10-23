<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/formation.php';


$id_formation = (isset($_GET["id_formation"])) ? $_GET["id_formation"] : '';
$type_formation = (isset($_GET["type_formation"])) ? $_GET["type_formation"] : '';
// $type_formation = 1;
$donne=exsist_formation($conn,$id_formation);
if (isset($_GET['ok'])&& $_GET['ok']=="confirmation") {
    if ($donne!=""){
    die("<script>alert('Cette formation est lie avec une session !!! ')
    document.location='liste_formations.php'</script>");
    }

    $delete = $conn->prepare("DELETE FROM formation WHERE id_formation=:id_formation");
    $delete->execute([':id_formation' => $id_formation]);

    $delete_fr = $conn->prepare("DELETE FROM tp_formation
    WHERE id_formation=:id_formation
    AND type_formation=:type_formation");
    $delete_fr->execute([':id_formation' => $id_formation, ':type_formation' => $type_formation]);
header("location: liste_formations.php");
}