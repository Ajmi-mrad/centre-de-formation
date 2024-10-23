<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require "../db/conn.php";
require_once '../db/formateur.php';


$id_formateur = (isset($_GET["id_formateur"])) ? intval($_GET["id_formateur"]) : intval($_POST["id_formateur"]);
$num_id= (isset($_GET["num_id"])) ? intval($_GET["num_id"]) : intval($_POST["num_id"]);
$donne=exsist_formateur($conn,$id_formateur);
// print_r($donne);
if (isset($_GET['ok'])&& $_GET['ok']=="confirmation") {
    // $id_formateur = $_GET['id_formateur'];
    // print_r($id_formateur);
    
    if ($donne!=""){
        die("<script>alert('Le formateur suivant est liee a des session de formation')
        document.location='liste_formateurs.php'</script>");
        
        // return alert("");
        // header("location: liste_formateurs.php");
    }
    else {
        $delete = $conn->prepare("DELETE FROM formateur WHERE id_formateur=:id_formateur");
        $delete->execute([':id_formateur' => $id_formateur]);
        $delete_idt = $conn->prepare("DELETE FROM idt_formateur
            WHERE id_formateur=:id_formateur
            AND   num_id=:num_id");
         $delete_idt->execute([':id_formateur' => $id_formateur,':num_id' => $num_id]); 
        header("location: liste_formateurs.php");
    }
    // 
}