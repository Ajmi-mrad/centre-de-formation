<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu.php';
require_once '../db/conn.php';
require_once '../db/societe.php';

// print_r($_POST);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['libelle']) && isset($_POST['email']) ) {
        $libelle = $_POST['libelle'];
        $email = $_POST['email'];

        $id_societe = insert_societe($conn, [
            'libelle' => $libelle,
            'email' => $email
        ]);
        
    }
        header("location: ../societe/liste_societes.php");
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
    require_once '../db/societe.php';
    $societes = liste_societes($conn);
    ?> 
    <div class="container m-5">
        <form method="post"onsubmit="return verif()" name="societe"  >
            <h1>Societe</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le nom de la societe </label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez le nom de la societe" >
                </div>
            </div>
            <br>
            <div class="row g-3"> 
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Tapez l'email" >
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
<script src="../controle/societe.js"></script>
</html>