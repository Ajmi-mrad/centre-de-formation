<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/nv_scolaire.php';

$id_nv_scolaire = (isset($_GET["id_scolaire"])) ? intval($_GET["id_scolaire"]) : intval($_POST["id_scolaire"]);
$old_nv_scolaire = nv_scolaire_fetch_id($conn, $id_nv_scolaire);
// print_r($id_nv_scolaire);
if (isset($_POST['ok'])) {
    if (isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];
        
        update_nv_scolaire($conn, [
            'id_scolaire' => $id_nv_scolaire,
            'libelle' =>$libelle
            
        ]);
        }
        header("location: liste_nv_scolaires.php");
    }
    
    else if(isset($_POST['cancel'])){
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
<?php require_once '../menu1.php'; ?>
    <div class="container m-5">
        <form method="post">
            <h1>Le niveau scolaire</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le niveau scolaire</label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez le nom de la nv_scolaire" value="<?= $old_nv_scolaire['libelle'] ?>">
                </div>
            </div>
            <br>
            <hr>
    <div class="btn-block mx-5">
        <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
        <button type="submit" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
    </div>
    </form>
    </div>
</body>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>