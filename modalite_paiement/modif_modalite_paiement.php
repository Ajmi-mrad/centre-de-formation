<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/modalite_paiement.php';

$id_modalite_paiement = (isset($_GET["id_paiement"])) ? intval($_GET["id_paiement"]) : intval($_POST["id_paiement"]);
$old_modalite_paiement = modalite_paiement_fetch_id($conn, $id_modalite_paiement);
print_r($id_modalite_paiement);
if (isset($_POST['ok'])) {
    if (isset($_POST['ok']) && isset($_POST["id_paiement"]) && isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];
        
        update_modalite_paiement($conn, [
            'id_paiement' => $id_paiement,
            'libelle' =>$libelle
            
        ]);
        }
        header("location: liste_modalite_paiements.php");
    }
    
    else if(isset($_POST['cancel'])){
        // header("location: ../modalite_paiement/liste_modalite_paiements.php");
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
            <h1>La modalite de paiement</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >La modalite de paiement</label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez la modalite paiement" value="<?= $old_modalite_paiement['libelle'] ?>">
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
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>