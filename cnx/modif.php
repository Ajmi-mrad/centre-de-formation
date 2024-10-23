<?php
session_start();

if (isset($_SESSION['user'])) {
  header('location: ../eleve/liste_eleves.php');
  die();
}

require_once '../db/conn.php';
require_once '../db/admin.php';

// print_r($_POST);
$message = "";
if (isset($_POST['adresse']) && isset($_POST['mdp'])) {
  $user = login_user($conn, $_POST['adresse'], $_POST['mdp']);
  // count($liste_acc) == 0
  if ($user) {
    $_SESSION['user'] = $user;
    header("location: ../eleve/liste_eleves.php");
  } else {
    $message = 'Desole les infromations incorrect';
  }
}


  if (isset($_POST['nom']) && isset($_POST['prenom'])) {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $pseudo = $_POST['ad'];
      $mdp = $_POST['mdp'];
      $type_user = 1;

      $id_login = insert_compte($conn, [
          'nom' => $nom,
          'prenom' => $prenom,
          'pseudo' => $pseudo,
          'mp' => $mdp,
          'type_user' => $type_user

      ]);
  }
  // header("location: okhra.php");

?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
<link rel="stylesheet" href="style.css">

<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="post">
                <h1>Créer un compte</h1>
                <div class="social-container">
                    <a href="https://www.instagram.com/edraak_formation/?hl=fr" target="_blank" class="social"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/edraakformation" target="_blank" class="social"><i class="fab fa-facebook"></i></a>
                    <a href="https://tn.linkedin.com/in/centre-edraak" target="_blank" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input name="nom" type="text" placeholder="Nom"/>
                <input name="prenom" type="text" placeholder="Prenom"/>
                <input name="ad" type="text" placeholder="Adresse"/>
                <input name="mdp" type="password" placeholder="Mot de passe"/>
                <button class="su" >S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="post">
                <h1>Mot de passe oubilié</h1>
                <div class="social-container">
                    <a href="https://www.instagram.com/edraak_formation/?hl=fr" target="_blank" class="social"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/edraakformation" target="_blank" class="social"><i class="fab fa-facebook"></i></a>
                    <a href="https://tn.linkedin.com/in/centre-edraak" target="_blank" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <input name="adresse" type="text" placeholder="Mot d"/>
                <input name="mdp" type="password" placeholder="Mot de passe"/>
                <a href="#" target="_blank">J'ai oublié mon mot de passe</a>
                <a href="#" target="_blank">Je peux modifier mon mot de passe</a>
                <button class="si">S'identifier</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bienvenue !</h1>
                    <p>Pour rester connecté avec nous, veuillez vous connecter avec vos informations personnelles</p>
                    <button class="ghost" id="signIn">S'identifier</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bonjour !</h1>
                    <p>Entrez vos données personnelles et commencez votre journé avec nous</p>
                    <button class="ghost" id="signUp">S'inscrire</button>
                </div>
            </div>
        </div>
</div>
<div class="my-2"><?= $message ?></div>
<script src="main.js"></script>

