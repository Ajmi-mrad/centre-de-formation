<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once "../db/type_eleve.php";

$type_eleve = (isset($_GET["type_eleve"])) ? $_GET["type_eleve"] : '';
$donne=exsist($conn,$type_eleve);

if ($donne!=""){
    die("<script>alert('Ce type d eleve est relie avec un eleve')
    document.location='liste_type_eleves.php'</script>");
}

if ($type_eleve != '') {
    $delete = $conn->prepare("DELETE FROM type_eleve WHERE type_eleve=:type_eleve");
    $delete->execute([':type_eleve' => $type_eleve]);
}

header("location: liste_type_eleves.php");
