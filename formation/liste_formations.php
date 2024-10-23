<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
require_once '../menu1.php';
require_once '../db/formation.php';
require_once '../db/conn.php';

// print_r($_POST);

if (isset($_POST['ajouter'])) {
    if (isset($_POST['ajouter']) && isset($_POST['nom']) && isset($_POST['description']) ) {
        $nom = $_POST['nv_formation'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        
        $id_formation = insert_formation($conn, [
            'nom' => $nom,
            'description' => $description,
            'type' => $type
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
    <!-- <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->
    <title>Centre de formation</title>
</head>

<body>
    <?php
    // require_once '../menu.php';
    // require_once '../db/conn.php';
    // require_once '../db/patients.php';

    // $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // // $input_cher = $_POST['input_cher'] ;
    if (isset($_POST['chercher'])) {
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $formations = formation_fetch($conn , $input_cher);
        }
        else{
        $formations = liste_formations($conn);
        // print_r($formations);
        }
    } 
    else{
        $formations = liste_formations($conn);
    }
    
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_formation.php">Ajouter une formation</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($formations as $index => $formation) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $formation['libelle'] ?></td>
                        <td><?= $formation['nom'] ?></td>
                        <td><?= $formation['description'] ?></td>
                        <td>
                            <a href="../session_formation/ajout_session.php?id_formation=<?= $formation['id_formation'] ?>">Ajouter une session</a>
                            <a href="modif_formation.php?id_formation=<?= $formation['id_formation'] ?>">Editer</a>
                            <a href="supp_formation.php?id_formation=<?= $formation['id_formation'] ?>&type_formation=<?= $formation['type_formation'] ?>&ok=confirmation" onclick="return confirm('Tu es sur de supprimer cette formation !?');">Supprimer</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</body>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->
<!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
</html>