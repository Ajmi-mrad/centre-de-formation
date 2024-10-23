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
    require_once '../db/modalite_paiement.php';

    // $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // $input_cher = $_POST['input_cher'] ;
    $input_cher  = (isset($_POST['input_cher']) && $_POST['input_cher']);
    if ($input_cher != ''){
        $modalite_paiements = modalite_paiement_fetch($conn , $input_cher);
        print_r($modalite_paiements);
    }
    else{
        $modalite_paiements = liste_modalite_paiements($conn);
    }
    
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_modalite_paiement.php">Ajouter modalite_paiement</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>La modalite de paiement</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($modalite_paiements as $index => $modalite_paiement) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $modalite_paiement['libelle'] ?></td>
                        <td>
                            <a href="modif_modalite_paiement.php?id_paiement=<?= $modalite_paiement['id_paiement'] ?>">Editer</a>
                            <a href="supp_modalite_paiement.php?id_paiement=<?= $modalite_paiement['id_paiement'] ?>" onclick="return confirm('Tu es sur de supprimer cet modalite_paiement !?');">Supprimer l'modalite_paiement</a>
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