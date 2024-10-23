<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/type_formation.php';

$id_type_formation = (isset($_GET["type_formation"])) ? intval($_GET["type_formation"]) : intval($_POST["type_formation"]);
$old_type_formation = type_formation_fetch_id($conn, $id_type_formation);
print_r($id_type_formation);
if (isset($_POST['ok'])) {
    if (isset($_POST['ok']) && isset($_POST["type_formation"]) && isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];
        
        update_type_formation($conn, [
            'type_formation' => $type_formation,
            'libelle' =>$libelle
            
        ]);
        }
        header("location: liste_type_formations.php");
    }
    
    else if(isset($_POST['cancel'])){
        header("location: ../type_formation/liste_type_formations.php");
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
<?php require_once '../menu1.php';?>
    <div class="container m-5">
        <form method="post">
            <h1>Les types des formations</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le type de formation</label>
                    <input type="text" class="form-control" name="libelle" placeholder="Tapez le type de formation" value="<?= $old_type_formation['libelle'] ?>">
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
</html>