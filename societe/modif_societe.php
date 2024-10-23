<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/societe.php';

$id_societe = (isset($_GET["id_societe"])) ? intval($_GET["id_societe"]) : intval($_POST["id_societe"]);
$old_societe = societe_fetch_id($conn, $id_societe);
// print_r($id_societe);
// $donne=exsist($conn,$id_societe);
// print_r($donne);
// print_r(!empty($donne)==1);
if (isset($_POST['ok'])) {
    if (isset($_POST['libelle']) && isset($_POST['email'])) {
        $libelle = $_POST['libelle'];
        $email = $_POST['email'];
        
        update_societe($conn, [
            'id_societe' => $id_societe,
            'libelle' =>$libelle,
            'email' => $email
            
        ]);
        }
        header("location: liste_societes.php");
    }
    
    else if(isset($_POST['cancel'])){
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
<?php require_once '../menu1.php'; ?>
    <div class="container m-5">
        <form method="post">
            <h1>Societe</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le nom de la societe</label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez le nom de la societe" value="<?= $old_societe['libelle'] ?>">
                </div>
            </div>
            <br>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >L'email de la societe</label>
                    <input type="text" class="form-control" name="email" placeholder="Tapez l'email" value="<?= $old_societe['email'] ?>">
                </div>
            </div>
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