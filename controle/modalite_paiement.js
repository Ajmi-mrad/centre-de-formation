function verif(){
    var modalite_paiement=document.modalite_paiement.libelle.value;
    if(modalite_paiement==""){
        alert("Il faut choisir la modalite de paiement !!"); 
        return false;
    }  
}
