<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}


require_once '../db/conn.php';
require_once '../db/eleve.php';

$id_eleve = (isset($_GET["id_eleve"])) ? intval($_GET["id_eleve"]) : intval($_POST["id_eleve"]);
echo "<script>alert('L id eleve '+$id_eleve)</script>";
$old_eleve = eleve_fetch_id($conn, $id_eleve);
$old_num_id_eleve = num_id_fetch($conn,$id_eleve);
// print_r($old_num_id_eleve);
$old_scolaire = scolaire_fetch($conn, $id_eleve);

// if($old_scolaire == ""){
//     $old_scolaire="";
// }
$old_societe = societe_fetch($conn, $id_eleve);
$old_type_eleve = type_eleve_fetch($conn, $id_eleve);
$nvs_scolaire = liste_scolaire($conn);
$societes = liste_societe($conn);
$types_eleve = liste_type_eleve($conn);
if (isset($_POST['ok'])) {
    if (isset($_POST['ok']) && isset($_POST['nom']) && isset($_POST['prenom'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naiss = $_POST['date_naiss'];
        $tel = $_POST['tel'];
        $num_id = $_POST['num_id'];
        $nat_id = $_POST['nat_id'];
        $email = $_POST['email'];
        $type_eleve = $_POST['type_eleve'];
        $id_scolaire = $_POST['id_scolaire'];
        $id_societe = $_POST['id_societe'];
        
        update_eleve($conn, [
            'id_eleve' => $id_eleve,
            'type_eleve' => $type_eleve,
            'nom' => $nom,
            'prenom' => $prenom,
            'tel' => $tel,
            'date_naiss' => $date_naiss,
            'email' => $email,
            'num_id' => $num_id,
            'nat_id' => $nat_id
            
        ]);
        update_tp_eleve($conn,[
            'id_eleve' => $id_eleve,
            'id_societe' => $id_societe,
            'id_scolaire' => $id_scolaire
        ]);
        update_num_id($conn,[
            'id_eleve' => $id_eleve,
            'num_id' => $num_id
        ]);
        

        }
        // header("location: liste_eleves.php");
    }
    
    else if(isset($_POST['cancel'])){
        header("location: liste_eleves.php");
    }
    $types_id = liste_types($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once '../menu1.php';
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
    <div class="container m-5">
        <form method="post">
            <h1 style="color: #23AB57;">Client</h1>
            <h3 style="color: #37DE0E;">Renseignements personnels</h3>
            
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le nom" value="<?= $old_eleve['nom'] ?>">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Tapez le prenom" value="<?= $old_eleve['prenom'] ?>" >
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Numero du telephone</label>
                    <input type="text" class="form-control" name="tel" placeholder="Tapez le numéro telephone" value="<?= $old_eleve['tel'] ?>" >
                </div>
            </div>
            <br>
            <div class="row g-3"> 
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Date de naissance</label>
                    <input type="date" class="form-control" name ="date_naiss" id="formGroupExampleInput" value="<?= $old_eleve['date_naiss'] ?>">
                    <i class="fas fa-calendar-alt"></i>
                </div>        
                <div class="col">
                <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Tapez l'email" value="<?= $old_eleve['email'] ?>">
                </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->

            <div class="row g-3"> 
            <div class="col">
            <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Type ID</label>
                <select name="num_id" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_num_id_eleve['num_id']?>" selected><?php if($old_num_id_eleve==NULL)echo "Selectionnez un type d'ID "; else echo $old_num_id_eleve['libelle'];?></option>
                <?php 
            foreach ($types_id as $type_id) {
                ?>
                <option value="<?php echo $type_id['num_id']; ?>"><?php echo $type_id['libelle']; ?> </option>
                <?php 
                }
            ?>
                </select>
            </div>
            <div class="col">
                <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">N° Identification</label>
                    <input type="text" class="form-control" name="nat_id" placeholder="Tapez le numero d'identification "  value="<?=$old_eleve['nat_id']?>">
                </div>
            </div>
            
            <br>
            <div class="row g-3"> 
    
            <div class="col">
            <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Type de client</label>
                <select name="type_eleve" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_type_eleve['type_eleve']?>" selected><?php if ($old_type_eleve==NULL)echo"Selectionnez type de client "; else echo $old_type_eleve['libelle'];?></option>
                    <?php 
            foreach ($types_eleve as $type_eleve) {
                ?>
                <option value="<?php echo $type_eleve['type_eleve']; ?>"><?php echo $type_eleve['libelle']; ?> </option>
                <?php 
                }
            ?>
         
                </select>
            </div>

            <div class="col">
            <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Eleve/Etudiant</label>
                <select name="id_scolaire" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_scolaire['id_scolaire']?>" selected><?php  if ($old_scolaire==NULL)echo "Selectionnez le niveau scoalire de client "; else echo $old_scolaire['libelle']; ?></option>
                    <?php 
            foreach ($nvs_scolaire as $nv_scolaire) {
                ?>
                <option value="<?php echo $nv_scolaire['id_scolaire']; ?>"><?php echo $nv_scolaire['libelle']; ?> </option>
                <?php 
                }
            ?>
                </select>
            </div>

            <div class="col">
            <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Societe</label>
                <select name="id_societe" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_societe['id_societe']?>" selected><?php if($old_societe==NULL)echo"Selectionnez la societe ";else echo $old_societe['libelle'];?></option>
                    <?php 
            foreach ($societes as $societe) {
                ?>
                <option value="<?php echo $societe['id_societe']; ?>"><?php echo $societe['libelle']; ?> </option>
                <?php 
                }
            ?>
                </select>
            </div>
            </div>
            <br>
           
            
    <div class="btn-block mx-5">
        <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
        <button type="submit" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
    </div>
    </form>
    </div>
</body>
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>