<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ../cnx/cnx.php");
}
// require_once '../menu1.php';
require_once '../db/conn.php';
require_once '../db/eleve_session.php';
// require_once '../db/session_formation.php';
// require_once '../db/formateur.php';
// require_once '../db/modalite_paiement.php';

if (isset($_POST['ok']) || isset($_POST['cancel'])) {
    if (isset($_POST['ok'])&& isset($_POST['id_eleve'])) {
        $id_formateur = $_POST['id_formateur'];
        $id_session = $_POST['id_session'];
        $id_formation = $_POST['id_formation'];
        $id_eleve = $_POST['id_eleve'];

        $eleves_session = liste_eleve_sessions($conn);
        print_r($eleves_session);
        foreach ($eleves_session as $ess) {
            if($id_eleve == $ess['id_eleve']&& 
            $id_formation == $ess['id_formation']&& $id_session == $ess['id_session'] ){
                
                // echo("Ce choix est existe deja!!");
                echo("<script>alert('Ce choix est existe deja!! ')
                document.location='liste_eleve_sessions.php'</script>");
                // alert("Ce choix est existe deja!!");
                // header("location: liste_formateur_sessions.php");
                return;
            }
        
            else{
                // echo"cv";
            insert_eleve_session($conn, [
            'id_formation' => $id_formation, 
            'id_session' => $id_session,
            'id_formateur' => $id_formateur, 
            'id_eleve' =>$id_eleve
            ]);
        
        }
    }
        
    }
        header("location: ../eleve_session/liste_eleve_sessions.php");
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
    require_once '../db/eleve_session.php';
    
    ?> 
    <div class="container m-5">
        <form method="post" >
        <h1>Inscrption a la session</h1>
            <h3>Informations</h3>
            <div class="row g-3"> 
                
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Id de la formation</label>
                    <input type="text" class="form-control" name="id_formation" >
                </div>
           
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Id de la session</label>
                    <input type="text" class="form-control" name="id_session" >
                </div>
            </div>
            <br>
            <!-- <div class="mb-3">
            </div> -->
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Id du formateur</label>
                    <input type="text" class="form-control" name="id_formateur" >
                </div>
                <div class="col">
                    <br>
                <a class="btn btn-outline-success btn mt-2" href="../formateur_session/liste_formateur_sessions.php">Chercher Id formation, formateur et session</a>
                </div>
               
            </div>
            <div class="row g-3">
                <div class="col">
                <label for="formGroupExampleInput" class="form-label"  >Id du client</label>
                    <input type="text" class="form-control" name="id_eleve" >
                </div>
                <div class="col">
                    <br>
                <a class="btn btn-outline-success btn mt-2" href="../eleve/liste_eleves.php">Chercher Id client</a>
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
</html>