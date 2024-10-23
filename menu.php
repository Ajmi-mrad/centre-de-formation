<?php
require_once '../db/conn.php';
require_once '../db/admin.php';

// $type = "dr";
// $liste_compte=select_cord($conn, $type);
// print_r($liste_compte['nom']);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand , text-success" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="../eleve/liste_eleves.php" id="navbarDropdown" role="button" >
                        Client 
                    </a>
            
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../formation/liste_formations.php" id="navbarDropdown" role="button" >
                        Formations
                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../formateur/liste_formateurs.php" id="navbarDropdown" role="button">
                        Formateurs
                    </a>
                    
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../session_formation/liste_sessions.php" id="navbarDropdown" role="button">
                        Sessions
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../formateur_session/liste_formateur_sessions.php" id="navbarDropdown" role="button">
                        Formateur de session
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../societe/liste_societes.php" id="navbarDropdown" role="button">
                        Societe
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../nv_scolaire/liste_nv_scolaires.php" id="navbarDropdown" role="button">
                        Niveaux Scolaire
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../idt/liste_idts.php" id="navbarDropdown" role="button">
                        Type ID client/foramteur
                    </a>
                    
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="../type_eleve/liste_type_eleves.php" id="navbarDropdown" role="button">
                        Type client
                    </a>
                    
                </li> -->

                <!-- <li class="nav-item">
                    <a class="nav-link" href="../specialite/liste_specialites.php" id="navbarDropdown" role="button">
                        Specialite Formateur
                    </a>
                    
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="../modalite_paiement/liste_modalite_paiements.php" id="navbarDropdown" role="button">
                        Modalite de paiement
                    </a>
                    
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="../type_formation/liste_type_formations.php" id="navbarDropdown" role="button">
                        Type de formation
                    </a>
                    
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../type_user/liste_type_users.php" id="navbarDropdown" role="button">
                        Type d'utilisateur
                    </a>
                    
                </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Paramétres
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Niveau scolaire</a></li>
                    <li><a class="dropdown-item" href="#">Societe</a></li>
                    <li><a class="dropdown-item" href="#">Type Client</a></li>
                    <li><a class="dropdown-item" href="#">Type ID</a></li>
                    <li><a class="dropdown-item" href="#">Type utilisateur</a></li>
                    <li><a class="dropdown-item" href="#">Modalite paiement</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Les specialités de formateur</a></li>
                </ul>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="../eleve_session/liste_eleve_sessions.php" id="navbarDropdown" role="button">
                    Eleve Session
                </a> 
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="../eleve/liste_eleves.php" id="navbarDropdown" role="button">
                        Deconnexion
                    </a>
                    
                </li>
                -->
            </ul>

                
                <!-- <input type="text"  class="p-1 mb-1 bg-primary text-white" name="nom" style="border:none;" value="<?= $_SESSION['user']['nom'] ?>" readonly/>
                <input type="text"  class="p-1 mb-1 bg-secondary text-white" style="border:none; "  name="prenom" value="<?= $_SESSION['user']['prenom'] ?>" readonly/> -->
                <!-- <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Chercher</button> -->
            </form>
        </div>
    </nav>