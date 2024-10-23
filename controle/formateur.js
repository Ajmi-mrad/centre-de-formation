function estNumTel(ch) {
    if (isNaN(ch) || Number(ch) != ch || ch=="") {
      return false;
    }
    return true;
  }
  
function verif(){
var sp=document.f.id_specialite.value;
var nom=document.f.nom.value;
var prenom=document.f.prenom.value;
var num_id=document.f.num_id.value;
var nat_id=document.f.nat_id.value;
var id_specialite=document.f.id_specialite.value;
var tel=document.f.tel.value;
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
if(id_specialite=="0"){
    alert("Il faut choisir la specialite"); 
    return false;
}
if(sp=="0"){
    alert("Il faut choisir la specialite"  ); 
    return false;
    }

}
