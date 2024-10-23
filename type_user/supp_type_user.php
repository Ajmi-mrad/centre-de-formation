<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once "../db/type_user.php";


$type_user = (isset($_GET["type_user"])) ? $_GET["type_user"] : '';
$libelle = "directeur";
if ($type_user != '') {
    $delete = $conn->prepare("DELETE FROM type_user 
    WHERE type_user=:type_user AND libelle !=:libelle ");
    $delete->execute([':type_user' => $type_user,':libelle' => $libelle]);
}
header("location: liste_type_users.php");
