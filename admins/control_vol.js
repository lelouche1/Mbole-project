let form_vol = document.getElementById('form_vol');
// controle des vols

console.log(form_vol)

form_vol.addEventListener('submit',function(ev)
{
  
  let nom_vol_regex=/^[a-zA-Z-\s]+$/;

  let nom_vol=document.getElementById('comp');
  let error_comp = document.getElementById('error_comp');
  let datev=document.getElementById('datev');
  let payde=document.getElementById('payde');
  let lieud=document.getElementById('lieud');
  let error_dat=document.getElementById('error_dat');
   let error_dep = document.getElementById('error_dep');


    if((nom_vol.value.trim()=="") || (nom_vol_regex.test(nom_vol.value) === false)){      
        error_comp.innerHTML="ce champ ne peu pas contenir des caractere speciaux ou etre vide";
        error_comp.classList.remove('text-success');
        error_comp.classList.add('text-danger');
        window.alert('vous avez laisser le champs vide')
        ev.preventDefault();       
    }
    else{
        error_comp.innerHTML="champ valide";
        error_comp.classList.remove('text-danger');
        error_comp.classList.add('text-success');
    }

    if((payde.value.trim()==="") || (nom_vol_regex.test(payde.value) === false)){
        error_dep.innerHTML="remplir le champ mot de passe";     
        error_dep.classList.remove('text-success');
        error_dep.classList.add('text-danger');
        ev.preventDefault();
    }
    else{
        error_dep.innerHTML="champ valide";     
        error_dep.classList.remove('text-danger');
        error_dep.classList.add('text-success');
        
    }
   if((nom_vol_regex.test(lieud.value) === false) ||  (lieud.value.trim()==="")){
        error_lieud.innerHTML="le nom ne pas contenir des carracteres spéciaux ou etre vide";
        error_lieud.classList.remove('text-success');
        error_lieud.classList.add('text-danger');
        ev.preventDefault();
    }
    else{
        error_lieud.innerHTML="champ valide";
        error_lieud.classList.remove('text-danger');
        error_lieud.classList.add('text-success');
    }
    if(datev.value.trim()==""){
        error_dat.innerHTML="ce champ ne peu pas etre vide";
        error_dat.classList.remove('text-success');
        error_dat.classList.add('text-danger');
        ev.preventDefault(); 
    }
    else if (datev.value.trim()==""){
        comparedate(datemin,datemax, ev);
    }
    else{
        error_dat.innerHTML="champ valide";
        error_dat.classList.remove('text-danger');
        error_dat.classList.add('text-success');   
    }
    
});