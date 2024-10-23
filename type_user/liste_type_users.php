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
    require_once '../db/type_user.php';

    if (isset($_POST['chercher'])) {
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $type_users = type_user_fetch($conn , $input_cher);
        }
        else{
        $type_users = liste_type_users($conn);
        // print_r($formations);
        }
    } 
    else{
        $type_users = liste_type_users($conn);
    }
    
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajout_type_user.php">Ajouter un type d'utilisateur</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Le type d'utilisateur</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($type_users as $index => $type_user) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $type_user['libelle'] ?></td>
                        <td>
                            <a href="modif_type_user.php?type_user=<?= $type_user['type_user'] ?>">Editer</a>
                            <a href="supp_type_user.php?type_user=<?= $type_user['type_user'] ?>" onclick="return confirm('Tu es sur de supprimer cet type_user !?');">Supprimer l'type_user</a>
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