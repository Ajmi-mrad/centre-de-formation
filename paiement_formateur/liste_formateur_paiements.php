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
    require_once '../db/formateur_session.php';
    require_once '../db/formateur_paiement.php';
    $id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
    $id_formateur = (isset($_GET["id_formateur"])) ? intval($_GET["id_formateur"]) : intval($_POST["id_formateur"]);
    $id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
    $formateur_paiements = liste_formateur_paiements($conn, $id_formation,$id_session,$id_formateur);
    // $paye = paye($conn, $id_formation,$id_session,$id_formateur);
    $total = total($conn, $id_formation,$id_session,$id_formateur);
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
                        <th>Montant totale</th>
                        <th>Montant paye</th>
                        <th>Montant rembourser</th>
                        <th>Date</th>
                        <th>Reste total</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                 <?php
                foreach ($formateur_paiements as $index => $fp) :
                ?> 
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $fp['nom_formation'] ?></td>
                        <td><?= $fp['nom_session'] ?></td>
                        <td><?= $fp['nom_formateur'] ?></td>
                        <td><?= $fp['mt_tt'] ?></td>
                        <td><?= $fp['montant_paye'] ?></td>
                        <td><?= $fp['montant_rembourser'] ?></td>
                        <td><?= $fp['dat'] ?></td>
                        <td><?= floatval(paye($conn, $id_formation,$id_session,$id_formateur,$fp['mt_tt'])['reste'])?></td>
                        <!-- <td><?= floatval($paye['reste']) ?></td> -->
                        <td><a href="../paiement_formateur/paiement.php?id_formation=<?= $fp['id_formation'] ?>&id_session=<?= $fp['id_session'] ?>&id_formateur=<?= $fp['id_formateur'] ?>&montant_total=<?= $fp['mt_tt']?>">Paiement</a></td>
                        <!-- <td><a href="../paiement_formateur/sauvgarder_formateur.php?id_formation=<?= $fp['id_formation'] ?>&id_session=<?= $fp['id_session'] ?>&id_formateur=<?= $fp['id_formateur'] ?>&montant_total=<?= $fp['mt_tt']?>">Paiement</a></td> -->
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</body>
</html>