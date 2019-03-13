
function verifChamps(ch){
    if(ch){
       return true; 
    }
    else{
        return false;
    }
}

function envoieForm(){  
    var validation;
    var formulaire = {};
    formulaire.nom = document.getElementsByName("nom")[0].value;
    formulaire.prenom = document.getElementsByName("prenom")[0].value;
    formulaire.fonction = document.getElementsByName("fonction")[0].value;
    formulaire.mail = document.getElementsByName("mail")[0].value;
    formulaire.naissance = document.getElementsByName("naissance")[0].value;
    formulaire.pass = document.getElementsByName("pass")[0].value;
    formulaire.repass = document.getElementsByName("repass")[0].value;
    
    for(var i in formulaire){
        
        if(!verifChamps(formulaire[i])){            // a revoir (<input required>)
            alert("Le champs " + i + " doit être renseigné");
            validation = false;
            break;
        }
        else{
            validation = true;
        }
    }
    
    return validation;
    
    
}