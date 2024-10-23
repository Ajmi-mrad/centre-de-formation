<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> -->
    <title>Document</title>
</head>
<body>
<?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/admin.php';

    if (isset($_POST['chercher'])) {
        $input_cher  = ($_POST['input_cher']);
        if ($input_cher != ''){
            $comptes = compte_fetch($conn , $input_cher);
        }
        else{
            $comptes = liste_compte($conn);
        }
    } 
    else{
        $comptes = liste_compte($conn);
    }
    ?>    

    

<div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
            <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">Chercher</button>
            <a class="btn btn-success" href="ajou_compte.php">Ajouter compte</a>
        </div>
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Type</th>
                        <th>Adresse</th>
                        <th>Mot de passe</th>
                        <th>Opérations</th>
                    </tr>
                </thead>
                <?php
                foreach ($comptes as $index => $compte) :
                ?>
                    <tr>
                        
                        <td><?= $index + 1 ?></td>
                        <td><?= $compte['nom'] ?></td>
                        <td><?= $compte['prenom'] ?></td>
                        <td><?= $compte['libelle'] ?></td>
                        <td><?= $compte['pseudo'] ?></td>
                        <td><?= $compte['mp'] ?></td>
                        <td>
                        <a href="modif_compte.php?id_login=<?= $compte['id_login'] ?>">Editer</a>
                        <a href="supp_compte.php?id_login=<?= $compte['id_login'] ?>&ok=confirmation" onclick="return confirm('Tu es sur de supprimer le compte !?');">Supprimer</a>
                        
                        </td>
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