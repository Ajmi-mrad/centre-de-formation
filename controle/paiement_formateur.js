function verif(){
    var montant_paye=float(document.f.motnant_paye.value);
    var montant_remb=float(document.f.montant_remb.value);
    
    if(montant_paye<montant_remb){
        alert("Il faut choisir la date de debut de session"); 
        return false;
    }
    if(date_fin==""){
        alert("Il faut choisir la date de fin de session"); 
        return false;
    }
    if(nom==""){
        alert("Il faut choisir le nom de cett session"); 
        return false;
    }   
    if(prix==""){
        alert("Il faut choisir le prix de cette session"); 
        return false;
    }
    if (new Date(date_deb) > new Date(date_fin)){
        alert("Erreur : la date debut est inferieur a la date fin");
        return false;
    }
    }
    