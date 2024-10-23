<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
    // require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/eleve_paiement.php';
    require_once '../db/eleve_session.php';

    $id_formation = (isset($_GET["id_formation"])) ? intval($_GET["id_formation"]) : intval($_POST["id_formation"]);
    $id_eleve = (isset($_GET["id_eleve"])) ? intval($_GET["id_eleve"]) : intval($_POST["id_eleve"]);
    $id_session = (isset($_GET["id_session"])) ? intval($_GET["id_session"]) : intval($_POST["id_session"]);
    $montant_total = (isset($_GET["montant_total"])) ? intval($_GET["montant_total"]) : intval($_POST["montant_total"]);

    if (isset($_POST['ok']) || isset($_POST['cancel'])) {
        if (isset($_POST['ok'])) {
            $montant_paye = $_POST['montant_paye'];
            $montant_remb = $_POST['montant_remb'];
            $date = date('Y-m-d H:i:s');
            // print_r($date);

            insert_eleve_paiement($conn, [
            'id_formation' => $id_formation, 
            'id_session' => $id_session,
            'id_eleve' => $id_eleve, 
            'date' => $date,
            'montant_paye' => $montant_paye,
            'montant_modifier' => $montant_remb
            ]);    
        }
        echo("<script>alert('Affecte avec success'); </script>");
        // header("location: liste_eleve_paiements.php");    
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
<?php require_once '../menu1.php'; ?>
    <?php
    $eleves_session = eleve_session_fetch_id($conn, $id_formation,$id_session,$id_eleve);
    ?>
    
    <div class="container m-5">
    <form method ="post" class="d-flex">
    <div class="row g-3">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Nom du formation</th>
                        <th>Nom du session</th>
                        <th>Le formateur</th>
                        <th>Le client</th>
                        <th>Montant Total</th>
                        <th>Montant paye</th>
                        <th>Montant rembourser</th>
                    </tr>
                </thead>
                    <tr>
                        <td><?= $eleves_session['nom_formation'] ?></td>
                        <td><?= $eleves_session['nom_session'] ?></td>
                        <td><?= $eleves_session['nom_formateur'] ?></td>
                        <td><?= $eleves_session['nom_eleve'] ?></td>
                        <td><?= $eleves_session['mt_tt'] ?></td>
                        
                        <td>
                        <input type="text" class="form-control" placeholder="le montant paye!" name="montant_paye">
                        </td>
                        
                        <td>
                        <input type="text" class="form-control" placeholder="le montant que vous avez remboursez!" name="montant_remb">
                        </td>
                    </tr>
            </table>
        </div>
        <hr>
        <div class="col">
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Payer</button>
                <button type="button" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>
        </div>

        </div>
            
            
    </form> 
    </div>
</body>
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>