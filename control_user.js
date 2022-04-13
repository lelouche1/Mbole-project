let form_user = document.getElementById('form_user');


form_user.addEventListener('submit', function(e){

    
    let nom_user = document.getElementById('nom_utilisateur');
    let my_regex = /^[a-zA-Z\s]+$/;
    if(nom_user.value === ""){
    let nom_error = document.getElementById('nom_error');
    nom_error.innerHTML="le champs nom utilisateur est requis";
    nom_error.style.color = "red";
        e.preventDefault();  
    }
    else if(my_regex.test(nom_user.value) == false){ //si c'est egal false c'est  true c'est que le message est valide
    let nom_error = document.getElementById('nom_error');
    nom_error.innerHTML="le nom doit comporter des lettre et espace uniquement";
    nom_error.style.color = "red";
    e.preventDefault();
    }
     
});