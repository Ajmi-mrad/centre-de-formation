<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/nv_scolaire.php';

// print_r($_POST);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];

        $id_scolaire = insert_nv_scolaire($conn, [
            'libelle' => $libelle
        ]);
        
    }
        header("location: ../nv_scolaire/liste_nv_scolaires.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/nv_scolaire.php';
    $nv_scolaires = liste_nv_scolaires($conn);
    ?> 
    <div class="container m-5">
        <form method="post" onsubmit="return verif()" name="nv_scolaire" >
            <h1>Niveau Scolaires</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le niveau scolaire </label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez le niveau scolaire" >
                </div>
            </div>
            <br>
            <br>
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
                <button type="reset" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

            
        </form>
    </div>
</body>
<script src="../controle/nv_scolaire.js"></script>
</html>