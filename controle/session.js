function verif(){
var date_deb=document.f3.date_deb.value;
var date_fin=document.f3.date_fin.value;
var nom=document.f3.nom.value;
var prix=document.f3.prix.value;
if(date_deb==""){
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
