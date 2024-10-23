function estNumTel(ch) {
    if (isNaN(ch) || Number(ch) != ch || ch=="") {
      return false;
    }
    return true;
  }
  
function verif(){
var nom=document.f1.nom.value;
var prenom=document.f1.prenom.value;
var num_id=document.f1.num_id.value;
var nat_id=document.f1.nat_id.value;
var tel=document.f1.tel.value;
if(nom==""){
    alert("Il faut choisir le nom"); 
    return false;
}
if(prenom==""){
    alert("Il faut choisir le prenom"); 
    return false;
}
if (!estNumTel(tel)) {
    alert('Indiquer un numéro de téléphone!');
    return false;
}
if(num_id=="0"){
    alert("Il faut choisir le type ID"); 
    return false;
}   
if(nat_id==""){
    alert("Il faut choisir le N° d'identification"); 
    return false;
}

}
