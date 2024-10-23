<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/idt.php';
$num_id = (isset($_GET["num_id"])) ? $_GET["num_id"] : '';
$donne=exsist($conn,$num_id);

if ($donne!=""){
    die("<script>alert('Ce type d ID est relie avec le formateur ou le client')
    document.location='liste_idts.php'</script>");
}
if ($num_id != '') {
    $delete = $conn->prepare("DELETE FROM idt WHERE num_id=:num_id");
    $delete->execute([':num_id' => $num_id]);
}
header("location: liste_idts.php");
