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
    // $id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
    // $id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
    // $input_cher = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // $date_fin = (isset($_POST['date_fin']) && $_POST['date_fin']) ? $_POST['date_fin'] : date('Y-m-d');
    // if ($input_cher != ''){
    //     $sessions = sessions_fetch($conn , $input_cher);
    // }
    // else{
    $formateurs_session = liste_formateur_sessions($conn);
    // print_r($formateurs_session);
    // }
    
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="../session_formation/liste_sessions.php" onclick="return alert('Pour ajouter un formateur pour une session il faut choisir une session');">Ajouter un formateur pour une session</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du formation</th>
                        <th>Nom du session</th>
                        <th>Le formateur</th>
                        <th>Montant</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($formateurs_session as $index => $formateur_session) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $formateur_session['nom_formation'] ?></td>
                        <td><?= $formateur_session['nom_session'] ?></td>
                        <td><?= $formateur_session['nom_formateur'] ?></td>
                        <td><?= $formateur_session['mt_tt'] ?></td>
                        
                        <td>
                            <a href="modif_formateur_session.php?id_formation=<?= $formateur_session['id_formation'] ?>&id_session=<?= $formateur_session['id_session'] ?>&id_formateur=<?= $formateur_session['id_formateur'] ?>">Editer</a>
                            <a href="supp_formateur_session.php?id_formation=<?= $formateur_session['id_formation'] ?>&id_session=<?= $formateur_session['id_session'] ?>&id_formateur=<?= $formateur_session['id_formateur'] ?>&ok=confirmation" onclick="return confirm('Tu es sur de supprimer cette session !?');">Supprimer la session</a>
                            <a href="../paiement_formateur/paiement.php?id_formation=<?= $formateur_session['id_formation'] ?>&id_session=<?= $formateur_session['id_session'] ?>&id_formateur=<?= $formateur_session['id_formateur'] ?>&montant_total=<?= $formateur_session['mt_tt']?>">Paiement</a>
                            <a href="../paiement_formateur/liste_formateur_paiements.php?id_formation=<?= $formateur_session['id_formation'] ?>&id_session=<?= $formateur_session['id_session'] ?>&id_formateur=<?= $formateur_session['id_formateur'] ?>">Historique</a>
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