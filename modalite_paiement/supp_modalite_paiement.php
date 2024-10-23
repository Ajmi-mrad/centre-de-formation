<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/modalite_paiement.php';


$id_paiement = (isset($_GET["id_paiement"])) ? $_GET["id_paiement"] : '';
$donne=exsist($conn,$id_paiement);

if ($donne!=""){
    die("<script>alert('Cette modalite de paiement est relie avec le formateur session')
    document.location='liste_modalite_paiements.php'</script>");
}

if ($id_paiement != '') {
    $delete = $conn->prepare("DELETE FROM modalite_paiement WHERE id_paiement=:id_paiement");
    $delete->execute([':id_paiement' => $id_paiement]);
}
header("location: liste_modalite_paiements.php");
