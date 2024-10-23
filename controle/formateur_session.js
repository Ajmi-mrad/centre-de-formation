function verif(){
    var id_formateur=document.f.id_formateur.value;
    var id_paiement=document.f.id_paiement.value;
    var montant_total=document.f.montant_total.value;
    
    if(id_formateur=="0"){
        alert("Il faut selectionnez un formateur"); 
        return false;
    }
    if(id_paiement=="0"){
        alert("Il faut selectionnez une modalite de paiement"); 
        return false;
    }
    if(montant_total==""){
        alert("Il faut choisir le montant total"); 
        return false;
    }   

    }
    