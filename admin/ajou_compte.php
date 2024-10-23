<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: index.php");
    die();
}
?>
<?php
require_once '../db/conn.php';
require_once '../db/admin.php';
require_once '../menu1.php';

// print_r($_POST);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['nom']) && isset($_POST['prenom'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];
        $type = $_POST['type'];

        $id_login = insert_compte($conn, [
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'mp' => $mdp,
            'type_user' => $type

        ]);
    }
    // header("location: okhra.php");
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
    require_once '../db/type_user.php';
    $types= liste_type_users($conn);
    ?>
    <div class="container m-5">
        <form method="post" onsubmit="return verif()" name="f">
            <h1>Ajouter un compte</h1>
            <hr>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label">Le nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le nom">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label">Le prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Tapez le prenom">
                </div>
            </div>
            <br>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label">L'adresse</label>
                    <input type="text" class="form-control" name="pseudo" placeholder="Tapez l'adresse">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label" >Le mot de passe</label>
                    <input type="text" class="form-control" name="mdp" placeholder="Tapez le mot de passe">
                </div>
            </div>
            <br>
            <div class="col">
            <label for="formGroupExampleInput" class="form-label">Types</label>
                <select name="type" class="form-control" id="autoSizingSelect">
                    <option value="0" selected>Choisir le type d'utilisateur</option>
                    <?php 
            foreach ($types as $tp) {
                ?>
                <option value="<?php echo $tp['type_user']; ?>"><?php echo $tp['libelle']; ?> </option>
                <?php 
                }
            ?>
                </select>
            </div>
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
                <button type="reset" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>
        </form>
    </div>
</body>
<script src="../controle/admin.js"></script>
</html>