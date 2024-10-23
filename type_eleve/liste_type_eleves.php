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
    require_once '../db/type_eleve.php';

    // $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // $input_cher = $_POST['input_cher'] ;
    if (isset($_POST['chercher'])) {
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $type_eleves = type_eleve_fetch($conn , $input_cher);
        }
        else{
            $type_eleves = liste_type_eleves($conn);
        // print_r($formations);
        }
    } 
    else{
        $type_eleves = liste_type_eleves($conn);
    }
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_type_eleve.php">Ajouter identifiant client/formateur</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Le type de client</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($type_eleves as $index => $type_eleve) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $type_eleve['libelle'] ?></td>
                        <td>
                            <a href="modif_type_eleve.php?type_eleve=<?= $type_eleve['type_eleve'] ?>">Editer</a>
                            <a href="supp_type_eleve.php?type_eleve=<?= $type_eleve['type_eleve'] ?>" onclick="return confirm('Tu es sur de supprimer cet type_eleve !?');">Supprimer l'type_eleve</a>
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