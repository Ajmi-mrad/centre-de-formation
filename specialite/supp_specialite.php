<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/specialite.php';


$id_specialite = (isset($_GET["id_specialite"])) ? $_GET["id_specialite"] : '';
$donne=exsist($conn,$id_specialite);

if ($donne!=""){
    die("<script>alert('Cette specialite est relie avec le formateur')
    document.location='liste_specialites.php'</script>");
}

if ($id_specialite != '') {
    $delete = $conn->prepare("DELETE FROM specialite WHERE id_specialite=:id_specialite");
    $delete->execute([':id_specialite' => $id_specialite]);
}
header("location: liste_specialites.php");
