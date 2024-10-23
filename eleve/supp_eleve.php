<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require_once "../db/conn.php";
require_once '../db/eleve.php';

$id_eleve = (isset($_GET["id_eleve"])) ? intval($_GET["id_eleve"]) : intval($_POST["id_eleve"]);
$num_id= (isset($_GET["num_id"])) ? intval($_GET["num_id"]) : intval($_POST["num_id"]);
// $id_eleve = (isset($_GET["id_eleve"])) ? $_GET["id_eleve"] : '';
$donne=exsist($conn,$id_eleve);
if (isset($_GET['ok'])&& $_GET['ok']=="confirmation") {
    if ($donne!=""){
        die("<script>alert('Ce eleve est entrain d une session tu ne peut pas le supprimer pendant cette periode ')
        document.location='liste_eleves.php'</script>");
    }
    $delete = $conn->prepare("DELETE FROM eleve WHERE id_eleve=:id_eleve");
    $delete->execute([':id_eleve' => $id_eleve]);
   
    $delete_idt = $conn->prepare("DELETE FROM idt_eleve
    WHERE id_eleve=:id_eleve
    AND   num_id=:num_id");
    $delete_idt->execute([':id_eleve' => $id_eleve,':num_id' => $num_id]);    
    header("location: liste_eleves.php");
}

