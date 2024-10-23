<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/formateur.php';

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
        $id_specialite = $_POST['id_specialite'];
        // $cv="";
        $uploaddir = 'C:\\xampp\\htdocs\\centre de formation\\cv';
        print_r($uploaddir);
        print_r($_FILES);
        $uploadfile = $uploaddir ."\\". basename($_FILES['cv']['name']);
        // echo '<pre>';
        if (move_uploaded_file($_FILES['cv']['tmp_name'], $uploadfile)) {
            header("location: liste_formateurs.php");
        } else {
            echo "Attaque potentielle par téléchargement de fichiers.
                Voici plus d'informations :\n";
        }

        $id_formateur = insert_formateur($conn, [
            'nom' => $nom,
            'prenom' => $prenom,
            'tel' => $tel,
            'date_naiss' => $date_naiss,
            'num_id' => $num_id,
            'nat_id' => $nat_id,
            'cv' => $uploadfile,
            'id_specialite' => $id_specialite,
            'email' => $email
            
        ]);
        insert_formateur_specialite($conn,[
            'id_specialite' => $id_specialite,
            'id_formateur' => $id_formateur
        ]);
        insert_idt_formateur($conn,[
            'id_formateur' => $id_formateur,
            'num_id' => $num_id
        ]);

       
    }
        
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
    require_once '../db/formateur.php';
    $types_id = liste_types($conn);
    $specialites = liste_specialites($conn);
    
    ?> 
    <div class="container m-5">
        <form method="post" onsubmit="return verif()" enctype="multipart/form-data" name ="f" >
            <h1>Formateur</h1>
            <h3>Renseignements personnels</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le nom" >
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Tapez le prenom" >
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Numero du telephone</label>
                    <input type="text" class="form-control" name="tel" placeholder="Tapez le numéro telephone" >
                </div>
            </div>
            <br>
            <div class="row g-3"> 
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label"  >Date de naissance</label>
                    <input type="date" class="form-control" name ="date_naiss" id="formGroupExampleInput">
                    <i class="fas fa-calendar-alt"></i>
                </div>        
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Tapez l'email" >
                </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->

            <div class="row g-3"> 
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Type ID</label>
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
                <label for="formGroupExampleInput" class="form-label"  >N° Identification</label>
                    <input type="text" class="form-control" name="nat_id" placeholder="Tapez le numero d'identification " >
                </div>
            </div>
            
            <br>
            <div class="row g-3"> 
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Cv</label>
                <div class="input-group">
  <input name ="cv" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
  <!-- <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button> -->
</div>
</div>
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Specialite formateur</label>
                <select name="id_specialite" class="form-control" id="autoSizingSelect">
                    <option value="0" selected>Choisir une specialite</option>
                    <?php 
            foreach ($specialites as $specialite) {
                ?>
                <option value="<?php echo $specialite['id_specialite']; ?>"><?php echo $specialite['libelle']; ?> </option>
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
<script src="../controle/formateur.js"></script>

</html>
