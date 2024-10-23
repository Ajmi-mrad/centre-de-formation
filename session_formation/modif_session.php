<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/session_formation.php';

$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
$id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
$old_session = session_fetch_id($conn, $id_formation,$id_session);

if (isset($_POST['ok'])) {
    if (isset($_POST['ok']) && isset($_POST['date_deb']) && isset($_POST['date_fin']) ) {
        $date_deb = $_POST['date_deb'];
        $date_fin = $_POST['date_fin'];
        $nom_session = $_POST['nom'];
        $prix = $_POST['prix'];
        $dure = $_POST['dure'];

        
        update_session($conn, [
            'id_formation' => $id_formation, 
            'id_session' => $id_session,
            'nom_session' => $nom_session,
            'date_deb' => $date_deb,
            'date_fin' => $date_fin,
            'dure' => $dure,
            'prix' => $prix
        ]);
        
    }   header("location: liste_sessions.php");
    }
    
    else if(isset($_POST['cancel'])){
        header("location: liste_sessions.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
<?php require_once '../menu1.php'; ?>
    <div class="container m-5">
        <form method="post">
        <h1>Session</h1>
            <h3>Informations</h3>
            <div class="row g-3"> 
                <div class="col">
                <!-- <input name="id_session" type="hidden" value="<?php $id_session; ?>"> -->
                    <label for="formGroupExampleInput" class="form-label"  >Date de debut</label>
                    <input type="date" class="form-control" name ="date_deb" id="formGroupExampleInput" value="<?php echo $old_session['date_deb']; ?>">
                    <i class="fas fa-calendar-alt"></i>
                </div>        
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Date fin</label>
                    <input type="date" class="form-control" name ="date_fin" id="formGroupExampleInput" value="<?php echo $old_session['date_fin']; ?>">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du session</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le nom de cette session" value="<?php echo $old_session['nom_session']; ?>" >
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Prix</label>
                    <input type="text" class="form-control" name="prix" placeholder="Tapez le prix de cette session" value="<?php echo $old_session['prix']; ?>">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Dure</label>
                    <input type="text" class="form-control" name="dure" placeholder="Tapez la dure de cette session" value="<?php echo $old_session['dure']; ?>">
                </div>
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