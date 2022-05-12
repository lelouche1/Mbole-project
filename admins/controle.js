let form_user = document.getElementById('form_utilisateur');

console.log(form_user)
let datemin = new Date('2006-01-01');
let datemax = new Date('1910-01-01');

function comparedate(datemin,datemax, de)
{
    let erdat=document.getElementById('error_date');
    let dateune = new Date(datev=document.getElementById('date'));
    if(dateune < datemin){
        erdat.innerHTML="vous êtes trop jeune pour acceder aux site";
        erdat.classList.remove('text-success');
        erdat.classList.add('text-danger');  
        de.preventDefault(); 
        return false;
    }
    else if(dateune > datemax){
        erdat.innerHTML="age trop grand non valide";
        erdat.classList.remove('text-success');
        erdat.classList.add('text-danger'); 
        de.preventDefault(); 
        return false;
    }
    
}

form_user.addEventListener('submit',function(e)
{
  
  let nom_user_regex= /^[a-zA-Z-\s]+$/;
  let email_regex=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;  
  let nom_user=document.getElementById('nom_user');
  let error_name = document.getElementById('error_nom');
  let email=document.getElementById('mail');
  let mdp=document.getElementById('mdp');
  let cmdp=document.getElementById('cmdp');
  let smdp=document.getElementById('spanmdp');
  let scmdp=document.getElementById('spacnmdp');
 // let erdat=document.getElementById('error_date');
  let date=document.getElementById('date');

  let d = document.getElementById('date');
  let date1 = new Date(d);
  let date2 = new Date('2004-01-20');

    if((nom_user.value.trim()=="") || (nom_user_regex.test(nom_user.value) === false)){      
        error_name.innerHTML="ce champ ne peut contenir des chiffres caracteres spéciaux ou etre vide";
        error_name.classList.remove('text-success');
        error_name.classList.add('text-danger');
        window.alert('vous avez laisser le champs vide')
        e.preventDefault();       
    }
    else{
        error_name.innerHTML="champ valide";
        error_name.classList.remove('text-danger');
        error_name.classList.add('text-success');  
    }
    //------------------------------------------------------------------
    if((email.value.trim()=="") || (email_regex.test(email.value) === false)){
        error_email.innerHTML="ce champ ne peut contenir des caracteres spéciaux ou etre vide";
        error_email.classList.remove('text-success');
        error_email.classList.add('text-danger');
        e.preventDefault(); 
    }
    else{
        error_email.innerHTML="champ valide";
        error_email.classList.remove('text-danger');
        error_email.classList.add('text-success');
    }
     if((mdp.value.trim()==="")){
        smdp.innerHTML="remplir les champ mot de passe";
        smdp.classList.remove('text-success');
        smdp.classList.add('text-danger');
        e.preventDefault();
    }
    else{
        smdp.innerHTML="valide";
        smdp.classList.remove('text-danger');
        smdp.classList.add('text-success');
    }
    if(cmdp.value.trim()===""){
        scmdp.innerHTML="remplir le champ cofirmer mot de passe";
        scmdp.classList.remove('text-success');
        scmdp.classList.add('text-danger');
        e.preventDefault();
    }
    else{
        scmdp.innerHTML="remplir le champ cofirmer mot de passe";
        scmdp.classList.remove('text-danger');
        scmdp.classList.add('text-success');
    }
    if(date.value.trim()===""){
        scmdp.innerHTML="ce champ ne peut etre vide";
        scmdp.classList.remove('text-success');
        scmdp.classList.add('text-danger');
        e.preventDefault();
    }
    else if(date.value.trim()!=""){
        comparedate(datemin,datemax, e);
    }
    else{
        scmdp.innerHTML="champ valide";
        scmdp.classList.remove('text-danger');
        scmdp.classList.add('text-success');
        e.preventDefault();
    }
      
})
   