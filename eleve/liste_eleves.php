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
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/eleve.php';

    if (isset($_POST['chercher'])) {
        $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $eleves = eleve_fetch($conn , $date_naiss , $input_cher , $input_cher, $input_cher, $input_cher);
        }
        else{
            $eleves = liste_eleves($conn);
        // print_r($formations);
        }
    } 
    else{
        $eleves = liste_eleves($conn);
    }
    
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_eleve.php">Ajouter Client</a>
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
                        <th>Email</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($eleves as $index => $eleve) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $eleve['nom'] ?></td>
                        <td><?= $eleve['prenom'] ?></td>
                        <td><?= $eleve['tel'] ?></td>
                        <td><?= $eleve['email'] ?></td>
                        <td>
                            <a href="modif_eleve.php?id_eleve=<?= $eleve['id_eleve'] ?>">Editer</a>
                            <a href="supp_eleve.php?id_eleve=<?= $eleve['id_eleve']?>&num_id=<?= $eleve['num_id']?>&ok=confirmation" onclick="return confirm('Tu es sur de supprimer cet eleve !?');">Supprimer ce client</a>
                            <!-- <a style="color: #DEEC09;" href="sauvgarder_eleve.php?id_eleve=<?= $eleve['id_eleve'] ?>">Editer</a> -->
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