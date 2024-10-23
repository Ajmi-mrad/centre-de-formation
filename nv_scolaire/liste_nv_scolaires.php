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
    require_once '../db/nv_scolaire.php';

    if (isset($_POST['chercher'])) {
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $nv_scolaires = nv_scolaire_fetch($conn , $input_cher);
        }
        else{
            $nv_scolaires = liste_nv_scolaires($conn);
        // print_r($formations);
        }
    } 
    else{
        $nv_scolaires = liste_nv_scolaires($conn);
    }
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_nv_scolaire.php">Ajouter nv_scolaire</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Le niveau scolaire</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($nv_scolaires as $index => $nv_scolaire) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $nv_scolaire['libelle'] ?></td>
                        <td>
                            <a href="modif_nv_scolaire.php?id_scolaire=<?= $nv_scolaire['id_scolaire'] ?>">Editer</a>
                            <a href="supp_nv_scolaire.php?id_scolaire=<?= $nv_scolaire['id_scolaire'] ?>" onclick="return confirm('Tu es sur de supprimer cet nv_scolaire !?');">Supprimer l'nv_scolaire</a>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>