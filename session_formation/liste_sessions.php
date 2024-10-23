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
    require_once '../db/session_formation.php';

    // $input_cher = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // $date_fin = (isset($_POST['date_fin']) && $_POST['date_fin']) ? $_POST['date_fin'] : date('Y-m-d');
    if (isset($_POST['chercher'])) {
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $sessions = sessions_fetch($conn , $input_cher);
        }
        else{
            $sessions = liste_sessions($conn);
        // print_r($formations);
        }
    } 
    else{
        $sessions = liste_sessions($conn);
    }
    
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="../formation/liste_formations.php" onclick="return alert('Pour ajouter une session elle faut relie a une formation');">Ajouter une nouvelle session</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom du formation</th>
                        <th>Nom du session</th>
                        <th>La date de debut</th>
                        <th>La date finale</th>
                        <th>Prix</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($sessions as $index => $session) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $session['nom'] ?></td>
                        <td><?= $session['nom_session'] ?></td>
                        <td><?= $session['date_deb'] ?></td>
                        <td><?= $session['date_fin'] ?></td>
                        <td><?= $session['prix'] ?></td>
                        <td>
                            <a href="../formateur_session/ajout_formateur_session.php?id_formation=<?= $session['id_formation'] ?>&id_session=<?= $session['id_session'] ?>">Ajouter le formateur de cette session</a>
                            <a href="modif_session.php?id_formation=<?= $session['id_formation'] ?>&id_session=<?= $session['id_session'] ?>">Editer</a>
                            <a href="supp_session.php?id_formation=<?= $session['id_formation'] ?>&id_session=<?= $session['id_session'] ?>&ok=confirmation" onclick="return confirm('Tu es sur de supprimer cette session !?');">Supprimer la session</a>
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