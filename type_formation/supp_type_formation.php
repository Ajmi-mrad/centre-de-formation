<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/type_formation.php';


$type_formation = (isset($_GET["type_formation"])) ? $_GET["type_formation"] : '';
$donne=exsist($conn,$type_formation);

if ($donne!=""){
    die("<script>alert('Ce type de formation est relie avec une formation')
    document.location='liste_type_formations.php'</script>");
}

if ($type_formation != '') {
    $delete = $conn->prepare("DELETE FROM type_formation WHERE type_formation=:type_formation");
    $delete->execute([':type_formation' => $type_formation]);
}
header("location: liste_type_formations.php");
