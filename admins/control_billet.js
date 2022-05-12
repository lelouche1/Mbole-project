let form_bill = document.getElementById('form_bill');
// controle des vols


form_bill.addEventListener('submit',function(ev)
{
  
  let nom_voy_regex=/^[a-zA-Z-\s]+$/;

  let nom_voy=document.getElementById('nom_voy');
  let error_voy = document.getElementById('error_voy');
  let datev=document.getElementById('datev_billet');
  let payde=document.getElementById('payde_billet');
  let lieud=document.getElementById('lieud_billet');
  let error_lieud=document.getElementById('berror_lieud');
  let error_dat=document.getElementById('berror_dat');
   let error_dep = document.getElementById('berror_dep');
   let num_sieg = document.getElementById('num_sieg');
   let berror_num = document.getElementById('berror_dep');


    if((nom_voy.value.trim()=="") || (nom_voy_regex.test(nom_voy.value) === false)){      
        error_voy.innerHTML="ce champ ne peu pas contenir des caractere speciaux ou etre vide";
        error_voy.classList.remove('text-success');
        error_voy.classList.add('text-danger');
        ev.preventDefault();       
    }
    else{
        error_voy.innerHTML="champ valide";
        error_voy.classList.remove('text-danger');
        error_voy.classList.add('text-success');
    }

    if((payde.value.trim()==="") || (nom_voy_regex.test(payde.value) === false)){
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
   if((nom_voy_regex.test(lieud.value) === false) ||  (lieud.value.trim()==="")){
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
    if((num_sieg.value.trim()=="")){ 
        berror_num.innerHTML="ce champ ne peu pas contenir des caractere speciaux ou etre vide";
        berror_num.classList.remove('text-success');
        berror_num.classList.add('text-danger');
        ev.preventDefault();       
    }
    else{
        berror_num.innerHTML="champ valide";
        berror_num.classList.remove('text-danger');
        berror_num.classList.add('text-success');
    }
    
});