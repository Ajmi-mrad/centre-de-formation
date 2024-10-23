function verif(){
var nom=document.f.nom.value;
var prenom=document.f.prenom.value;
var adresse=document.f.pseudo.value;
var mp=document.f.mdp.value;
var type=document.f.type.value;
if(nom==""){
    alert("Il faut choisir le nom"); 
    return false;
}
if(prenom==""){
    alert("Il faut choisir le prenom"); 
    return false;
}
if(adresse==""){
    alert("Il faut choisir une adresse"); 
    return false;
}
if(mp==""){
    alert("Il faut choisir le mot de passe"); 
    return false;
}

if(type=="0"){
    alert("Il faut choisir le type d'utilisateur !!"); 
    return false;
}   

}
