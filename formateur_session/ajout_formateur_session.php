<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/formateur_session.php';
require_once '../db/session_formation.php';
require_once '../db/formateur.php';
require_once '../db/modalite_paiement.php';

// print_r($_POST);
$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
$id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
// print_r($id_formation);
// print_r($id_session)0;
$formateurs = liste_formateurs($conn);
$modalite_paiements = liste_modalite_paiements($conn);
$old_formation_session = formation_session_fetch_id($conn,$id_formation,$id_session);
// print_r($formateurs);
// print_r($id_session);
if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['id_formateur'])) {
        $id_formateur = $_POST['id_formateur'];
        $id_paiement = $_POST['id_paiement'];
        $montant_total = $_POST['montant_total'];
        // print_r($id_formateur);
        // $montant_paye = $_POST['montant_paye'];
        $formateurs_session = liste_formateur_sessions($conn);
        foreach ($formateurs_session as $fs) {
            if($id_formateur == $fs['id_formateur']&& $id_formation==$fs['id_formation']&& $id_session==$fs['id_session']){
                // echo("Ce choix est existe deja!!");
                die("<script>alert('Ce choix est existe deja!! ')
                document.location='liste_formateur_sessions.php'</script>");
                // alert("Ce choix est existe deja!!");
                // header("location: liste_formateur_sessions.php");
                return;
            }
        
            else{
            insert_formateur_session($conn, [
            'id_formation' => $id_formation, 
            'id_session' => $id_session,
            'id_formateur' => $id_formateur, 
            'id_paiement' => $id_paiement,
            'montant_total' => $montant_total
            // 'montant_paye' => $montant_paye
        ]);
        
        }
    }
        
    }
        header("location: liste_formateur_sessions.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
<?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/formateur_session.php';
    
    ?> 
    <div class="container m-5">
        <form method="post"onsubmit="return verif()" name="f" >
        <h1>Formateur de la session</h1>
            <h3>Informations</h3>
            <div class="row g-3"> 
                
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du formation</label>
                    <input type="text" class="form-control" name="nom" value="<?= $old_formation_session['nom']?>" readonly>
                </div>
           
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du session</label>
                    <input type="text" class="form-control" name="nom_session" value="<?= $old_formation_session['nom_session']?>" readonly>
                </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->
            <div class="row g-3">
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label"  >Le formateur de cette session</label>
                    <select name="id_formateur" class="form-control" id="autoSizingSelect">
                        <option value="0" selected>Choisir le formateur de cette session</option>
                        <?php 
                    foreach ($formateurs as $formateur) {
                        ?>
                    <option value="<?php echo $formateur['id_formateur']; ?>"><?php echo $formateur['nom']; ?> </option>
                    <?php 
                    }
                    ?>
                    </select>
                </div>

                <div class="col">
                    <label for="formGroupExampleInput" class="form-label"  >Modalite Paiement</label>
                    <select name="id_paiement" class="form-control" id="autoSizingSelect">
                    <option value="0" selected>Choisir la modalite de paiement</option>
                        <?php 
                    foreach ($modalite_paiements as $modalite_paiement) {
                        ?>
                    <option value="<?php echo $modalite_paiement['id_paiement']; ?>"><?php echo $modalite_paiement['libelle']; ?> </option>
                    <?php 
                    }
                    ?>
                    </select>
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Montant Total</label>
                    <input type="text" class="form-control" name="montant_total" placeholder="Tapez le montant total" >
                </div>
                <div class="col">
               
            </div>
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
                <button type="reset" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

            
        </form>
    </div>
</body>
<script src="../controle/formateur_session.js"></script>

</html>