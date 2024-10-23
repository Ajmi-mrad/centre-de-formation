<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once "../db/societe.php";


$id_societe = (isset($_GET["id_societe"])) ? $_GET["id_societe"] : '';
$donne=exsist($conn,$id_societe);

if (!empty($donne)){
    die("<script>alert('Cette societe est relie avec un type d eleve')
    document.location='liste_societes.php'</script>");
}
if ($id_societe != '') {
    $delete = $conn->prepare("DELETE FROM societe WHERE id_societe=:id_societe");
    $delete->execute([':id_societe' => $id_societe]);
}
header("location: liste_societes.php");
