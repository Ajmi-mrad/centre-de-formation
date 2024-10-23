<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
require_once '../db/conn.php';
require_once '../db/formation.php';
require_once '../db/type_formation.php';

$type_formations = liste_type_formations($conn);
// print_r($types_formation);
// print_r($_POST);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['nom']) && isset($_POST['type_formation']) ) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $type_formation = $_POST['type_formation'];
        
        $id_formation = insert_formation($conn, [
            'nom' => $nom,
            'description' => $description,
            'type_formation' => $type_formation
        ]);
        insert_tp_formation ($conn,[
            'id_formation' => $id_formation,
            'type_formation' => $type_formation
        ]);

    }
        header("location: liste_formations.php");
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
   <?php require_once '../menu1.php'; ?>

    <div class="container m-5">
        <form method="post" onsubmit="return verif()" name="f2">
        <h1>Formation</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du formation</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le nom" >
                </div>
                <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Type du formation</label>
                <select name="type_formation" class="form-control" id="autoSizingSelect">
                <option value="0" selected>Choisir le type du formation</option>
                <?php 
            foreach ($type_formations as $type_formation) {
                ?>
                <option value="<?php echo $type_formation['type_formation']; ?>"><?php echo $type_formation['libelle']; ?> </option>
                <?php 
                }
            ?>
                </select>
            </div>
            </div>
            <br>
            <div class="row g-3"> 
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label"  >Description</label>  
                    <textarea cols="30" rows="10" class="form-control" name="description" placeholder="Taper la description..."></textarea>
                </div>        
                
            </div>
            
            <hr>
            <div class="btn-block mx-5">
                <!-- <button class="btn btn-primary" type="submit" name="ok">Enregistrer</button>
                <button class="btn btn-secondary" type="submit" name="cancel">Annuler</button> -->
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
                <button type="reset" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

            
        </form>
    </div>
</body>
<script src="../controle/formation.js"></script>

</html>