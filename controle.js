

let form_user = document.getElementById('form_utilisateur');

let datemin = new Date('2006-01-01');
let datemax = new Date('1910-01-01');

function comparedate(datemin,datemax, e)
{
    let erdat=document.getElementById('error_date');
    let dateune = new Date(datev=document.getElementById('date'));
    if(dateune < datemin){
        erdat.innerHTML="vous êtes trop jeune pour acceder aux site";
        erdat.classList.remove('text-success');
        erdat.classList.add('text-danger');  
        e.preventDefault(); 
        return false;
    }
    else if(dateune > datemax){
        erdat.innerHTML="age trop grand non valide";
        erdat.classList.remove('text-success');
        erdat.classList.add('text-danger'); 
        e.preventDefault(); 
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


//----------------------------------2eme partie-------------------------------------------

let form_edit = document.getElementById('form_edit');

form_edit.addEventListener('submit',function(ev)
{
  
  let nom_user_regex= /^[a-zA-Z-\s]+$/;
  let email_regex=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;  
  let nom_us=document.getElementById('nom_us');
  let error_nam = document.getElementById('nom_erre');
  let email=document.getElementById('mail');
  let mdp=document.getElementById('mdp');
  let cmdp=document.getElementById('cmdp');
  let smdp=document.getElementById('spanmdp');
  let scmdp=document.getElementById('spacnmdp');
  let erdat=document.getElementById('error_date');

  let d = document.getElementById('date');
  

    if(nom_us.value.trim()==""){      
        error_nam.innerHTML="veuillez remplir le champ nom utilisateur";
        error_nam.style.color="red";
        ev.preventDefault();       
    }
    else if(nom_us_regex.test(nom_user.value) === false){
        error_nam.innerHTML="le nom d'utilisateur ne peut contenir que des lettre";
        error_nam.style.color="red";
        ev.preventDefault();  
    }
    else if(email.value.trim()==""){
        error_email.innerHTML="remplir le champ email";
        error_email.style.color="red";
        e.preventDefault(); 
    }
    else if(email_regex.test(email.value) === false){
        error_email.innerHTML="email invalide";
        error_email.style.color="red";
        e.preventDefault(); 
    }
    else if(mdp.value.trim()===""){
        smdp.innerHTML="remplir le champ mot de passe";
        smdp.style.color="red";
        e.preventDefault();
    }
    else if(date.value.trim()===""){
        smdp.innerHTML="remplir le champ mot de passe";
        smdp.style.color="red";
        e.preventDefault();
    }
   if(date1 < date2){
    erdat.innerHTML="vous devez etre né au moins en 2004";
    erdat.style.color="red";
  }
    
})

/*
form_user.email_utilisateur.addEventListener('change', function(e){

    email_valid(this);
})

const email_valid=function(input_email){
    //creation d'une fonction de validation
  
}
let test_email = email_regex.test(input_email.value);  //je test si lemail est valide
let error_email = document.getElementById('error_email');

if(test_email) //si lemail contien des valeurs non autorisé
{  
    error_email.innerHTML="email valide";
    error_email.style.color="green";
}
else{
    error_email.innerHTML="email invalide";
    error_email.style.color="red";
}
*/
