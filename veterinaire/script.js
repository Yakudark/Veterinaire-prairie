var navLinks = document.getElementById("navLinks");

function showMenu() {
    navLinks.style.right = "0";
}
function hideMenu() {
    navLinks.style.right = "-200px";
}

// const btn = document.querySelector("#suscribe");
// btn.addEventListener("click", event=> {
//     event.preventDefault();
//     prompt("formulaire envoyé");
// })

function W3docs()                                    
{ 
    var name = document.forms["RegForm"]["Nom"];  
    var surname = document.forms["RegForm"]["Prénom"];  
    var gender = document.forms["RegForm"]["Genre"];  
    var mdp = document.forms["RegForm"]["Mot de passe"];  
    var email = document.forms["RegForm"]["Email"];    
    var phone = document.forms["RegForm"]["Téléphone"];  
    var adress =  document.forms["RegForm"]["Adresse"];  
    var zipcode = document.forms["RegForm"]["Code postal"];  
    var city = document.forms["RegForm"]["Ville"];  

    if (name.value == "")                                  
    { 
        alert("Mettez votre nom."); 
        name.focus(); 
        return false; 
    }   

     if (surname.value == "")                               
    { 
         alert("Mettez votre prénom."); 
         surname.focus(); 
         return false; 
    }   

     if (mdp.value == "")                                   
     { 
         alert("Mettez votre mot de passe."); 
         mdp.focus(); 
         return false;  
     }  

      if (email.value.indexOf("@", 0) < 0)                 
     { 
         alert("Mettez une adresse email valide."); 
         email.focus(); 
         return false; 
     }    
     
      if (phone.value == "")                           
     { 
         alert("Mettez votre numéro de téléphone."); 
         phone.focus(); 
         return false; 
     }    
   
     if (gender.selectedIndex < 1)                  
     { 
         alert("Choisissez votre genre."); 
         gender.focus(); 
         return false; 
     } 

     if (adress.value == "")                  
     { 
         alert("Mettez votre adresse."); 
         adress.focus(); 
         return false; 
     } 
     if (zipcode.value == "")                           
     { 
         alert("Mettez votre code postal"); 
         zipcode.focus(); 
         return false; 
     }   
     if (city.value == "")                           
     { 
         alert("Mettez votre ville"); 
         city.focus(); 
         return false; 
     } 
    alert("Merci pour votre inscription.");
    window.location.href="Page Propriétaire.html";
    return true; 
    
}

const element = document.getElementById("btn-choice");
element.addEventListener("click", choix);

function choix(){
   var choice = document.getElementById('choix-animal').value;
   document.getElementById("text-choice").innerHTML = choice;
   console.log(choice);
}
