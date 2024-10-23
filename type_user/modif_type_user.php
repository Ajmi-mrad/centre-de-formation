<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/type_user.php';

$id_type_user = (isset($_GET["type_user"])) ? intval($_GET["type_user"]) : intval($_POST["type_user"]);
$old_type_user = type_user_fetch_id($conn, $id_type_user);
// print_r($id_type_user);
if (isset($_POST['ok'])) {
    if (isset($_POST['ok'])&& isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];
        
        update_type_user($conn, [
            'type_user' => $id_type_user,
            'libelle' =>$libelle
            
        ]);
        }
        header("location: liste_type_users.php");
    }
    
    else if(isset($_POST['cancel'])){
        header("location: ../type_user/liste_type_users.php");
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
<?php require_once '../menu1.php';?>
    <div class="container m-5">
        <form method="post">
            <h1>Les types d'utilisateur</h1>
            <h3>Informations</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le type de client</label>
                    <input type="text" class="form-control" name="libelle" value="<?= $old_type_user['libelle'] ?>">
                </div>
            </div>
            <br>
            <hr>
    <div class="btn-block mx-5">
        <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
        <button type="submit" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
    </div>
    </form>
    </div>
</body>
</html>