<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}

// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/formateur.php';

$id_formateur = (isset($_GET["id_formateur"])) ? intval($_GET["id_formateur"]) : intval($_POST["id_formateur"]);
$old_formateur = formateur_fetch_id($conn, $id_formateur);
$old_formateur_specialite = specialite_fetch($conn, $id_formateur);
$old_num_id_formateur = num_id_fetch($conn,$id_formateur);
// print_r($old_formateur_specialite);
// print_r($old_num_id_formateur);
// print_r($old_num_id_formateur);

if (isset($_POST['ok'])) {
    if (isset($_POST['ok']) && isset($_POST['nom']) && isset($_POST['prenom'])) {
        print_r($old_num_id_formateur);
        echo "update";
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naiss = $_POST['date_naiss'];
        $tel = $_POST['tel'];
        $num_id = $_POST['num_id'];
        $nat_id = $_POST['nat_id'];
        $cv = '';
        $id_specialite = $_POST['id_specialite'];
        $email = $_POST['email'];
       

        update_formateur($conn, [
            'id_formateur' => $id_formateur,
            'nom' => $nom,
            'prenom' => $prenom,
            'tel' => $tel,
            'date_naiss' => $date_naiss,
            'num_id' => $num_id,
            'nat_id' => $nat_id,
            'cv' => $cv,
            'id_specialite' => $id_specialite,
            'email' => $email
        ]);
        update_num_id($conn,[
            'id_formateur' => $id_formateur,
            'num_id' => $num_id
        ]);
        }
        header("location: liste_formateurs.php");
    }
    
    else if(isset($_POST['cancel'])){
        header("location: liste_formateurs.php");
    }
    $specialites = liste_specialites($conn);
    $types_id = liste_types($conn);
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
        <h1>Formateur</h1>
            <h3>Renseignements personnels</h3>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Tapez le nom" value="<?= $old_formateur['nom'] ?>">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="Tapez le prenom" value="<?= $old_formateur['prenom'] ?>">
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Le numero du telephone</label>
                    <input type="text" class="form-control" name="tel" placeholder="Tapez le numéro telephone" value="<?= $old_formateur['tel'] ?>">
                </div>
            </div>
            <br>
            <div class="row g-3">
        
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Date de naissance</label>
                <input type="date" class="form-control" name ="date_naiss" id="formGroupExampleInput" value="<?= $old_formateur['date_naiss']?>">
                <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Tapez l'email " value="<?= $old_formateur['email']?>">
                </div>

            
            </div>
            <br>
            
            
            <div class="row g-3"> 
            <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Type ID</label>
                <select name="num_id" class="form-control" id="autoSizingSelect">
                <option value="<?=$old_num_id_formateur['num_id']?>" selected><?php if ($old_num_id_formateur==NULL)echo "Selectionnez un type ID";else echo $old_num_id_formateur['libelle'];?></option>
                    <!-- <option value="0">choisir</option> -->
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
                    <input type="text" class="form-control" name ="nat_id" placeholder="Enter Le N° Identification" value="<?= $old_formateur['nat_id']?>">
                </div>
                
            </div>

            <br>
           <div class="row g-3"> 
                <div class="col">
            <div class="input-group mb-3">
            <label for="formGroupExampleInput" class="form-label"  >Cv</label>
            <div class="input-group">
                <input name="cv" type="file" class="form-control" id="inputGroupFile01">
            </div>
            </div>
                </div>
                <div class="col">
            <label for="formGroupExampleInput" class="form-label"  >Specialite formateur</label>
                <select name="id_specialite" class="form-control" id="autoSizingSelect">
                    <option value="<?= $old_formateur_specialite['id_specialite']?>" selected><?php if($old_formateur_specialite==NULL)echo "Selectionnez la specialite de formateur";else echo $old_formateur_specialite['libelle'];?></option>
                    <!-- <option value="0">choisir</option> -->
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
            
    
    <div class="btn-block mx-5">
        <button type="submit" name="ok" class="btn btn-outline-primary btn-lg">Enregistrer</button>
        <button type="submit" name="cancel" class="btn btn-outline-secondary btn-lg">Annuler</button>
    </div>
    </form>
    </div>
</body>

</html>