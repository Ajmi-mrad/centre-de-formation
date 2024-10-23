<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/eleve.php';

// print_r($_POST);

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok']) && isset($_POST['nom']) && isset($_POST['prenom']) ) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naiss = $_POST['date_naiss'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $num_id = $_POST['num_id'];
        $nat_id = $_POST['nat_id'];
        $id_scolaire = $_POST['id_scolaire'];
        $id_societe = $_POST['id_societe'];
        $type_eleve = $_POST['type_eleve'];
        // foreach($_POST['type_eleve'] as $value){
        //     $type_eleve = $value;
        // }
        // $type_eleve = 'normal';
        $id_eleve = insert_eleve($conn, [
            'type_eleve' => $type_eleve,
            'nom' => $nom,
            'prenom' => $prenom,
            'tel' => $tel,
            'date_naiss' => $date_naiss,
            'email' => $email,
            'num_id' => $num_id,
            'nat_id' => $nat_id
            
        ]);
        insert_tp_eleve($conn,[
            'id_eleve' => $id_eleve,
            'id_societe' => $id_societe,
            'id_scolaire' => $id_scolaire
        ]);
        insert_idt_eleve($conn,[
            'id_eleve' => $id_eleve,
            'num_id' => $num_id
        ]);
  
    }
        header("location: liste_eleves.php");
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">-->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
    
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/eleve.php';
    $types_id = liste_types($conn);
    $nvs_scolaire = liste_scolaire($conn);
    $societes = liste_societe($conn);
    $types_eleve = liste_type_eleve($conn);
    ?> 
    <div class="container m-5">
        <form method="post" onsubmit="return verif()" name="f1">
            <h1>Client</h1>
            <!-- <h1 style="color: #23AB57;">Client</h1> -->
            <!-- <h3 style="color: #37DE0E;">Renseignements personnels</h3> -->
            <h3>Renseignements personnels</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" placeholder="Tapez le nom" >
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label" >Prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Tapez le prenom" >
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"   >Numero du telephone</label>
                    <input type="text" class="form-control" name="tel" placeholder="Tapez le numéro telephone" >
                </div>
            </div>
            <br>
            <div class="row g-3"> 
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label"   >Date de naissance</label>
                    <input type="date" class="form-control" name ="date_naiss" id="formGroupExampleInput">
                    <i class="fas fa-calendar-alt"></i>
                </div>        
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"   >Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Tapez l'email" >
                </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->

            <div class="row g-3"> 
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"   >Type ID</label>
                <select name="num_id" class="form-control" id="autoSizingSelect">
                <option value="0" selected>Choisir le type d'identification</option>
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
                <label for="formGroupExampleInput" class="form-label"   >N° Identification</label>
                    <input type="text" class="form-control" name="nat_id" placeholder="Tapez le numero d'identification " >
                </div>
            </div>
            
            <br>
            <div class="row g-3"> 
    
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"   >Type de client</label>
                <select name="type_eleve" class="form-control" id="autoSizingSelect">
                    <option value="0" selected>Choisir le type de client</option>
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
            <label for="formGroupExampleInput" class="form-label"   >Eleve/Etudiant</label>
                <select name="id_scolaire" class="form-control" id="autoSizingSelect">
                    <option value="0" selected>Choisir un niveau scolaire</option>
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
            <label for="formGroupExampleInput" class="form-label"   >Societe</label>
                <select name="id_societe" class="form-control" id="autoSizingSelect">
                    <option value="0" selected>Choisir la societe</option>
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
            <hr>
            <div class="btn-block mx-5">
                <button type="submit" name="ok" class="btn btn-outline-success btn-lg">Enregistrer</button>
                <button type="reset" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
            </div>

            
        </form>
    </div>
</body>
<script src="../controle/eleve.js"></script>
</html>