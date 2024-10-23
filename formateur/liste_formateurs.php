<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/formateur.php';

    $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // $input_cher = $_POST['input_cher'] ;
    $input_cher  = (isset($_POST['input_cher']) && $_POST['input_cher']);
    if ($input_cher != ''){
        $formateurs = formateur_fetch($conn , $date_naiss , $input_cher , $input_cher , $input_cher, $input_cher);
    }
    else{
        $formateurs = liste_formateurs($conn);
    }
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_formateur.php">Ajouter formateur</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Specialité</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($formateurs as $index => $formateur) :
                ?>
                  <?php 
                $specialites = specialite_fetch($conn,$formateur['id_formateur']);
                // print_r($specialites);
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $formateur['nom'] ?></td>
                        <td><?= $formateur['prenom'] ?></td>
                        <td><?= $formateur['tel'] ?></td>
                        <?php
                // foreach ($specialites as $index => $specialite) :
                 ?>
                        <td><?= $specialites['libelle'] ?></td> 
                         <?php
                //endforeach;
                ?> 
                        <td>
                            <a href="modif_formateur.php?id_formateur=<?= $formateur['id_formateur'] ?>">Editer</a>
                            <a href="supp_formateur.php?id_formateur=<?= $formateur['id_formateur'] ?>&num_id=<?= $formateur['num_id'] ?>&ok=confirmation" onclick="return confirm('Tu es sur de supprimer cet formateur !?');">Supprimer le formateur</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</body>

</html>