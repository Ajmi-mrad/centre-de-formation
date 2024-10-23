<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

require_once '../db/conn.php';
require_once '../db/admin.php';

$id_login = (isset($_GET["id_login"])) ? intval($_GET["id_login"]) : intval($_POST["id_login"]);
$old_compte = compte_fetch_id($conn, $id_login);
// print_r($id_type_user);
if (isset($_POST['ok'])) {
    if (isset($_POST['ok'])&& isset($_POST['nom'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
        $type = $_POST['type'];
        
        update_compte($conn, [
            'id_login'=>$id_login,
            'pseudo' => $pseudo,
            'mp' => $mdp,
            'nom' => $nom,
            'prenom' => $prenom,
            'type_user' => $type
        ]);
        }
        header("location: okhra.php");
    }
    
    else if(isset($_POST['cancel'])){
        header("location: ../admin/okhra.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/type_user.php';
    $types= liste_type_users($conn);
    // print_r($old_compte);
    ?>
    <div class="container m-5">
        <form method="post">
        <h1>Le compte a mettre à jour</h1>
            <hr>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le nom</label>
                    <input type="text" class="form-control" name="nom" value="<?= $old_compte['nom'] ?>">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le prenom</label>
                    <input type="text" class="form-control" name="prenom" value="<?= $old_compte['prenom'] ?>">
                </div>
            </div>
            <br>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >L'adresse</label>
                    <input type="text" class="form-control" name="pseudo" value="<?= $old_compte['pseudo'] ?>">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le mot de passe</label>
                    <input type="text" class="form-control" name="mdp" value="<?= $old_compte['mp'] ?>">
                </div>
            </div>
            <br>
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Types d'utilisateur</label>
                <select name="type" class="form-control" id="autoSizingSelect">
                    <option value="<?=$old_compte['type_user']?>" selected><?php echo $old_compte['libelle']; ?></option>
                    <?php 
            foreach ($types as $tp) {
                print_r($tp);
                ?>
                
                <option value="<?php echo $tp['type_user']; ?>"><?php echo $tp['libelle']; ?> </option>
                <?php 
                }
            ?>
                </select>
            </div>


            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Modifier</button>
                <button type="submit" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>
            
    </form>
    </div>
</body>
</html>