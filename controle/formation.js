function verif(){
var nom=document.f2.nom.value;
var type_formation=document.f2.type_formation.value;
if(nom==""){
    alert("Il faut choisir le nom de formation"); 
    return false;
}
if(type_formation=="0"){
    alert("Il faut choisir le type formation"); 
    return false;
}   

}
