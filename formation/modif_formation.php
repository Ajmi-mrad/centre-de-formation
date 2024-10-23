<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
require_once '../db/formation.php';
require_once '../db/type_formation.php';
require_once '../db/conn.php';


$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
$old_formation = formation_fetch_id($conn, $id_formation);
// print_r($old_formation);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['nom']) && isset($_POST['description']) ) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $type_formation = $_POST['type_formation'];
        
        update_formation($conn, [
            'id_formation' => $id_formation,
            'nom' => $nom,
            'description' => $description,
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    // require_once '../db/conn.php';
    // require_once '../db/patients.php';

    // $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // // $input_cher = $_POST['input_cher'] ;
    // $input_cher  = (isset($_POST['input_cher']) && $_POST['input_cher']);
    // if ($input_cher != ''){
    //     $patients = patient_fetch($conn , $date_naiss , $input_cher , $input_cher );
    // }
    // else{
    $formations = liste_formations($conn);
    $types_formation = liste_type_formations($conn);
    // }
    
    ?> 

    <div class="container m-5">
    <form method ="post">
    <h1>Formation</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du formation</label>
                    <input type="text" class="form-control" name="nom"  placeholder="Tapez le nom" value="<?= $old_formation['nom'] ?>">
                </div>
                <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Type du formation</label>
                <select name="type_formation" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_formation['type_formation']?>" selected><?php echo $old_formation['libelle'];?></option>
                    <!-- <option value="0">choisir</option> -->
                    <?php 
            foreach ($types_formation as $type_formation) {
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
                    <textarea cols="30" rows="10" class="form-control" name="description" placeholder="Taper la description..."><?= $old_formation['description'] ?></textarea>
                </div>        
                
            </div>
            
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Modifier</button>
                <button type="submit" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

            
    </form>
        
</body>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->
<!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
</html>