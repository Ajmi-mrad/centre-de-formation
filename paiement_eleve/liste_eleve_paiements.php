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
    require_once '../db/eleve_session.php';
    require_once '../db/eleve_paiement.php';
    $id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
    $id_eleve = (isset($_GET["id_eleve"])) ? intval($_GET["id_eleve"]) : intval($_POST["id_eleve"]);
    $id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
    $eleve_paiements = liste_eleve_paiements($conn, $id_formation,$id_session,$id_eleve);
    if (empty($eleve_paiements)){
        
    }
    // $paye = paye($conn, $id_formation,$id_session,$id_eleve);
    // $total = total($conn, $id_formation,$id_session,$id_eleve);
    // print_r($total);
    // print_r($paye);
    // $rest = $total - $paye;
    // print_r($rest);
    
    ?> 

    <div class="container m-5">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du formation</th>
                        <th>Nom du session</th>
                        <th>Le formateur</th>
                        <th>Le client</th>
                        <th>Montant totale</th>
                        <th>Montant paye</th>
                        <th>Montant rembourser</th>
                        <th>Date</th>
                        <th>Reste</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                 <?php
                foreach ($eleve_paiements as $index => $es) :
                ?> 
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $es['nom_formation'] ?></td>
                        <td><?= $es['nom_session'] ?></td>
                        <td><?= $es['nom_formateur'] ?></td>
                        <td><?= $es['nom_eleve'] ?></td>
                        <td><?= $es['mt_tt'] ?></td>
                        <td><?= $es['montant_paye'] ?></td>
                        <td><?= $es['montant_rembourser'] ?></td>
                        <td><?= $es['dat'] ?></td>
                        <td><?= floatval(paye($conn, $id_formation,$id_session,$id_eleve,$es['mt_tt'])['reste'])?></td>
                        <td><a href="../paiement_eleve/paiement.php?id_formation=<?= $es['id_formation'] ?>&id_session=<?= $es['id_session'] ?>&id_eleve=<?= $es['id_eleve'] ?>&montant_total=<?= $es['mt_tt']?>">Paiement</a></td>
                       
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</body>
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>