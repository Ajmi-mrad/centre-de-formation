<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/type_formation.php';

// print_r($_POST);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];

        $type_formation = insert_type_formation($conn, [
            'libelle' => $libelle
        ]);
        
    }
        header("location:liste_type_formations.php");
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
    require_once '../db/type_formation.php';
    $type_formations = liste_type_formations($conn);
    ?> 
    <div class="container m-5">
        <form method="post" onsubmit="return verif()" name="type_formation" >
            <h1>Les types de formtaions</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le type de formation</label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez le type " >
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
<script src="../controle/type_formation.js"></script>
</html>