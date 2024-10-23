<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/formateur_session.php';
require_once '../db/formateur.php';
require_once '../db/modalite_paiement.php';
$id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
$id_formateur = (isset($_GET["id_formateur"])) ? intval($_GET["id_formateur"]) : intval($_POST["id_formateur"]);
$id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
echo "<script>alert('L id formation '+$id_formation+ ' L id formateur '+$id_formateur+'L id session '+$id_session)</script>";

$old_formateur_session = formateur_session_fetch_id($conn, $id_formation,$id_session,$id_formateur);
$formateurs = liste_formateurs($conn);
$modalite_paiements = liste_modalite_paiements($conn);

if (isset($_POST['ok'])) {
    if (isset($_POST['ok']) && isset($_POST['id_forma']) && isset($_POST['id_paiement']) ) {
        $id_paiement = $_POST['id_paiement'];
        $montant_total = $_POST['montant_total'];
        $id_forma = $_POST['id_forma'];
        // print_r($id_forma);
        // $montant_paye = $_POST['montant_paye'];
        
        update_formateur_session($conn, [
            'id_formation' => $id_formation, 
            'id_session' => $id_session,
            'id_formateur' => $id_forma, 
            'id_paiement' => $id_paiement,
            'montant_total' => $montant_total
            // 'montant_paye' => $montant_paye,

        ]);
        
    }
        header("location: liste_formateur_sessions.php");
    }
    
    else if(isset($_POST['cancel'])){
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
    
<?php
    require_once '../menu1.php';
    ?>
    <div class="container m-5">
        <form method="post">
        <h1 style="color: #23AB57;">Le formateur de cette session</h1>
            <h3 style="color: #37DE0E;">Informations</h3>
            <div class="row g-3"> 
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du formation</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le prix de cette session" value="<?= $old_formateur_session['nom_formation']?>" readonly>
                </div>
           
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom du session</label>
                    <input type="text" class="form-control" name="nom_session" placeholder="Tapez le prix de cette session" value="<?= $old_formateur_session['nom_session']?>" readonly>
                </div>
                <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Formateur</label>
                <select name="id_forma" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_formateur_session['id_formateur']?>" selected><?php echo $old_formateur_session['nom_formateur'];?></option>
                    <!-- <option value="0">choisir</option> -->
                    <?php 
                    foreach ($formateurs as $formateur) {
                        ?>
                    <option value="<?php echo $formateur['id_formateur']; ?>"><?php echo $formateur['nom']; ?> </option>
                    <?php 
                    }
                    ?>
              
                </select>
            </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->
            <div class="row g-3">
               
                
                <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Modalite Paiement</label>
                <select name="id_paiement" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_formateur_session['id_paiement']?>" selected><?php echo $old_formateur_session['libelle'];?></option>
                    <!-- <option value="0">choisir</option> -->
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
                    <input type="text" class="form-control" name="montant_total" placeholder="Tapez le prix de cette session" value="<?php echo $old_formateur_session['mt_tt']; ?>">
                </div>
            </div>
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Modifier</button>
                <button type="button" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

         
    </form>
    </div>
</body>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>