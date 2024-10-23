<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/idt.php';

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];

        $num_id = insert_idt($conn, [
            'libelle' => $libelle
        ]);
        
    }
        header("location:liste_idts.php");
}
else if(isset($_POST['cancel'])){
    header("location: ../idt/liste_idts.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/idt.php';
    $idts = liste_idts($conn);
    ?> 
    <div class="container m-5">
        <form method="post" onsubmit="return verif()" name="idt">
            <h1>Les types d'ientifiant Client/formateur</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >L'identifiant de client/formateur </label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez l'identifiant " >
                </div>
            </div>
            <br>
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
                <button type="reset" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

            
        </form>
    </div>
</body>
<script src="../controle/idt.js"></script>
</html>