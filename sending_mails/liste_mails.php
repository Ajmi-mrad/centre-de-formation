<?php
// session_start();

// if (!isset($_SESSION['user'])) {
//     header("location: ../cnx/cnx.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <title>Centre de formation</title>
</head>

<body>
    <?php
    require_once '../menu1.php';
    require_once '../db/conn.php';
    require_once '../db/eleve.php';

    $date_naiss = (isset($_POST['input_cher']) && $_POST['input_cher']) ? $_POST['input_cher'] : date('Y-m-d');
    // $input_cher = $_POST['input_cher'] ;
    $input_cher  = (isset($_POST['input_cher']) && $_POST['input_cher']);
    if ($input_cher != ''){
        $eleves = eleve_fetch($conn , $date_naiss , $input_cher , $input_cher, $input_cher, $input_cher);
    }
    else{
        $eleves = liste_eleves($conn);
    }
    
    foreach($_POST['to'] as $value){
        $to = $value;
        print_r($to);
        $subject = 'Mail envoyé depuis Edraak';
        $message = $_POST['message'];



    if (mail($to, $subject, $message,)) {

        echo 'Mail envoyé avec succèss.';

    } else {

        echo 'Unable to send mail. Please try again.';

    }
    }
    ?> 

    <div class="container m-5">
    <form method ="post" class="d-flex">
        <div class="m-2">
        <input class="form-control me-2" type="search" placeholder="Recherche" name="input_cher" aria-label="Search">
        <!-- <br> -->
            </div>
        <div class="m-2">
            <button class="btn btn-outline-success" type="submit" name="chercher">chercher</button>
            <!-- <a class="btn btn-success" href="ajout_eleve.php">Ajouter Client</a> -->
        </div>
        <!-- <br> -->
        <div class="">
        <label for="formGroupExampleInput" class="form-label" style="color: #C3E623; font-weight: bold;">Description</label>  
        <textarea cols="200" rows="2" class="form-control" name="message" placeholder="Taper le message..."></textarea>
        <button class="btn btn-outline-success" type="submit" name="ok">Envoyer</button>
        </div>
        
    </form>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Coche</th>
                    </tr>
                </thead>
                <?php
                foreach ($eleves as $index => $eleve) :
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $eleve['nom'] ?></td>
                        <td><?= $eleve['prenom'] ?></td>
                        <td><?= $eleve['tel'] ?></td>
                        <td><?= $eleve['email'] ?></td>
                        <td>
                        <div class="form-check">
  <input class="form-check-input" type="checkbox" name="to[]" value="<?=$eleve['email']?>" id="flexCheckDefault">
  
</div>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    </div>
</body>
<!-- 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->

</html>