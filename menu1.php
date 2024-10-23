<?php
require_once '../db/conn.php';
require_once '../db/admin.php';

// $type = "dr";
// $liste_compte=select_cord($conn, $type);
// print_r($liste_compte['nom']);
?>
<!-- <link rel="stylesheet" href="../css/style.css">  -->
<!-- <link rel="stylesheet" href="../css/style.css"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <!-- <a class="navbar-brand"  href="#">Acceuil</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../eleve/liste_eleves.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../formateur/liste_formateurs.php">Formateurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../formation/liste_formations.php">Formations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../session_formation/liste_sessions.php">Sessions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../formateur_session/liste_formateur_sessions.php">Formateurs sessions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../eleve_session/liste_eleve_sessions.php">Clients sessions</a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Porte Monnaie
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="../formateur_session/liste_formateur_sessions.php"onclick="return confirm('Tu doit selectionnez la session pour payer !!');">Paiement formateur</a></li>
          <li><a class="dropdown-item" href="../eleve_session/liste_eleve_sessions.php"onclick="return confirm('Tu doit selectionnez la session pour payer!!');">Paiement client</a></li>
          <?php 
        if($_SESSION['user']['libelle']=="directeur"):
         ?>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="../retours/liste_retours.php">Mes retours</a></li>
          <?php 
      endif;
      ?> 
          </ul>
        </li>
       

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Parameteres
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="../type_eleve/liste_type_eleves.php">Type client</a></li>
            <li><a class="dropdown-item" href="../societe/liste_societes.php">Societe</a></li>
            <li><a class="dropdown-item" href="../nv_scolaire/liste_nv_scolaires.php">Niveaux scolaire</a></li>
            <li><a class="dropdown-item" href="../idt/liste_idts.php">Type ID</a></li>
            <?php 
        if($_SESSION['user']['libelle']=="directeur"):
         ?>
            <li><a class="dropdown-item" href="../type_user/liste_type_users.php">Type utilisateur</a></li>
            <?php 
      endif;
      ?> 
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../type_formation/liste_type_formations.php">Type foramtion</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../specialite/liste_specialites.php">Specialite</a></li>
            <li><a class="dropdown-item" href="../modalite_paiement/liste_modalite_paiements.php">Modalite paiement</a></li>
          </ul>
        <?php 
        if($_SESSION['user']['libelle']=="directeur"):
         ?>
        <li class="nav-item">
          <a href="../admin/okhra.php" class="nav-link">Administration</a>
        </li>
        <?php 
      endif;
      ?>
      <li class="nav-item">
          <a href="../sauvgarder/save.php" class="nav-link">Exporter base</a>
          <!-- <a href="../sauvgarder/to_execl.php" class="nav-link">Sauvgarder</a> -->
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sauvgarder
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="../eleve/sauvgarder_eleve.php">Client</a></li>
            <li><a class="dropdown-item" href="../formateur/sauvgarder_formateur.php">Formateur</a></li>
            <li><a class="dropdown-item" href="../session_formation/sauvgarder_session_formation.php">Sessions</a></li>
            <li><a class="dropdown-item" href="../formateur_session/sauvgarder_formateur_sessions.php">Formateur session</a></li>
            <li><a class="dropdown-item" href="../eleve_session/sauvgarder_eleve_session.php">Client session</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../paiement_formateur/liste_formateur_paiements.php">Paiement formateur</a></li>
            <li><a class="dropdown-item" href="../paiement_eleve/sauvgarder_paiement_eleve.php">Paiement client</a></li>
            <?php 
        if($_SESSION['user']['libelle']=="directeur"):
         ?>
            <li><a class="dropdown-item" href="../retours/sauvgarder_retours.php">Mes retours</a></li>
            <?php 
      endif;
      ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../type_eleve/sauvgarder_type_eleve.php">Type client</a></li>
            <li><a class="dropdown-item" href="../societe/sauvgarder_societe.php">Societe</a></li>
            <li><a class="dropdown-item" href="../nv_scolaire/sauvgarder_nv_scolaire.php">Niveaux scolaire</a></li>
            <li><a class="dropdown-item" href="../idt/sauvgarder_idt.php">Type ID</a></li>
            <li><a class="dropdown-item" href="../type_user/sauvgarder_type_user.php">Type utilisateur</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../type_formation/sauvgarder_type_formation.php">Type formation</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../specialite/sauvgarder_specialite.php">Specialite</a></li>
            <li><a class="dropdown-item" href="../modalite_paiement/sauvgarder_modalite_paiement.php">Modalite paiement</a></li>

          </ul>
        </li>
          
        <li class="nav-item">
          <a href="../logout.php" class="nav-link">Deconnexion</a>
        </li>
        
      </ul>      
    </div>
  </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->
