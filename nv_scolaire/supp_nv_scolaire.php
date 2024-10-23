<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/nv_scolaire.php';

$id_scolaire = (isset($_GET["id_scolaire"])) ? $_GET["id_scolaire"] : '';
$donne=exsist($conn,$id_scolaire);
// print_r($donne);
if ($donne!=""){
    die("<script>alert('Ce niveau scolaire a choissisé par un client tu ne peut pas le supprimer')
    document.location='liste_nv_scolaires.php'</script>") ;
}
if ($id_scolaire != ''){
    $delete = $conn->prepare("DELETE FROM nv_scolaire WHERE id_scolaire=:id_scolaire");
    $delete->execute([':id_scolaire' => $id_scolaire]);
}
header("location: liste_nv_scolaires.php");
